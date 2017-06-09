<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array('Session', 'Cookie', 'Auth');

    public function beforeFilter() {
        parent::beforeFilter();
        if($this->Auth->user() !== null && $this->Auth->user('role') === 'Administrateur') {
            $this->Auth->allow();
            $this->Auth->deny('login','subscribe');
        } else if($this->Auth->user() !== null && $this->Auth->user('role') === 'Blogueur') {
            $this->Auth->allow('billets');
            $this->Auth->deny('/admin/index');
        } else if($this->Auth->user() !== null && $this->Auth->user('role') === 'Commentateur') {
            $this->Auth->allow();
            $this->Auth->deny();
        } else {
            $this->Auth->allow('login', 'subscribe');
            $this->Auth->deny();
        }
        
    }

    public function bbcodeFilter($str) {
        $arrayBBCode=array(
            'i'=>        array('type'=>BBCODE_TYPE_NOARG, 'open_tag'=>'<i>',
                            'close_tag'=>'</i>', 'childs'=>'b,s'),
            'url'=>      array('type'=>BBCODE_TYPE_OPTARG,
                            'open_tag'=>'<a href="{PARAM}">', 'close_tag'=>'</a>',
                            'default_arg'=>'{CONTENT}',
                            'childs'=>'s,b,i,img'),
            'img'=>      array('type'=>BBCODE_TYPE_NOARG,
                            'open_tag'=>'<img src="', 'close_tag'=>'" />',
                            'childs'=>''),
            'b'=>        array('type'=>BBCODE_TYPE_NOARG, 'open_tag'=>'<b>',
                            'close_tag'=>'</b>', 'childs'=>'i,s'),
            's'=>        array('type'=>BBCODE_TYPE_NOARG, 'open_tag'=>'<u>',
                            'close_tag'=>'</u>', 'childs'=>'b,i'),
            'mark'=>    array('type'=>BBCODE_TYPE_NOARG, 'open_tag'=>'<mark>',
                            'close_tag'=>'</mark>', 'childs'=>'b,i,s'),
            'video'=>   array('type'=>BBCODE_TYPE_OPTARG,
                            'open_tag'=>'<video src="{PARAM}">', 'close_tag'=>'</video>',
                            'default_arg'=>'{CONTENT}',
                            'childs'=>''),
        );
        $BBHandler=bbcode_create($arrayBBCode);
        return bbcode_parse($BBHandler,$str);
    }

    public function mail($to, $subject, $sender, $user) {
        debug($to);
        debug($subject);
        debug($sender);
        debug($user);
        App::uses('CakeEmail', 'Network/Email');
        $email = new CakeEmail('default');
        $email->to($to);
        $email->subject($subject);
        debug($email->send($user.'----------'.$sender));
        die();
    }

}
