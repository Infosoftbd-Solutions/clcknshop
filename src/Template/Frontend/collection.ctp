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

$pagination_links = [];
$q = $_GET;
unset($q['url']);
for($i=1;$i <= $pagination->total_page;$i++){
  $q['page'] = $i;
  $pagination_links[$i] = $this->Url->build('/collection/' . $slug) . "?" . http_build_query($q);
}
$q['page'] =(($pagination->cur_page - 1) == 0)?1:($pagination->cur_page - 1);
$pagination_link_prev = $this->Url->build('/collection/' . $slug) . "?" . http_build_query($q);
$q['page'] =(($pagination->cur_page + 1) > $pagination->total_page)?$pagination->total_page:($pagination->cur_page + 1);
$pagination_link_next = $this->Url->build('/collection/' . $slug) . "?" . http_build_query($q);

$this->assign('title_for_layout',$collection_title);

if($this->request->is('ajax'))
  include_once $this->Tplparser->compile("collection_ajax.tpl");
else
  include_once $this->Tplparser->compile("collection.tpl");
  

?>
