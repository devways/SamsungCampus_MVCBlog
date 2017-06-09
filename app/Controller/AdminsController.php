<?php

class AdminsController extends AppController {

    public function index() {
        if($this->Auth->user() !== null && $this->Auth->user('role') === 'Administrateur') {
            $this->loadModel('User');
            $this->loadModel('Billet');
            $this->loadModel('Comment');
            $comment = $this->Comment->find('all', array(
                'order' => array('comment.created ASC'),
                'limit' => '10' 
            ));
            foreach($comment as $key => &$value) {
                $user = $this->User->findById($value['Comment']['user_id']);
                $value['Comment']['user'] = $user['User']['username'];
            }
            $billet = $this->Billet->find('all', array(
                'order' => array('billet.created ASC'),
                'limit' => '10'
            ));
            foreach($billet as $key => &$value) {
                $user = $this->User->findById($value['Billet']['user_id']);
                $value['Billet']['user'] = $user['User']['username'];
                $value['Billet']['content'] = $this->bbcodeFilter($value['Billet']['content']);
            }
            $user = $this->User->find('all', array(
                'order' => array('user.created ASC'),
                'limit' => '10'
            ));
            $this->set('billets', $billet);
            $this->set('comments', $comment);
            $this->set('users', $user);
        } else {
            return $this->redirect('/homes');
        }
    }

    public function users() {
        if($this->Auth->user() !== null && $this->Auth->user('role') === 'Administrateur') {
            $this->loadModel('User');

            $user = $this->User->find('all', array(
                'order' => array('user.created ASC'),
                'limit' => '10',
                'offset' => '0'
            ));
            foreach($user as $key => &$value) {
                $status = $this->User->findById($value['User']['id']);
                $value['User']['status'] = ($status['User']['active'] === '0')?'activer':'desactiver';
            }
            $this->set('users', $user);
        } else {
            return $this->redirect('/homes');
        }
    }

    public function billets() {
        if($this->Auth->user() !== null && $this->Auth->user('role') === 'Administrateur') {
            $this->loadModel('User');
            $this->loadModel('Billet');
            $billet = $this->Billet->find('all', array(
                'order' => array('billet.created ASC'),
                'limit' => '10',
                'offset' => '0'
            ));
            foreach($billet as $key => &$value) {
                $user = $this->User->findById($value['Billet']['user_id']);
                $value['Billet']['user'] = $user['User']['username'];
                $value['Billet']['content'] = $this->bbcodeFilter($value['Billet']['content']);
            }
            $this->set('billets', $billet);
        } else {
            return $this->redirect('/homes');
        }
    }

    public function comments() {
        if($this->Auth->user() !== null && $this->Auth->user('role') === 'Administrateur') {
            $this->loadModel('User');
            $this->loadModel('Billet');
            $this->loadModel('Comment');
            $comment = $this->Comment->find('all', array(
                'order' => array('comment.created ASC'),
                'limit' => '10',
                'offset' => '0'
            ));
            foreach($comment as $key => &$value) {
                $user = $this->User->findById($value['Comment']['user_id']);
                $value['Comment']['user'] = $user['User']['username'];
            }
            $this->set('comments', $comment);
        } else {
            return $this->redirect('/homes');
        }
    }

    public function status() {
        if($this->Auth->user() !== null && $this->Auth->user('role') === 'Administrateur') {
            $this->loadModel('User');
            $user = $this->User->findById($this->request->params['id']);
            $active = $user['User']['active'] === '0' ? 1 : 0;
            $this->User->save(array(
                'id' => $this->request->params['id'],
                'username' => $user['User']['username'],
                'name' => $user['User']['name'],
                'lastname' => $user['User']['lastname'],
                'email' => $user['User']['email'],
                'password' => $user['User']['password'],
                'birthday' => $user['User']['birthday'],
                'active' => $active,
            ));
            return $this->redirect('/admin/users');
        } else {
            return $this->redirect('/homes');
        }
    }
}