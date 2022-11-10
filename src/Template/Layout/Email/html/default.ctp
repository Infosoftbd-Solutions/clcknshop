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
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Configure;
  //  extract($this->viewVars);

//    pr($this->viewVars);

    $store = json_decode(Configure::read('App.store'));
    $this->Tplparser->setTheme(Configure::read('App.theme'));

    $template_path = $this->Tplparser->compile("email/layout.tpl");
    if ($template_path === false) $template_path = EMAIL_DEFAULT. "layout.ctp";

    include_once $template_path;

?>
