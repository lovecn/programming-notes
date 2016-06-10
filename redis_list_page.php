$redis = new Redis();
$redis->connect('localhost',6379);
 
$length = $redis->llen('mylist');
 
$pagesize = 20;
$pageno = max(1,$_GET['page']);
$totalpage = ceil($length/$pagesize);
 
$start = ($pageno-1)*$pagesize;
$end = $start+$pagesize;
 
$lists = $redis->lrange('mylist',$start,$end);
 
var_dump($lists);
