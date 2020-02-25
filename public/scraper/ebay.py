import scrapy
import json
from scrapy.http import FormRequest
from scrapy.http.headers import Headers
from urllib import urlencode
from scrapy import Request
from scrapy.http.cookies import CookieJar
from urlparse import urlparse, parse_qs
import math
class Ebay(scrapy.Spider):
    name = 'ebay'
    start_urls = ['http://www.ebay.com/sch/Cars-Trucks/6001/i.html']
    handle_httpstatus_list = [404,500]
    def __init__(self,url=None, *args, **kwargs):
        super(Ebay, self).__init__(*args, **kwargs)
        self.start_urls = [url]
    # def start_requests(self):
    #     yield Request(self.start_urls + '0')

    def parse(self, response):
        is_sold=False
        is_404=False
        if response.status != 404:
        	if response.css('.vi-end-lb.vi-end-lb-big'):
        		is_sold=True
        else:
            is_404=True
        yield {"is_sold":is_sold,"is_404":is_404}