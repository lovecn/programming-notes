$arr1=[
        [ 'count' => 1 ]
    ];
$arr2=[
        [ 'count' => 1 ]
    ];
$arr3=[
        [ 'count' => 1 ]
    ];
echo '<pre>';
print_r(sumArray($arr1, $arr2, $arr3));
echo '</pre>';
/*Array
(
    [0] => Array
        (
            [count] => 3
        )

)*/
function sumArray() {
    $arr = func_get_args();
    return array_reduce($arr, function($currentSumOuter, $itemOuter) {
        
        // 這裡是各組中的 count 總和
        // 返回結構是 [ 'count' => 總和 ]
        $sumInner = array_reduce($itemOuter, function($currentSumInner, $itemInner) {
            return [
                'count' => $itemInner['count'] + $currentSumInner['count']
            ];
        }, 0);
        
        // 這裡再按照原先結構，把各組總和再次總和
        return [
            [ 
                'count' => $currentSumOuter[0]['count'] + $sumInner['count']
            ]
        ];
    }, 0);
}
