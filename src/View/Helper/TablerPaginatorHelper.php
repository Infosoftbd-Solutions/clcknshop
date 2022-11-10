<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * TablerForm helper
 */
class TablerPaginatorHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $helpers = ['Html','Paginator'];
    
    protected $templates = [ 'nextActive' => '<a class="paginate_button next "  rel="next" href="{{url}}">{{text}}</a>',
        'nextDisabled' => '<a class="paginate_button next disabled"  href="" onclick="return false;">{{text}}</a>',
        'prevActive' => '<a class="paginate_button previous"  rel="prev" href="{{url}}">{{text}}</a>',
        'prevDisabled' => '<a class="paginate_button previous disabled"  href="" onclick="return false;">{{text}}</a>',
        'number' => '<a  class="paginate_button "  href="{{url}}">{{text}}</a>',
        'current' => '<a  class="paginate_button current" href="">{{text}}</a>',
        ];
        
        
    
    
    
    public function counter($options = []){
       if(!isset($options['format']))
            $options['format'] = __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total');
        $div_pre = '';
        $div_post = '';
        if(!isset($options['div'])){
            $div_pre = '<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">';
            $div_post = '</div>';
           unset($options['div']);
        }
            
            
        return $div_pre . $this->Paginator->counter($options) .$div_post;    
          
    }
    
    public function prev($label,$options = []){
       $options['templates'] = $this->templates;
       return $this->Paginator->prev($label,$options);
    }
    
    public function next($label,$options = []){
       $options['templates'] = $this->templates;
       return $this->Paginator->next($label,$options);
    }
    
    public function numbers($options = []){
        $options['templates'] = $this->templates;
        return $this->Paginator->numbers($options);
    }
    
    public function links($options = []){
    
         return $this->counter() . '<div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">' . $this->prev(__('Previous')) . '<span>' . $this->numbers() . '</span>' . $this->next(__('Next')) . '</div>'; 
    }
    
    
    
    
    
    
    
    
    
        
        
        
}
        
   
            