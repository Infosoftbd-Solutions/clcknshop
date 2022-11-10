<?php
$sort_opt = ['title-ascending'=>'Alphabetically, A-Z',
    'title-descending'=>'Alphabetically, Z-A',
    'price-ascending'=>'Price, low to high',
    'price-descending'=>'Price, high to low',
    'created-ascending'=>'Date, old to new',
    'created-descending'=>'Date, new to old'
];

$sort_by = [];
foreach($sort_opt as $key=>$opt){
    $selected = (isset($_GET['sort-by']) && $_GET['sort-by']==$key)?"selected":"";
    $sort_by[] = '<option value="' .$key . '"' . $selected .  '>' . $opt . '</option>';
}
$sort_by = implode('',$sort_by);

//dd($keyword);

$pagination_links = [];
$q = $_GET;
for($i=1;$i <= $pagination->total_page;$i++){
    $q['page'] = $i;
    $pagination_links[$i] = $this->Url->build('/search') . "?" . http_build_query($q);
}




$q['page'] =(($pagination->cur_page - 1) == 0)?1:($pagination->cur_page - 1);
$pagination_link_prev = $this->Url->build('/search?') . http_build_query($q);
$q['page'] =(($pagination->cur_page + 1) > $pagination->total_page)?$pagination->total_page:($pagination->cur_page + 1);
$pagination_link_next = $this->Url->build('/search?') . http_build_query($q);

$action = $this->Url->build('/search?keyword=' . $keyword);

foreach($products as $key=>$product){
    $product->link = $this->Url->build("/product/" . $product->slug);
    $product->cartlink = $this->Url->build("/add_to_cart") . "?product_id=" . $product->id;
    $product->price = $this->Formats->moneyFormat($product->price);
    $product->imagepath = PRODUCT_IMAGE_PATH . $product->id . DS . $product->default_image;
}

include_once $this->Tplparser->compile("search.tpl");
?>
