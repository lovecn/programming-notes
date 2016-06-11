<?php
 function php_shell(){
    $arr = [9,8,7,6,5,4,3,2,1];
    $func = function () use($arr){  //use(&$arr) 结果会不一样
        return array_pop($arr);
    };

    return $func;
 }

 $func = php_shell();
 for($i = 0 ; $i <= 6; $i++){
    echo $func();//1 2 3 4 5 6 7
    echo "<br/>\r\n";
 }

 ?>
 <script>
     function js_shell(){
        var arr = [9,8,7,6,5,4,3,2,1];
        var func = function(){
            return arr.pop();
        };

        return func;
     }
     var func = js_shell();
     for(var i = 0 ; i <= 6; i++){
        console.log(func());//1 1 1 1 1 1
     }
 </script>
