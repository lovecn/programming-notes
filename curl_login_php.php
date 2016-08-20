/**
 * 模拟登录
 */

//初始化变量
$cookie_file = "tmp.cookie";
$login_url = "http://xxx.com/logon.php";
$verify_code_url = "http://xxx.com/verifyCode.php";

echo "正在获取COOKIE...\n";
$curlj = curl_init();
$timeout = 5;
curl_setopt($curl, CURLOPT_URL, $login_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($curl,CURLOPT_COOKIEJAR,$cookie_file); //获取COOKIE并存储
$contents = curl_exec($curl);
curl_close($curl);

echo "COOKIE获取完成，正在取验证码...\n";
//取出验证码
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $verify_code_url);
curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$img = curl_exec($curl);
curl_close($curl);

$fp = fopen("verifyCode.jpg","w");
fwrite($fp,$img);
fclose($fp);
echo "验证码取出完成，正在休眠，20秒内请把验证码填入code.txt并保存\n";
//停止运行20秒
sleep(20);

echo "休眠完成，开始取验证码...\n";
$code = file_get_contents("code.txt");
echo "验证码成功取出：$code\n";
echo "正在准备模拟登录...\n";

$post = "username=maben&pwd=hahahaha&verifycode=$code";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
$result=curl_exec($curl);
curl_close($curl);

//这一块根据自己抓包获取到的网站上的数据来做判断
if(substr_count($result,"登录成功")){
 echo "登录成功\n";
}else{
 echo "登录失败\n";
 exit;
}

$cookieVerify = dirname(__FILE__)."/verify.tmp";
$cookieSuccess = dirname(__FILE__)."/1769.tmp";
if(!$_POST){
    // 获取cookie并保存
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "http://www.1769pt.com/userlogin.html");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieVerify);
    $rs = curl_exec($ch);
    curl_close($ch); 

    // 带上cookie抓取验证码，必须带上cookie，否则验证码不对应
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "http://www.1769pt.com/include/getcode.php");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieVerify);
    $rs = curl_exec($ch);
    // 把验证码在本地生成，二次拉取验证码可能无法通过验证
    @file_put_contents("verify.jpg",$rs);
    curl_close($ch); 
    // 手工验证码表单
    echo "<form action=\"\" method=\"post\"><input type=\"text\" name=\"vcode\"><img src=\"verify.jpg\" /><br><input type=\"submit\" value=\"ok\"></form>";
}else{
    // 登录
    $ch = curl_init(); 
    // 用户名\密码 
    $user = "abc123"; 
    $pass = "123456";
    $verify = $_POST["vcode"];
    $url = "http://www.1769pt.com/userlogin.php?action=login"; 

    // 返回结果存放在变量中，不输出 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieVerify);
    curl_setopt($ch, CURLOPT_HEADER, 1); 
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); 
    curl_setopt($ch, CURLOPT_POST, true); 
    $fields_post = array("username"=> $user, "userpwd"=> $pass, "logintype"=>1,"vcode"=>$verify); 
    $headers_login = array("User-Agent" => "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36"); 
    $fields_string = ""; 
    foreach($fields_post as $key => $value){ 
        $fields_string .= $key . "=" . $value . "&"; 
    } 
    $fields_string = rtrim($fields_string , "&"); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_login); 
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieSuccess);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string); 
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result= curl_exec($ch);
    curl_close($ch);
    // 登录成功,查看1769.tmp cookie文件有相应用户名等信息
}
