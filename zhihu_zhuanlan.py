#encoding=utf8
import time
import requests
from bs4 import BeautifulSoup
#https://www.zhihu.com/question/24948369/answer/120842635
Default_Header = {'X-Requested-With': 'XMLHttpRequest',
                  'Referer': 'http://www.zhihu.com',
                  'User-Agent': 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; '
                                'rv:39.0) Gecko/20100101 Firefox/39.0',
                  'Host': 'www.zhihu.com'}
_session = requests.session()
_session.headers.update(Default_Header) 

BASE_URL = 'https://www.zhihu.com'
CAPTURE_URL = BASE_URL+'/captcha.gif?r='+str(int(time.time())*1000)+'&type=login'
PHONE_LOGIN = BASE_URL + '/login/email'
BASE_ZHUANLAN_API = 'https://zhuanlan.zhihu.com/api/columns/'
BASE_ZHUANLAN = 'https://zhuanlan.zhihu.com'


def login():
    '''登录知乎'''
    username = ''#你自己的帐号密码
    password = ''
    cap_content = _session.get(CAPTURE_URL).content
    cap_file = open('cap.gif','wb')
    cap_file.write(cap_content)
    cap_file.close()
    captcha = input('capture:')
    data = {"email":username,"password":password,"captcha":captcha}
    r = _session.post(PHONE_LOGIN, data)
    print ((r.json())['msg'])
    
def zhuanlan_info():
    Default_Header = {
                  'Referer': 'https://zhuanlan.zhihu.com/passer',
                  'User-Agent': 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; '
                                'rv:39.0) Gecko/20100101 Firefox/39.0',
                  'Host': 'zhuanlan.zhihu.com'}
    _session = requests.session()
    _session.headers.update(Default_Header)
    HtmlContent = _session.get('https://zhuanlan.zhihu.com/api/columns/passer')
    HtmlContent = HtmlContent.json()
    print ('专栏名称   ：'+HtmlContent['name'])
    print ('专栏关注人数：'+str(HtmlContent['followersCount']))
    print ('专栏文章数量：'+str(HtmlContent['postsCount']))
    print ('专栏介绍   ：'+HtmlContent['description'])
    print ('专栏创建者相关信息：')
    print ('1、地址：:'+HtmlContent['creator']['profileUrl'])
    print ('2、个签：:'+HtmlContent['creator']['bio'])
    print ('3、昵称：:'+HtmlContent['creator']['name'])
    print ('4、hash：:'+HtmlContent['creator']['hash'])
    print ('5、介绍：:'+HtmlContent['creator']['description'])


def zhuanlan_text():
    Default_Header = {
                  'Referer': 'https://zhuanlan.zhihu.com/passer',
                  'User-Agent': 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; '
                                'rv:39.0) Gecko/20100101 Firefox/39.0',
                  'Host': 'zhuanlan.zhihu.com'}
    _session = requests.session()
    _session.headers.update(Default_Header)
    TextAPI = BASE_ZHUANLAN_API+'passer/posts?limit=20&offset='
    endFlag = True
    offset = 0
    while endFlag:
        TextContentHTML = (_session.get(TextAPI+str(offset))).json()
        for everText in TextContentHTML:
            print ('文章作者相关：')
            print ('1、地址：:'+everText['author']['profileUrl'])
            print ('2、个签：:'+everText['author']['bio'])
            print ('3、昵称：:'+everText['author']['name'])
            print ('4、hash：:'+everText['author']['hash'])
            print ('5、介绍：:'+everText['author']['description'])
            print ('文章标题   ：'+everText['title'])
            print ('文章地址    ：'+BASE_ZHUANLAN+everText['url'])
            print ('文章推送时间：'+everText['publishedTime'])
            print ('文章评论数量：'+str(everText['commentsCount']))
            print ('文章点赞数量：'+str(everText['likesCount']))
            print ('文章内容   ：'+everText['content'])
        if(len(TextContentHTML) < 20):
            endFlag = False
        offset = offset + 20
login()
zhuanlan_info() 
zhuanlan_text()   
