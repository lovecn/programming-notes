$order = [465, 472, 442, 410, 396, 395, 297, 364, 355, 221];
$products = array(
    array(
        '_id' => '57208ea27f8b9a5e048b4598',
        'topic_id' => 472,
        'host_pic' => '/topic',
        'topic_name' => 'goods 1',
        'template' => 4
    ),
    array(
        '_id' => '57208ea27f8b9a5e048b4598',
        'topic_id' => 410,
        'host_pic' => '/topic',
        'topic_name' => 'goods 2',
        'template' => 2
    ),
    array(
        '_id' => '57208ea27f8b9a5e048b4598',
        'topic_id' => 465,
        'host_pic' => '/topic',
        'topic_name' => 'goods 3',
        'template' => 1
    ),
    array(
        '_id' => '57208ea27f8b9a5e048b4598',
        'topic_id' => 396,
        'host_pic' => '/topic',
        'topic_name' => 'goods 4',
        'template' => 4
    )
);
$column = array_flip(array_column($products, 'topic_id'));
$_products = [];
foreach ($order as $row) {
    if (! empty($column[$row])) {
        $_products[] = $products[$column[$row]];
    }
}
print_r($_products);
