<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\Core\Configure;

require_once("simple_html_dom.php");

class TplparserHelper extends Helper
{

  protected $_theme;
  protected $_html;
  protected $cache_enabled = false;
  public $helpers = array('Html','Url');

  public function initialize(array $config)
  {
    if(isset($this->_View->viewVars['theme']))
       $this->setTheme($this->_View->viewVars['theme']);
    elseif (!empty(Configure::read("App.theme"))) {
      $this->setTheme(Configure::read("App.theme"));
    }
    $this->cache_enabled = Configure::read("theme_cache",false);
  }

  public function setTheme($theme){
    $this->_theme = $theme;
  }

  public function compile($template){
      // die($template);
      $file   =   THEMES . $this->_theme . DS . "templates" . DS . $template;
       //pr($file);
      if (file_exists($file) == false) return false;

      $this->_html = file_get_html($file);
      if($this->_html == false)
          return "";

      $theme_folder = TMP .DS . "cache" . DS . "themes" . DS . STORENAME . DS . $this->_theme ;
      $theme_folder_path = $theme_folder;
      $dir = pathinfo($template)['dirname'];
      if ($dir)
          $theme_folder_path = TMP .DS . "cache" . DS . "themes" . DS . STORENAME . DS . $this->_theme . DS . $dir ;


      if(!file_exists($theme_folder_path ))
          mkdir($theme_folder_path,0777,true);

      $compiled = $theme_folder . DS . $template;

      if (!$this->cache_enabled || !file_exists($compiled) || filemtime($compiled) < filemtime($file) || filemtime($compiled) < filemtime(dirname(__FILE__)."/TplparserHelper.php")  ) {


          foreach ($this->_html->find('[src]') as $tag) {
              if ((strpos($tag->src, "{{") === false) && (strpos($tag->src, "http:") === false) && (strpos($tag->src, "https:") === false)) $tag->src = $this->_View->viewVars['theme_root'] . $tag->src;
          }

          foreach ($this->_html->find('[href]') as $tag) {
              if ((strpos($tag->href, "{{") === false) && (strpos($tag->href, "#") === false) && (strpos($tag->href, "http:") === false) && (strpos($tag->href, "https:") === false) && (strpos($tag->href, "javascript") === false)) {
                  if ($tag->tag == 'a')
                      $tag->href = $this->Url->build(((strpos($tag->href,'/')===false)?"/":"") . $tag->href);
                  else
                      $tag->href = $this->_View->viewVars['theme_root'] . $tag->href;
              }
          }

          foreach ($this->_html->find('[action]') as $tag) {
              if ((strpos($tag->action, "{{") === false) && (strpos($tag->action, "http:") === false) && (strpos($tag->action, "https:") === false)) {
                  if ($tag->hasAttribute("tplform") == false)
                      $tag->action = $this->Url->build("/" . $tag->action);
              }
          }

          $this->process_var();
          $this->process_each();
         
          $this->process_image();
          $this->process_check();
          $this->store_var();
          $this->process_user();
          $this->_html = str_get_html($this->compilelamda($this->_html->save()));
          $this->_html->save($compiled);
      }
    return $compiled;
  }

  protected function compilelamda($html){
       $html = $this->compileEchos($html);
       $html = $this->compileFunc($html);
       return $html;
  }

  protected function compileFunc($code) {
        return preg_replace_callback('~\{%\s*(.+?)\s*\%}~is', function ($matches) {
            $vars = trim(str_replace(array('{%','%}'),'', $matches[0]));
            if(strpos($vars,'=') === false){

              return '<?php '  . $this->var_to_func(trim($vars)) .   '; ?>';
            }else{
              $var = explode('=',$vars);
              return '<?php $' .  trim($var[0])  .  ' = '  . $this->var_to_func(trim($var[1])) .   '; ?>';
            }


        }, $code);
  }

  protected function compileEchos($code) {
        return preg_replace_callback('~\{{\s*(.+?)\s*\}}~is', function ($matches) {
            return '<?php echo '   . $this->var_to_func(trim(str_replace(array('{{','}}'),'', $matches[0]))) .   '?>'; //strtolower($matches[0]);
        }, $code);
  }



  protected function process_image(){
   foreach($this->_html->find('[tplimage]') as $ele)
    {
      $height = $ele->getAttribute("height");
      $width = $ele->getAttribute("width");
      $path = $ele->getAttribute("path");
      $set = $ele->getAttribute("set");
      
      if(!(empty($path))) $path = '$' . $path;
      $rsz = [];
      if(!empty($height))
        $rsz[] = '"height"=>' . $height;
      if(!empty($width))
          $rsz[] = '"width"=>' . $width;

      $rsz = implode(",",$rsz);
      if(!empty($rsz))
          $rsz = "," . $rsz;
      else {
        $rsz = "";
      }


      $imgpath = '<?=$this->Media->image("' . $path . '" . $' . $ele->getAttribute("tplimage")  . ',["path"=>1' . $rsz .   '])?>';
      if($ele->tag == 'img'){
        if(empty($set)) $ele->src = $imgpath;
        else $ele->{$set} = $imgpath;
      }elseif ($ele->tag == 'a'){
          if(empty($set)) $ele->href = $imgpath;
          else $ele->{$set} = $imgpath;
      }

      $ele->removeAttribute("tplimage");
      $ele->removeAttribute("path");
      $ele->removeAttribute("set");


    }
    $this->_html = str_get_html($this->_html->save());
  }


  protected function process_var(){

    foreach($this->_html->find('[tplvar]') as $ele)
    {
       $var = $this->var_to_func($ele->getAttribute("tplvar"));
       $attr = $ele->getAttribute("set");

       $php_tag  = '<?=' . $var . '?>';
       if (empty($attr)):

       if($ele->tag == 'a')
             $ele->href = $php_tag;
       else if($ele->tag == 'tpl')
          $ele->outertext = $php_tag;
       else if($ele->tag == 'input')
             $ele->value = $php_tag;
       else if($ele->tag == 'form')
           $ele->action = $php_tag;
       else
          $ele->innertext = $php_tag;

       elseif ($attr == 'inline'):
           $ele->innertext = $php_tag;

       elseif ($attr == 'outline'):
           $ele->outertext = $php_tag;
       else:
           $ele->{$attr} = $php_tag;

       endif;

       $ele->removeAttribute("tplvar");
       $ele->removeAttribute("set");

    }
    $this->_html = str_get_html($this->_html->save());

    foreach($this->_html->find('[tplblock]') as $ele)
    {
        $var = $ele->getAttribute("tplblock");
        if(strpos($var,'(') === false)
          $var = '$this->start("' . $var . '")';
        else
          $var = $this->var_to_func($ele->getAttribute("tplblock"));
        $ele->removeAttribute("tplblock");
        $ele->outertext = '<?php ' . $var . ' ?>' . $ele . '<?php $this->end();?>';
    }

    foreach($this->_html->find('[tplform]') as $form)
      {

          $action = empty($form->getAttribute("tplform")) ? $form->getAttribute("action") : $form->getAttribute("tplform");
          $class = $form->getAttribute('class');
          $id = $form->getAttribute('id');
          $attr = array();
          $action = $this->Url->build(((strpos($action,'/')===false)?"/":"") . $action);
          $attr[] = '"url" => "'.$action .'"';
          if (isset($class) && !empty($class)) $attr[] = '"class" => "' . $class . '"';
          if (isset($id) && !empty($id)) $attr[] = '"id" => "' . $id . '"';

          $form->outertext = '<?=$this->Form->create(null, ['. implode(",", $attr) . '])?>' . $form->innertext . '<?=$this->Form->end()?>';
      }

      $this->_html = str_get_html($this->_html->save());

  }

  private function func_is_allowed($func){
      
      if(ctype_alpha($func[0]) == false)
      $func = substr($func, 1);
      $disable_functions = ['exec','passthru','system','shell_exec','popen','proc_open','pcntl_exec','eval','assert','preg_replace','create_function','include',
      'include_once','require','require_once','phpinfo','posix_mkfifo','posix_getlogin','posix_ttyname','getenv','get_current_user',
      'proc_get_status','get_cfg_var','disk_free_space','disk_total_space','diskfreespace','getcwd','getlastmo','getmygid','getmyinode','getmypid','getmyuid'
      ];
      if(in_array($func,$disable_functions) == true) return false; 
      return true;
  }


  private function var_to_func($var){
    if(strpos($var,'(') === false){
        return (strpos($var, '$') ===0 )?$var:'$' . $var;
    }else{
      preg_match('/([\w.\_\d]+)\(([\w\W]*)\)/', $var, $matches);
      if(is_array($matches) && sizeof($matches) > 0){
          
          $args = [];
          $funcName = $matches[1];
        
          if(strpos( $var, '@') ===0 ){
                 //$funcName = ltrim($funcName, '@');
            if($this->func_is_allowed($funcName) == false) return "";
          }
          else{
            $funcName = '$this->' . str_replace('.','->',$matches[1]);
          }
              
          if(!empty($matches[2]))
            $args = explode(',',$matches[2]);
               
          $ret = $funcName;
          $ret .= '(';
          foreach($args as $key=>$arg){
            if(!is_numeric($arg)){
                $fc =  substr(trim($arg), 0, 1);
                if ($fc != '$' AND $fc != '\'' AND $fc != '\"'){
                    $args[$key] = '"' . $arg . '"';
                }
            }
          }
          $ret .= implode(',',$args) . ")";
          return $ret;
      }

    }

  }




  protected function process_each(){
    foreach($this->_html->find('[tpleach]') as $ele)
    {
        
       $var = $this->var_to_func($ele->getAttribute("tpleach"));
       $setvar = $ele->getAttribute("set");
       $keyvar = 'key';
       if (!isset($setvar) || empty($setvar)) $setvar = 'val';

       $ele->removeAttribute("tpleach");
       $ele->removeAttribute("set");
       if(strpos($setvar,':') != false){
          $ar = explode(':',$setvar);
          $keyvar = $ar[0];
          $setvar = $ar[1];
       } 


       $ele->outertext = '<?php foreach(' . $var . ' as $' . $keyvar  .'=>$' . $setvar . '):   ?>' . $ele . '<?php endforeach; ?>';


    }
    $this->_html = str_get_html($this->_html->save());
    
    if($this->_html->find('[tpleach]'))
       $this->process_each();           

  }

  protected function store_var(){
      foreach($this->_html->find('[tplstorevar]') as $ele)
      {

          $var = $this->var_to_func($ele->getAttribute("tplstorevar"));
          $var_name = $ele->getAttribute("varname");

          if (empty($var_name)) $var_name = 'php_var';

          $ele->removeAttribute("tplstorevar");
          $ele->removeAttribute("varname");
          $ele->outertext = '<?php $' . $var_name  . ' = ' . $var  .'; ?>';

      }
      $this->_html = str_get_html($this->_html->save());
  }

    protected function process_user(){
        foreach($this->_html->find('[tpluser]') as $ele)
        {
            $user = $ele->getAttribute("tpluser");
            if ((int) $user == 1){
                $ele->outertext = '<?php if($this->Session->read("customer_logged_in")):   ?>' . $ele . '<?php endif; ?>';

            }elseif ((int) $user == 0){
                $ele->outertext = '<?php if($this->Session->read("customer_logged_in") == false):   ?>' . $ele . '<?php endif; ?>';

            }
            $ele->removeAttribute("tpluser");

        }
        $this->_html = str_get_html($this->_html->save());
    }

  protected function process_check(){
       foreach($this->_html->find('[tplcheck]') as $ele)
        {
            $check = $this->var_to_func($ele->getAttribute("tplcheck"));
            $method = $ele->getAttribute("method");
            if($this->func_is_allowed($method) == false) $method = '';
            $ele->removeAttribute("tplcheck");
            $ele->removeAttribute("method");
            if(!empty($method)) $check = $method . '(' . $check . ')';

            $ele->outertext = '<?php if(' .  $check .  '): ?>' . $ele .'<?php endif; ?>';

        }
        $this->_html = str_get_html($this->_html->save());

  }

  








}
