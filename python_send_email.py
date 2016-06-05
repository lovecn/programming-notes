from smtplib import SMTP
from email.mime.text import MIMEText
from email.header import Header
#http://help.163.com/09/1224/17/5RAJ4LMH00753VB8.html
def send_email(SMTP_host, from_addr, password, to_addrs, subject, content):
    email_client = SMTP(SMTP_host)
    email_client.login(from_addr, password)
    # create msg
    msg = MIMEText(content,'plain','utf-8')
    msg['Subject'] = Header(subject, 'utf-8')#subject
    msg['From'] = 'main<xxxxx@163.com>'
    msg['To'] = "xxxxx@126.com"
    email_client.sendmail(from_addr, to_addrs, msg.as_string())

    email_client.quit()

if __name__ == "__main__":
    send_email("smtp.163.com","xxxxx@163.com","password","xxxxx@126.com","test","hellow")
