import scrapy
import json
from scrapy.http import FormRequest
from scrapy.http.headers import Headers
from urllib import urlencode
from scrapy import Request
from scrapy.http.cookies import CookieJar
from urlparse import urlparse, parse_qs
import math
class Carsforsale(scrapy.Spider):
    name = 'carsforsale'
    start_urls = ['https://www.carsforsale.com']
    handle_httpstatus_list = [404,500,410]

    def __init__(self,url=None, *args, **kwargs):
        super(Carsforsale, self).__init__(*args, **kwargs)
        self.start_urls = [url]

    def parse(self, response):
        is_sold=False
        if response.status == 404:
            is_sold=True
        elif response.status == 410:
            is_sold=True
        else:
            if response.css('.page-container.error-content.text-center'):
                is_sold=True
        yield {"is_sold":is_sold}