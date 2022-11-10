
<?php
$templates = [ 'nextActive' => '<a class="page-link" href="{{url}}">{{text}}</a>',
    'nextDisabled' => '<a class="page-link" href="{{url}}" aria-disabled="true">{{text}}</a>',
    'prevActive' => '<a class="page-link" href="{{url}}" tabindex="-1" >{{text}}</a> ',
    'prevDisabled' => '<a class="page-link" href="{{url}}" tabindex="-1" aria-disabled="true">{{text}}</a>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item"><a class="page-link" href="">{{text}}</a></li>',
    ];

    function GetDirectorySize($path){
    $bytestotal = 0;
    $path = realpath($path);
    if($path!==false && $path!='' && file_exists($path)){
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
            $bytestotal += $object->getSize();
        }
    }
    $bytestotal = number_format($bytestotal/1024/1024,2);
    return $bytestotal;
    }
?>

<table class="table">
    <thead>
    <tr>
        <th  scope="col"><?= $this->Paginator->sort('store_name') ?></th>
        <th  scope="col"><?= $this->Paginator->sort('domain_name') ?></th>
        <th  scope="col"><?= $this->Paginator->sort('full_name','Customer Name') ?></th>
        <th  scope="col"><?= $this->Paginator->sort('email') ?></th>       
        <th  scope="col"><?= $this->Paginator->sort('phone') ?></th>
       
      
        <th  scope="col"><?= $this->Paginator->sort('expire_date') ?></th>
        <th  scope="col"><?= $this->Paginator->sort('disabled','Status') ?></th>
        
        <th  scope="col">Size</th>
      
        <th  scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>

    </thead>
    <tbody>
    <?php foreach ($stores as $store):?>
        <tr>    
            <td>        
            <?= $store->store_name ?> <a title="Live Preview" href="<?= '//' . $store->store_url ?>" target="_blank" class="">  <i class="fe fe-external-link"></i></a> 
            </td>
            <td>        
                <?= empty($store->domain_name)?"Not set":$store->domain_name?>  
                </td>
            <td><?= ($store->customer)?  $this->Html->link($store->customer->first_name  . ' ' . $store->customer->last_name,['controller'=> 'customers','action' =>'view',$store->customer->id]):'' ?> </td>
            <td><?= ($store->customer)?$store->customer->email:'' ?></td>
           
          
            <td><?=  ($store->customer)?$store->customer->phone:'' ?></td>
          

            <td>
                <?php
                $today = new DateTime('');
                $expireDate = new DateTime($store->expire_date);
                if($today->format("Y-m-d") > $expireDate->format("Y-m-d")):
                    ?>
                    <span class="badge badge-danger"><?= __('Expired') ?> </span>

                <?php else: ?>
                    <span class="badge badge-primary"> <?php  if(!empty($store->expire_date))  echo $store->expire_date->format('d-m-Y'); else echo "Not set"; ?> </span>
                <?php endif; ?>
            </td>
            <td><?= ($store->disabled)?"Disabled":"Active"?></td>
          <td>
              <?php echo GetDirectorySize(CONTENTS . $store->store_name)  ?> MB
          </td>
         
           <td>
                <?php  echo $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $store->id],['class'=>"btn btn-sm btn-outline-primary ",'escape' => false]) ?>
               
             <!--   <a href="<?= $this->Url->build(['controller' => 'Stores', 'action' => 'smsHistory', $store->id]) ?>" class="btn btn-sm btn-primary"><i class="fa fa-comment"></i></a>-->
                
                <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delete', $store->id], ['class'=>['btn btn-sm btn-outline-primary'], 'confirm' => __('Store will be fully deleted with all files and database. This can not be undone. Are you sure you want to do this?'),'escape' => false]) ?>
               
            </td> 
        </tr>
    <?php endforeach; ?>
   

    <tr>
        <td>
            <ul class="pagination">
                <li class="page-item disabled">

                    <?php echo $this->Paginator->prev('Previous',['templates'=>$templates]); ?>
                </li>
                <?php echo $this->Paginator->numbers(['templates'=>$templates]); ?>
                <li class="page-item">
                    <?php echo $this->Paginator->next('Next',['templates'=>$templates]); ?>
                </li>
            </ul>
        </td>
        <td>

        </td>
    </tr>
</tbody>
</table>
