<?php
// https://segmentfault.com/a/1190000004231651
class WeixinPush
{
    protected $appid;
    protected $secret;
    protected $accessToken;

    function  __construct($appid, $secret)
    {
        if ($appid && $secret) {
            $this->appid = $appid;
            $this->secret = $secret;
            $this->accessToken = $this->getToken($appid, $secret);
        }
        
    }

    /**
     * 发送post请求
     * @param string $url
     * @param string $param
     * @return bool|mixed
     */
    function request_post($url = '', $param = '')
    {
        if (empty($url) || empty($param)) {
            return false;
        }
        $postUrl = $url;
        $curlPost = $param;
        $ch = curl_init(); //初始化curl
        curl_setopt($ch, CURLOPT_URL, $postUrl); //抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1); //post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch); //运行curl
        curl_close($ch);
        return $data;
    }

    /**
     * 发送get请求
     * @param string $url
     * @return bool|mixed
     */
    function request_get($url = '')
    {
        if (empty($url)) {
            return false;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * 获取token
     * @param $appid
     * @param $appsecret
     * @return mixed
     */
    protected function getToken($appid, $appsecret)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appid . "&secret=" . $appsecret;
        $token = $this->request_get($url);
        $token = json_decode(stripslashes($token));
        $arr = json_decode(json_encode($token), true);
        $access_token = $arr['access_token'];
        return $access_token;
    }

    /**
     * 发送自定义的模板消息
     * @param $touser
     * @param $template_id
     * @param $url
     * @param $data
     * @param string $topcolor
     * @return bool
     */
    public function doSend($touser, $template_id, $url, $type, $topcolor = '#7B68EE')
    {   
        $template = array(
            'touser' => $touser,
            'template_id' => $template_id,
            'url' => $url,
            'topcolor' => $topcolor,
            'data' => $data
        );
        $json_template = json_encode($template);
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $this->accessToken;
        $dataRes = $this->request_post($url, urldecode($json_template));
        print_r($dataRes);
        if ($dataRes['errcode'] == 0) {
            return true;
        } else {
            return false;
        }
    }
}

$data = array(
    'first'=>array('value'=>urlencode("您的订单已提交成功"),'color'=>"#743A3A"),
    'orderID'=>array('value'=>urlencode("123456789"),'color'=>"#743A3A"),
    'orderMoneySum'=>array('value'=>urlencode("30.0"),'color'=>'#0000FF'),
    'backupFieldName'=>array('value'=>urlencode("商品信息"),'color'=>'#0000FF'),
    'backupFieldData'=>array('value'=>urlencode("商品名称"),'color'=>'#0000FF'),
    'remark'=>array('value'=>urlencode('\\n如有问题请致电029-88888888或直接在微信留言，小菜将第一时间为您服务'),'color'=>'#000000'),
    );
    
$weixin = new WeixinPush($appid , $secret);
$weixin->doSend($touser, $template_id, $url, $data);
