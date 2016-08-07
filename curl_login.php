function signIndex()
    {
        $uKey = 'HuaXia' . date("YmdHis") . uniqid();//将key值作为cookie文件名可以在传参数的时候传给后台 后台自己充组重新生成cookie文件
        $dirCode = APP_IMAGE_CODE . "/" . $uKey . ".jpg";//图片文件路径
        $codeUrl = __WEBURL__ . "/Static/images/{$uKey}.jpg";//图片地址
        $cookieVerify = APP_COOKIE . "/" . $uKey . ".tmp";//cookie文件路径
        $url = '';//注册页url
        $imgUrl = '';//验证码url
        $this->getCookie($url, $cookieVerify);//访问一遍注册页面获取到cookie 保存
        $this->getImg($imgUrl, $dirCode, $cookieVerify);//获取图片验证码保存在本地
        $this->assign('pic', $codeUrl);
        $this->assign('key', $uKey);
        $this->display();
    }
    
     /**
     * 方法名 getImg
     * 参数 图片的URL、保存图片信息的路径、保存cookie的文件路径
     * 功能 访问验证码图片并报存在本地供提取验证码
     * 返回值 无（仅将内容保存在文件当中）
     */
    public function getImg($imgUrl, $img, $cookieVerify)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $imgUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120); // 设置超时限制防止死循环
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieVerify);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieVerify);
        $rs = curl_exec($ch);
        // 把验证码在本地生成，二次拉取验证码可能无法通过验证
        @file_put_contents("$img", $rs);
        curl_close($ch);
    }

    /**
     * 方法名 getCookie
     * 参数 页面URL、保存cookie的文件路径
     * 功能 访问页面获取cookie的值
     * 返回值 无（仅将内容保存在定义文件中）
     */
    public function getCookie($url, $cookieVerify)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120); // 设置超时限制防止死循环
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieVerify);
        curl_exec($ch);
        curl_close($ch);
    }
