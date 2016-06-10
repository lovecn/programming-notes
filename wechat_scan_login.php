<img src="qrcode.php?id=xxx" />
<script>
var qrcode_id = xxx;
 
var e = function() {
    $.get('s.php?qid='+qid, function(data){
        var j = JSON.parse(data) || false;
        if (!j) {
            setTimeout(e,3000);
            return false;
        } else if ('bind' == j.state) {
            alert('手机已扫码');
            setTimeout(e,3000);
            return false;
        } else if ('redirect' == j.state) {
            windnow.location.href = j.redirect_uri;
        }
    });
}
e();
</script>
//s.php
<?php
 
// 开始检查时间
$startTime = time();
 
$db = new db();
 
$qid = $_GET['qid'];
$action = $_GET['action'];
 
// 如果当前二维码已经被别人使用过
if ($qr['bind'] && $qr['bind'] != $current_uid)
    exit( json_encode(['state'=>'fail']) );
 
// 绑定当前用户(手机扫描时会带上用户设备信息或设备已登陆用户信息)
if (!$qr['bind']) {
    $db->update($qid, ['bind'=>$current_uid]);
    exit( json_encode(['state' => 'bind']) );
}
 
// 如果当前qr已经被绑定并且是当前登录用户
if ($qr['bind'] == $current_uid && 'login' == $action) {
    // 更新数据库删除code
    // 生成session绑定用户
    exit( json_encode(['state' => 'redirect' , 'redirect_uri' => 'xxxxxxxxxxxxxx']) );
}
 
exit(json_encode(['state' => 'fail']));
