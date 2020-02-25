import scrapy
import json
from scrapy.http import FormRequest
from scrapy.http.headers import Headers
from urllib import urlencode
from scrapy import Request
from scrapy.http.cookies import CookieJar
class BlogSpider(scrapy.Spider):
    COOKIES_ENABLED = True
    COOKIES_DEBUG = False
    name = 'carsforsale'
    global page_number
    global color
    global get_color
    global pages_number
    def __init__(self, brand=None,model=None,start_year=None,end_year=None,start_price=None,end_price=None,mileage=None,interior=None,exterior=None,page_number=None,color=None, *args, **kwargs):
        super(BlogSpider, self).__init__(*args, **kwargs)
        url= 'https://www.carsforsale.com/Search?BodyStyle=All+Vehicle+Types&MinModelYear='+start_year+'&MaxModelYear='+end_year+'&MinPrice='+start_price+'&MaxPrice='+end_price+'&MaxMileage='+mileage+'&ZipCode=&Radius=&Model='+model+'&Make='+brand
        if page_number:
            self.page_number = page_number
        else:
            self.page_number=0
        self.color = color
        self.get_color=0
        self.pages_number=0
        self.start_urls = [url]

    def parse(self, response):
        all_cookies=response.headers.getlist('Set-Cookie')
        global total_results
        global total_pages
        # total_results=''
        # total_pages=''
        if len(all_cookies)>4:
            guardian_endpoint = response.headers.getlist('Set-Cookie')[0].split(";")[0].split("=")[1]
            asp_net_sessionid = response.headers.getlist('Set-Cookie')[1].split(";")[0].split("=")[1]
            loggedid = response.headers.getlist('Set-Cookie')[4].split(";")[0].split("=")[1]
            cfsApplyFilters = response.headers.getlist('Set-Cookie')[1].split(";")[0].split("=")[1]
            initials = response.headers.getlist('Set-Cookie')[2].split(";")[0].split("=")[1]
            firstName = response.headers.getlist('Set-Cookie')[3].split(";")[0].split("=")[1]
            global cookies
            if len(all_cookies)>5:
                serverid = response.headers.getlist('Set-Cookie')[5].split(";")[0].split("=")[1]
                cookies={"ASP.NET_SessionId":asp_net_sessionid,"cfsApplyFilters":cfsApplyFilters,"Initials":initials,"FirstName":firstName,"LoggedIn":loggedid,"SERVERID":serverid,"GuardianEndpoint":guardian_endpoint}
            else:
                cookies={"ASP.NET_SessionId":asp_net_sessionid,"cfsApplyFilters":cfsApplyFilters,"Initials":initials,"FirstName":firstName,"LoggedIn":loggedid,"GuardianEndpoint":guardian_endpoint}
            
            if response.css('ul.pagination-cfs li div  span ::text'):
                total_pages = response.css('ul.pagination-cfs li div  span ::text').extract_first()
                total_pages = total_pages.replace("of ", "")
                total_pages = total_pages.replace(",","")
                total_pages = int(total_pages)+1
            else:
                total_pages=0
            
            if response.css('div h2#searchResultCount ::text'):
                total_results = response.css('div h2#searchResultCount ::text').extract_first()
                total_results = total_results.replace("Results", "")
                total_results = total_results.replace(",", "")
                total_results = total_results.strip()
            else:
                total_results=''
       
        if self.color and self.get_color == 1:
            for res in response.css('li.vehicle-list'):
                # description = res.css('div.vehicle-info-section div span::attr(itemprop)').extract_first()
                # href = res.css('article div div div.col-xs-2.col-V2-lg-2 a::attr(href)').extract_first()
                href = res.css('::attr(data-detailsurl)').extract_first()
                if href:
                    yield scrapy.Request(response.urljoin(href),callback=self.product_details)
        if self.color:
            self.get_color=1
            url ="https://www.carsforsale.com/search/filtercolor"
            if int(self.page_number)>1:
                body = json.dumps({"IsChecked": True,"Value":self.color,"PageNumber": str(self.page_number)})
            else:
                body = json.dumps({"IsChecked": True,"Value":self.color})
            headers = Headers({'Content-Type': 'application/json'})
            yield scrapy.Request(url, callback=self.parse, method='POST',body=body, headers=headers,cookies=cookies)
        if int(self.page_number)>1 and self.pages_number == 1:
            for res in response.css('li.vehicle-list'):
                # description = res.css('div.vehicle-info-section div span::attr(itemprop)').extract_first()
                # href = res.css('article div div div.col-xs-2.col-V2-lg-2 a::attr(href)').extract_first()
                href = res.css('::attr(data-detailsurl)').extract_first()
                if href:
                    yield scrapy.Request(response.urljoin(href),callback=self.product_details)
        if int(self.page_number)>1 and self.get_color ==0:
                self.pages_number=1
                url ="https://www.carsforsale.com/search/gotopage"
                body = json.dumps({"PageNumber": str(self.page_number)})
                headers = Headers({'Content-Type': 'application/json'})
                yield scrapy.Request(url, callback=self.parse, method='POST',body=body, headers=headers,cookies=cookies)
        if self.get_color==0 and self.pages_number==0:
            for res in response.css('li.vehicle-list'):
                # description = res.css('div.vehicle-info-section div span::attr(itemprop)').extract_first()
                # href = res.css('article div div div.col-xs-2.col-V2-lg-2 a::attr(href)').extract_first()
                href = res.css('::attr(data-detailsurl)').extract_first()
                if href:
                    yield scrapy.Request(response.urljoin(href),callback=self.product_details)
            # if int(self.page_number)>1:
            #     url ="https://www.carsforsale.com/search/gotopage"
            #     body = json.dumps({"PageNumber": str(self.page_number)})
            #     headers = Headers({'Content-Type': 'application/json'})
            #     yield scrapy.Request(url, callback=self.parse, method='POST',body=body, headers=headers,cookies=cookies)  
        # for i in range(2, 100, 1):
        # # for i in range(2, total_pages, 1000):
        #     url ="https://www.carsforsale.com/search/gotopage"
        #     body = json.dumps({"PageNumber": str(i)})
        #     headers = Headers({'Content-Type': 'application/json'})
        #     yield scrapy.Request(url, callback=self.parse, method='POST',body=body, headers=headers,cookies=cookies)
    
    def product_details(self, response):
        import re
        #for ress in response.css('div.page-container.details-margin'):
        href = response.url
        title = response.css('div div div h1 ::text').extract_first()
        # title = res.css('article div div div.col-xs-10.col-V2-lg-10 div h2 a span ::text').extract_first()
        if title:
            str_title = title.split(" ")
        else:
            str_title = "        "
        year = str_title[0]
        brand = str_title[1]
        model = str_title[2]
        price = response.css('div .VehiclePricing h4 ::text').extract_first()
        if price:
            price = price.replace("$", "")
            price = price.replace(",", "")
            price = price.strip()
        else:
            prince=0
        mileage = response.css('#VehicleList-details div div:nth-child(2).vehicle-tablecell ::text').extract()
        if mileage:
            mileages = mileage[0]
            mileage = mileages.replace("miles", "")
            mileage = mileage.replace(",", "")
            mileage = re.sub("\D", "", mileage)
            mileage = mileage.strip()
            if mileage:
                miles = float(mileage)
                conv_fac = 1.609 
                kilometers = miles * conv_fac
            else:
                kilometers = ""
        else:
            mileage = ""
            kilometers =""
        src = []
        for re in response.css(".vehicle-img .item"):
            if re.css('img::attr(lazy-src)'):
                img = re.css('img::attr(lazy-src)').extract_first()
                src.append(img)
            else:
                img = re.css('img::attr(src)').extract_first()
                src.append(img)
        specs={}
        for re in response.css("div.vehicle-table"):
            key=re.css('div:nth-child(1).vehicle-tablecell ::text').extract()
            value=re.css('div:nth-child(2).vehicle-tablecell ::text').extract()
            if len(value)==0:
                value=""
            else:
                # value=len(value)
                value=value[0].strip()
            specs[key[0].strip()]=value
        reference_id=href.split("/")
        lenth=len(reference_id)
        reference_id=reference_id[lenth-1]
        description=response.css("div#VehicleDesc p ::text").extract()
        seller_name=response.css("div#dealerInfo-Name ::text").extract_first()
        # yield {'href': href,"src":src,"title":title,"price":price,"year":year,"brand":brand,"model":model,"mileage":mileage,"specs":specs,"kilometers":kilometers}
        yield {"src":src,"href":response.url,"title":title,"price":price,"mileage":mileage,"kilometers":kilometers,"year":year,"brand":brand,"model":model,"specs":specs,"reference_id":reference_id,"description":description,"total_results":total_results,"total_pages":total_pages,'seller_name':seller_name}