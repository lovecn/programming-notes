<?php
//well  http://stackoverflow.com/questions/14767530/php-using-pdo-with-in-clause-array
$in_array = array(1, 2, 3);
$in_values = implode(',', $in_array);
$my_result = $wbdb->prepare("SELECT * FROM my_table WHERE my_value IN (".$in_values.")");
$my_result->execute();
$my_results = $my_result->fetchAll();

// error
$in_array = array(1, 2, 3);
    $in_values = implode(',', $in_array);
    $my_result = $wbdb->prepare("SELECT * FROM my_table WHERE my_value IN (:in_values)");
    $my_result->execute(array(':in_values' => $in_values));
    $my_results = $my_result->fetchAll();

//solution
$in  = str_repeat('?,', count($in_array) - 1) . '?';
$sql = "SELECT * FROM my_table WHERE my_value IN ($in)";
$stm = $db->prepare($sql);
$stm->execute($in_array);
$data = $stm->fetchAll();

$data = $db->getALL("SELECT * FROM my_table WHERE my_value IN (?a)", $in_array);
