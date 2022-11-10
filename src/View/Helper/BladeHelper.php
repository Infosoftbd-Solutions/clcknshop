<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use eftec\bladeone\BladeOne;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
/**
 * TablerForm helper
 */

 trait TraitHelper
 {
     /**
      * We create the new tags @hello <br>
      * The name of the method must starts with "compile"<br>
      * <b>Example:</b><br>
      * <pre>
      * @hello()
      * @hello("name")
      * </pre>
      *
      * @param null|string $expression expects a value like null, (), ("hello") or ($somevar)
      * @return string returns a fragment of code (php and html)
      */

     public function compileLink($slug = null)
     {
       $root =  Router::url("/");
       return "<?php echo '$root' . $slug ; ?>";
     }

     protected function compilePhp($expression)
     {
         return '';
     }

     //<editor-fold desc="setter and getters">

     /**
      * Compile end-php statement into valid PHP.
      *
      * @return string
      */
     protected function compileEndphp()
     {
         return '';
     }

     /**
      * Compile the "regular" echo statements. {{ }}
      *
      * @param string $value
      * @return string
      */
     protected function compileRegularEchos($value)
     {
         $pattern = \sprintf('/(@)?%s\s*(.+?)\s*%s(\r?\n)?/s', $this->contentTags[0], $this->contentTags[1]);
         $callback = function ($matches) {
             if (substr($matches[2], 0, 1) === '$'){
               $whitespace = empty($matches[3]) ? '' : $matches[3] . $matches[3];
               $wrapped = \sprintf($this->echoFormat, $this->compileEchoDefaults($matches[2]));
               return $matches[1] ? \substr($matches[0], 1) : $this->phpTagEcho . $wrapped . '; ?>' . $whitespace;
             }else {
               return "";
             }

         };
         return \preg_replace_callback($pattern, $callback, $value);
     }

     protected function compileEach($expression)
     {
         return "<?php foreach $expression: ?>";
     }

     protected function compileEndeach($expression)
     {
          return "<?php endforeach; ?>";
     }

 }

 class CakeBladeOne extends BladeOne
 {
     use TraitHelper;
 }

class BladeHelper extends Helper
{
  protected $_blade = null;
  public $helpers = array('Html','Url');
  public function initialize(array $config)
  {
    $tplroot =  WWW_ROOT .  DS . "themes";
    $baseurl = $this->Url->build("/themes");
    if(isset($this->_View->viewVars['theme'])){
      $tplroot .= DS . $this->_View->viewVars['theme'] . DS . "templates";
      $baseurl = $this->Url->build("/themes/" . $this->_View->viewVars['theme'] );

    }


    $this->_blade = new CakeBladeOne( $tplroot,TMP . DS . "blade", BladeOne::MODE_DEBUG);
    $this->_blade->setBaseUrl($baseurl . "/assets");
    $this->_blade->setCompiledExtension(".bladec.ctp");

  }

  public function render($template,$var = array()){
//    pr($this->_View->viewVars);
    try {
      //  echo $this->_blade->runString('<p>{{$direccion}}</p>', ['direccion' => 'Some address 20 #33-58']);
      return $this->_blade->run($template,array_merge($this->_View->viewVars,$var,['tpl'=>$this]));
    } catch (Exception $e) {
        echo "error found ".$e->getMessage()."<br>".$e->getTraceAsString();
    }
  }

  public function compile($template){
     $this->_blade->compile($template);
  }


  public function collectionsLink($collection){
    return $this->Url->build("/collection/" . $collection);

  }
  public function product($id){

    $Products = TableRegistry::get('Products');
    $product = $Products->get($id);
    $product->link = "test";
    return $product;

  }




}
