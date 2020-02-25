#!/usr/bin/python

import scrapy
import json
from scrapy.http import FormRequest
from scrapy.http.headers import Headers
from urllib import urlencode
from scrapy import Request
from scrapy.http.cookies import CookieJar
import math
class BlogSpider(scrapy.Spider):
	name = 'hemmings'
	def __init__(self,start_year=None,end_year=None,start_price=None,end_price=None,page_number=None,brand=None,model=None, *args, **kwargs):
		super(BlogSpider, self).__init__(*args, **kwargs)
		start=""
		page_size=15
		if page_number:
			page_number=int(page_number)
			if page_number >1:
				page_number=page_number-1
				start=page_number*page_size
		
		url= 'https://www.hemmings.com/classifieds/cars-for-sale/?year_min='+start_year+'&year_max='+end_year+'&price_min='+start_price+'&price_max='+end_price+'&page_size='+str(page_size)+'&start='+str(start)+'&makeFacet='+brand+'&modelFacet='+model
		self.start_urls = [url]
		
	def parse(self, response):
		global total_results
		global total_pages
		total_results=''
		total_pages=''
		total_results = response.css('div.results-count ::text').extract()[1]
		total_results=total_results.split("of")
		total_results = total_results[1].replace(",","")
		total_pages=float(total_results)/15
		total_pages =math.ceil(total_pages)
		for ress in response.css('div#resultdata .result-block'):
			href = ress.css('a.rs-headline::attr(href)').extract_first()
			if href:
				yield scrapy.Request(response.urljoin(href),callback=self.product_details)
	def product_details(self, response):
		href = response.url
		title = response.css('div h1.listing-title ::text').extract_first()
		if title:
			str_title = title.split(" ")
		else:
			str_title = "        "
		year = str_title[0]
		brand = str_title[1]
		model = str_title[2]
		reference_id=href.split("/")
		lenth=len(reference_id)
		reference_id=reference_id[lenth-1]
		reference_id = reference_id.replace(".html", "")
		price = response.css('div.listing-price-lg  h2 ::text').extract_first()
		price = price.replace("$", "")
		price = price.replace(",", "")
		price = price.strip()
		mileage=""
		kilometers=""
		seller_description=""
		src = []
		for re in response.css(".royalSlider.rsDefaultHMN .rsImg"):
			img = re.css('img::attr(src)').extract_first()
			src.append(img)
		sepc=response.css('#listing-description-details  ::text').extract()
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
		if "Location:" in specification:
			location_pos=specification.index("Location:")
			specs[specification[location_pos].strip()]=specification[location_pos+1]
		if "Stock:" in specification:
			stock_pos=specification.index("Stock:")
			specs[specification[stock_pos].strip()]=specification[stock_pos+1]
		if "VIN:" in specification:
			vin_pos=specification.index("VIN:")
			specs[specification[vin_pos].strip()]=specification[vin_pos+1]

		if "Mileage:" in specification:
			mileage_pos=specification.index("Mileage:")
			specs[specification[mileage_pos].strip()]=specification[mileage_pos+1]
			mileage=float(specification[mileage_pos+1])
			conv_fac = 1.609
			kilometers = mileage * conv_fac
		if "Transmission:" in specification:
			transmission_pos=specification.index("Transmission:")
			specs[specification[transmission_pos].strip()]=specification[transmission_pos+1]
		if "Condition:" in specification:
			condition_pos=specification.index("Condition:")
			specs[specification[condition_pos].strip()]=specification[condition_pos+1]
		if "Exterior:" in specification:
			exterior_pos=specification.index("Exterior:")
			specs[specification[exterior_pos].strip()]=specification[exterior_pos+1]
		if "Interior:" in specification:
			interior_pos=specification.index("Interior:")
			specs[specification[interior_pos].strip()]=specification[interior_pos+1]
			specs["testtt"]=specification[interior_pos+2]
		if seller_description:
			des=[]
			for re in response.css('#listing-description-details p'):
				description=re.css("p::text").extract_first()
				if re.css('p b'):
					break
				if not description is None and description.strip() != "":
					des.append(description)
			specs["description"]=des

		seller_name=response.css('div#vitals-lg .dl-horizontal.text-left dd:nth-child(4) a::text').extract_first()
		yield {"href":response.url,"title":title,"price":price,"src":src,"sepc":specs,"seller_name":seller_name,"year":year,"brand":brand,"model":model,"reference_id":reference_id,"kilometers":kilometers,"mileage":mileage,"total_pages":total_pages,"total_results":total_results}