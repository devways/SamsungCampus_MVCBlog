<?php

class BilletsController extends AppController {

    public $components = array('Paginator');

    public function news() {
        if($this->Auth->user() !== null && ($this->Auth->user('role') === 'Administrateur' || $this->Auth->user('role') === 'Blogueur')) {
            echo 'ici';
            if($this->request->is('post')) {
                $this->Billet->newBillet($this->request->data, $this->Auth->user('id'));
            }
        }  else {
            return $this->redirect('/homes');
        }
    }

    public function edit() {
        if($this->Auth->user() !== null && ($this->Auth->user('role') === 'Administrateur' || $this->Auth->user('role') === 'Blogueur')) {
        $data = $this->Billet->findById($this->request->params['id']);
        $this->set('tags', $data['Billet']['tags']);
        $this->set('title', $data['Billet']['title']);
        $this->set('content', $data['Billet']['content']);
        if($this->request->is('post') && $this->Auth->user('id') ==  $data['Billet']['user_id']) {
            $this->Billet->editBillet($this->request->data, $this->request->params['id'], $this->Auth->user('id'));
        }
                } else {
            return $this->redirect('/homes');
        }
    }

    public function delete() {
        if($this->Auth->user() !== null && ($this->Auth->user('role') === 'Administrateur' || $this->Auth->user('role') === 'Blogueur')) {        
        $data = $this->Billet->findById($this->request->params['id']);
        if($this->Auth->user('id') ==  $data['Billet']['user_id']) {
            $this->Billet->deleteBillet($this->request->params['id']);
        }
        } else {
            return $this->redirect('/homes');
        }
    }

    public function read() {
        if($this->Auth->user() !== null) {
        $this->loadModel('Comment');
        $this->loadModel('User');
        if(!isset($this->request->params['page'])){
            $offset = 0;
        } else {
            $offset = (2*($this->request->params['page']-1));
        }
        $data = $this->Billet->find('all', array(
            'limit' => '10',
            'offset' => $offset
        ));
         foreach($data as $key => &$value) {
            $user = $this->User->findById($value['Billet']['user_id']);
            $count = $this->Comment->find('count', array(
                'conditions' => array('comment.billet_id =' => $value['Billet']['id'])
            ));
            $value['Billet']['user'] = $user['User']['username'];
            $value['Billet']['comment'] = $count;
            $value['Billet']['content'] = $this->bbcodeFilter($value['Billet']['content']);
        }

        if($this->request->params['page']-1 > 0) {
            $precedant = $this->request->params['page']-1;
        } else {
            $precedant = 1;
        }
        $suivant = $this->request->params['page']+1;
        $this->set('data', $data);
        $this->set('page', $this->request->params['page']);
        $this->set('suivant', $suivant);
        $this->set('precedant', $precedant);
        } else {
            return $this->redirect('/homes');
        }
    }

    public function readAndComment() {
            if($this->Auth->user() !== null && ($this->Auth->user('role') === 'Administrateur' || $this->Auth->user('role') === 'Blogueur' || $this->Auth->user('role') === 'Commentateur')) {
            $this->loadModel('Comment');
            $this->loadModel('User');
            $billet = $this->Billet->findById($this->request->params['id']);
            $billet['Billet']['user'] = $this->User->findById($billet['Billet']['user_id'])['User']['username'];
            $billet['Billet']['content'] = $this->bbcodeFilter($billet['Billet']['content']);
            $comment = $this->Comment->find('all', array(
                'conditions' => array('comment.billet_id =' => $this->request->params['id'])
            ));
            foreach($comment as $key => &$value) {
                $user = $this->User->findById($value['Comment']['user_id']);
                $value['Comment']['user'] = $user['User']['username'];
            }

            if(isset($this->request->params['keywords'])) {
                $billet['Billet']['content'] = str_replace($this->request->params['keywords'], '<mark style="background-color: red;">'.$this->request->params['keywords'].'</mark>', $billet['Billet']['content']);
                $billet['Billet']['tags'] = str_replace($this->request->params['keywords'], '<mark style="background-color: red;">'.$this->request->params['keywords'].'</mark>', $billet['Billet']['tags']);
            }

            
            $this->set('billet', $billet);
            $this->set('comment', $comment);

            if($this->request->is('post')) {
                $this->Comment->newComment($this->request->data ,$this->Auth->user('id') ,$this->request->params['id']);
                return $this->redirect('/billet/'.$this->request->params['id']);
            }
        } else {
            return $this->redirect('/homes');
        }
    }

}