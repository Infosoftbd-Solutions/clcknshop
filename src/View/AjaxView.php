<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.0.4
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use Cake\Event\EventManager;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * A view class that is used for AJAX responses.
 * Currently only switches the default layout and sets the response type -
 * which just maps to text/html by default.
 */

 class ClckTplEngine {

 	static $blocks = array();
 	static $cache_path = TMP . DS . 'cache/';
 	static $cache_enabled = FALSE;

 	static function view($file, $data = array()) {
 		$cached_file = self::cache($file);
 	    extract($data, EXTR_SKIP);
 	   	require $cached_file;
 	}

 	static function cache($file) {
 		if (!file_exists(self::$cache_path)) {
 		  	mkdir(self::$cache_path, 0744);
 		}
 	    $cached_file = self::$cache_path . str_replace(array('/', '.html'), array('_', ''), $file . '.php');
 	    if (!self::$cache_enabled || !file_exists($cached_file) || filemtime($cached_file) < filemtime($file)) {
 			$code = self::includeFiles($file);
 			$code = self::compileCode($code);
 	        file_put_contents($cached_file, '<?php class_exists(\'' . __CLASS__ . '\') or exit; ?>' . PHP_EOL . $code);
 	    }
 		return $cached_file;
 	}

 	static function clearCache() {
 		foreach(glob(self::$cache_path . '*') as $file) {
 			unlink($file);
 		}
 	}

 	static function compileCode($code) {
 		$code = self::compileBlock($code);
 		$code = self::compileYield($code);
 		$code = self::compileEscapedEchos($code);
 		$code = self::compileEchos($code);
 		$code = self::compilePHP($code);
 		return $code;
 	}

 	static function includeFiles($file) {
 		$code = file_get_contents($file);
 		preg_match_all('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', $code, $matches, PREG_SET_ORDER);
 		foreach ($matches as $value) {
 			$code = str_replace($value[0], self::includeFiles($value[2]), $code);
 		}
 		$code = preg_replace('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', '', $code);
 		return $code;
 	}

 	static function compilePHP($code) {
 		return preg_replace('~\{%\s*(.+?)\s*\%}~is', '<?php $1 ?>', $code);
 	}

 	static function compileEchos($code) {
 		return preg_replace('~\{{\s*(.+?)\s*\}}~is', '<?php echo $1 ?>', $code);
 	}

 	static function compileEscapedEchos($code) {
 		return preg_replace('~\{{{\s*(.+?)\s*\}}}~is', '<?php echo htmlentities($1, ENT_QUOTES, \'UTF-8\') ?>', $code);
 	}

 	static function compileBlock($code) {
 		preg_match_all('/{% ?block ?(.*?) ?%}(.*?){% ?endblock ?%}/is', $code, $matches, PREG_SET_ORDER);
 		foreach ($matches as $value) {
 			if (!array_key_exists($value[1], self::$blocks)) self::$blocks[$value[1]] = '';
 			if (strpos($value[2], '@parent') === false) {
 				self::$blocks[$value[1]] = $value[2];
 			} else {
 				self::$blocks[$value[1]] = str_replace('@parent', self::$blocks[$value[1]], $value[2]);
 			}
 			$code = str_replace($value[0], '', $code);
 		}
 		return $code;
 	}

 	static function compileYield($code) {
 		foreach(self::$blocks as $block => $value) {
 			$code = preg_replace('/{% ?yield ?' . $block . ' ?%}/', $value, $code);
 		}
 		$code = preg_replace('/{% ?yield ?(.*?) ?%}/i', '', $code);
 		return $code;
 	}

 }

  
class AjaxView extends AppView
{

    /**
     * The name of the layout file to render the view inside of. The name
     * specified is the filename of the layout in /src/Template/Layout without
     * the .ctp extension.
     *
     * @var string
     */
    public $layout = 'ajax';

    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->response = $this->response->withType('ajax');
    }
}
