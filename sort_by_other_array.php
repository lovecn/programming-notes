<?php
$a = Array
(
    Array (
        'cid'   => 1,
        'cname' => '关于'
    ),

    Array (
        'cid'   => 7,
        'cname' => '简介'
    ),

    Array (
        'cid'   => 8,
        'cname' => '文化'
    ),

    Array (
        'cid'   => 9,
        'cname' => '动态'
    )

);

$b = Array
(
    Array (
        'cid'   => 1,
        'cname' => '关于'
    ),

    Array (
        'cid'   => 2,
        'cname' => '歌剧'
    ),

    Array (
        'cid'   => 3,
        'cname' => '美剧'
    ),

    Array (
        'cid'   => 4,
        'cname' => '视频'
    ),

    Array (
        'cid'   => 5,
        'cname' => '娱乐'
    ),

    Array (
        'cid'   => 6,
        'cname' => '联系'
    ),

    Array (
        'cid'   => 7,
        'cname' => '简介'
    ),

    Array (
        'cid'   => 8,
        'cname' => '文化'
    ),

    Array (
        'cid'   => 9,
        'cname' => '动态'
    )

);
$c = Array
(
    Array (
        'cid'   => 1,
        'cname' => '关于'
    ),

    Array (
        'cid'   => 7,
        'cname' => '简介'
    ),

    Array (
        'cid'   => 8,
        'cname' => '文化'
    ),

    Array (
        'cid'   => 9,
        'cname' => '动态'
    ),

    Array (
        'cid'   => 2,
        'cname' => '歌剧'
    ),

    Array (
        'cid'   => 3,
        'cname' => '美剧'
    ),

    Array (
        'cid'   => 4,
        'cname' => '视频'
    ),

    Array (
        'cid'   => 5,
        'cname' => '娱乐'
    ),

    Array (
        'cid'   => 6,
        'cname' => '联系'
    )
);
class SortByArray {
  
  public $ref;
  public $array;

  public function __construct($ref,$array){
   $this->ref = $ref;
   $this->array = $array;    
      usort($this->array,function($t1,$t2){
        $p1 = array_search($t1,$this->ref);
        $p2 = array_search($t2,$this->ref);
        if(($p1===false||$p1===null) && ($p2===false||$p2===null))
          return array_search($t1,$this->array)<array_search($t2,$this->array) ? -1 :1;
        if($p1===$p2) return 0;  
        if($p1===false||$p1===null) return 1;
        if($p2===false||$p2===null) return -1; 
        return $p1<$p2 ? -1 : 1;
      });  
  }
 
}

//一个数组根据另一个数组来排序 https://segmentfault.com/q/1010000005639569
$res = new SortByArray($a,$b);
print_r($res->array);
