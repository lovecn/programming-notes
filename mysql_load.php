<?php
//http://yansu.org/2014/04/16/insert-large-number-of-data-in-mysql.html
$dsn = 'mysql:host=localhost;dbname=test';
$db = new PDO($dsn,'root','',array(PDO::ATTR_PERSISTENT => true));
//删除上次的插入数据
$db->query('delete from `test`');
//开始计时
$start_time = time();
$sum = 1000000;
// 测试选项
$num = 1;

if ($num == 1){
    // 单条插入
    for($i = 0; $i < $sum; $i++){
        $db->query("insert into `test` (`id`,`name`) values ($i,'tsetssdf')");
    }
} elseif ($num == 2) {
    // 批量插入，为了不超过max_allowed_packet，选择每10万插入一次
    for ($i = 0; $i < $sum; $i++) {
        if ($i == $sum - 1) { //最后一次
            if ($i%100000 == 0){
                $values = "($i, 'testtest')";
                $db->query("insert into `test` (`id`, `name`) values $values");
            } else {
                $values .= ",($i, 'testtest')";
                $db->query("insert into `test` (`id`, `name`) values $values");
            }
            break;
        }
        if ($i%100000 == 0) { //平常只有在这个情况下才插入
            if ($i == 0){
                $values = "($i, 'testtest')";
            } else {
                $db->query("insert into `test` (`id`, `name`) values $values");
                $values = "($i, 'testtest')";
            }
        } else {
            $values .= ",($i, 'testtest')";    
        }
    }
} elseif ($num == 3) {
    // 事务插入
    $db->beginTransaction(); 
    for($i = 0; $i < $sum; $i++){
        $db->query("insert into `test` (`id`,`name`) values ($i,'tsetssdf')");
    }
    $db->commit();
} elseif ($num == 4) {
    // 文件load data
    $filename = dirname(__FILE__).'/test.sql';
    $fp = fopen($filename, 'w');
    for($i = 0; $i < $sum; $i++){
        fputs($fp, "$i,'testtest'\r\n");    
    }
    $db->exec("load data infile '$filename' into table test fields terminated by ','");
}

$end_time = time();
echo "总耗时", ($end_time - $start_time), "秒\n";
echo "峰值内存", round(memory_get_peak_usage()/1000), "KB\n";

?>
