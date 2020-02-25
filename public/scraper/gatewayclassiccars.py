import scrapy
import json
from scrapy.http import FormRequest
from scrapy.http.headers import Headers
from urllib import urlencode
from scrapy import Request
from scrapy.http.cookies import CookieJar
from urlparse import urlparse, parse_qs
import math
import re
class BlogSpider(scrapy.Spider):
    COOKIES_ENABLED = True
    COOKIES_DEBUG = False
    name = 'ebay'
    # start_urls = ['http://www.ebay.com/sch/Cars-Trucks/6001/i.html']
    start_urls = ['http://www.gatewayclassiccars.com/carlist2?src=5&per_page=60']
    

    def __init__(self, brand=None,model=None,start_year=None,end_year=None,start_price=None,end_price=None,mileage=None,interior=None,exterior=None,page_number=None,eng=None,tra=None, *args, **kwargs):
        super(BlogSpider, self).__init__(*args, **kwargs)
        year=""
        if start_year and end_year:
            for i in range(int(start_year), int(end_year)+1, 1):
                if i == int(end_year):
                    year=year+str(i)
                else:
                    year=year+str(i)+'%7C'
        elif start_year and not end_year:
            year=start_year
        elif end_year and not start_year:
            year=end_year

        if mileage:
            mileage=mileage.replace(',','%252C')


        # Ybeg=1990&Yend=2030


        # http://www.gatewayclassiccars.com/carlist2?sort=year&direction=ASC&page=3&src=5&location=&make=&model=&keyword1=&keyword2=&keyword3=&status=&special=&popular=&Ybeg=1990&Yend=2030&Pbeg=0&Pend=0&Color=&eng=&tra=

        brand = brand.replace("-", "+")
        url = "http://www.gatewayclassiccars.com/carlist2?src=5&per_page=60&make="+brand+"&Ybeg="+start_year+"&Yend="+end_year+"&Pbeg="+start_price+"&Pend="+end_price+"&MaxMileage="+mileage+"&model="+model+"&Color="+exterior+"&eng="+eng+"&tra="+tra+"&page="+page_number
        self.start_urls = [url]
    def parse(self, response):
    	all_cookies=response.headers.getlist('Set-Cookie')
    	global total_results
    	global page_count
    	global cookies
    	PHPSESSID = response.headers.getlist('Set-Cookie')[0].split(";")[0].split("=")[1]
    	cookies={"PHPSESSID":PHPSESSID}
    	if response.css('h1.pageH1partial ::text'):
    		total_results=response.css('h1.pageH1partial ::text').extract_first()
    		total_results = re.sub("\D", "", total_results)
	    	total_results = total_results.strip()
	    	pages=float(total_results)/60
	    	page_count =math.ceil(pages)
        else:
			total_results=''
			page_count= ''
        for res in response.css('div.sr4Div'):
			if  res.css('ul.lvprices li:nth-child(2).lvformat span ::text'):
				bids = res.css('ul.lvprices li:nth-child(2).lvformat span ::text').extract_first()
				bids = bids.split(" ")
			else:
				bids=[]
			if res.css('ul div.tsp'):
				best = res.css('ul div.tsp + li + li span ::text').extract_first()
				best = best.strip()
				if best == "Buy It Now":
					scrap = True
			else:
				scrap = False

			href = res.css('div.sr4Div.car-btn a::attr(href)').extract_first()
			
			yield scrapy.Request(response.urljoin(href),callback=self.product_details)
        next_page = response.css('tr td.pages a.curr + a ::attr(href)').extract_first()

    def product_details(self, response):
        import re
    	mileage = ""
        title = response.css('div h1.pageP ::text').extract()
        if title[0]:
            str_title = title[0].split(" ")
        else:
            str_title = "       "
        year = str_title[0]
        
        if len(str_title)>2:
            brand = str_title[1:len(str_title)-2]
            brand = ''.join(brand)
            model = str_title[len(str_title)-2:]
            model = ''.join(model)
        else:
            brand = " "
            model = " "
        price = title[2]
        price = price.replace("$", "")
        price = price.replace(",", "")
        if price:
            price = re.sub("\D", "", price)
        src = []

        if response.css('div.gallery a'):
            for res in response.css('div.gallery a'):
            	img = res.css('a::attr(href)').extract_first()
            	img = img.replace("/images", "")
            	img = "http://images.gatewayclassiccars.com"+img
                src.append(img)
        else:
            img = ""
            src.append(img)
        

        specs={}
        sepc=response.css('div.col-md-12 div.col-md-6 div.text-left p ::text').extract()
        specification=[]
        for se in sepc:
            new=se.replace("\n", "")
            new=new.replace("\t", "")
            new=new.replace("#", "")
            new = new.strip()
            if new !='':
                specification.append(new)
                if new.find("Description:") == -1:
                    pass
                else:
                    seller_description= len(specification)-1
        specs={}
        if "Engine:" in specification:
            location_pos=specification.index("Engine:")
            specs[specification[location_pos].strip()]=specification[location_pos+1]
        if "Transmission:" in specification:
            stock_pos=specification.index("Transmission:")
            specs[specification[stock_pos].strip()]=specification[stock_pos+1]
        if "Mileage:" in specification:
            mileage_pos=specification.index("Mileage:")
            specs[specification[mileage_pos].strip()]=specification[mileage_pos+1]

            mileage = specification[mileage_pos+1].replace(",", "")
            mileage = re.sub("\D", "", mileage)
            mileage=float(mileage)
            conv_fac = 1.609
            kilometers = mileage * conv_fac


        if "Body Style:" in specification:
            vin_pos=specification.index("Body Style:")
            specs[specification[vin_pos].strip()]=specification[vin_pos+1]
        if "Exterior Color:" in specification:
            vin_pos=specification.index("Exterior Color:")
            specs[specification[vin_pos].strip()]=specification[vin_pos+1]
        if "Interior Color:" in specification:
            vin_pos=specification.index("Interior Color:")
            specs[specification[vin_pos].strip()]=specification[vin_pos+1]
        parameters=parse_qs(urlparse(response.url).query)
        try:
            reference_id=parameters['item']
            reference_id=reference_id[0]
        except Exception as e:
            parames=response.url.split("/")
            ref_param=parames[len(parames)-1]
            reference_id=ref_param.split('?')
            reference_id=reference_id[0]
        reference_id=reference_id.replace(".html", "")
        title = ''.join(title)
        yield {"src":src,"href":response.url,"specs":specs,"title":title,"price":price,"brand":brand,"model":model,"year":year,"reference_id":reference_id,"mileage":mileage,"kilometers":kilometers,"description":"","total_results":total_results,"page_count":page_count}
