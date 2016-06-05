#coding=utf-8
#http://blog.chinaunix.net/uid-22414998-id-3692113.html?page=3
from selenium import webdriver
driver = webdriver.PhantomJS()
driver.get("https://s.taobao.com/search?q=iphone")

datas = driver.find_elements_by_class_name('J_ItemPic')
for _ in datas:
    print _.get_attribute('src')
