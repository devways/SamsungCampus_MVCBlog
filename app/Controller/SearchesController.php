<?php

class SearchesController extends AppController {

    public function index() {
        if($this->Auth->user() !== null) {
        return $this->redirect('/search/'.$this->request->data['searches']['keywords']);
        }  else {
            return $this->redirect('/homes');
        }
    }

    public function keywords() {
        if($this->Auth->user() !== null) {
        $this->loadModel('Billet');
        $this->loadModel('Comment');
        $this->loadModel('User');
        $billet = $this->Billet->find('all', array(
            'order' => 'Billet.title ASC'
        ));
        $data = [];
        foreach($billet as $key => $value) {
            $lev = levenshtein($value['Billet']['tags'], $this->request->params['keywords']);
            $lev2 = strpos($value['Billet']['content'], $this->request->params['keywords']);
            if($lev < 5 || $lev2 !== false) {
                $data[] = $value;
                    foreach($data as $key => &$values) {
                    $user = $this->User->findById($values['Billet']['user_id']);
                    $count = $this->Comment->find('count', array(
                        'conditions' => array('comment.billet_id =' => $values['Billet']['id'])
                    ));
                    $values['Billet']['user'] = $user['User']['username'];
                    $values['Billet']['comment'] = $count;
                    $values['Billet']['content'] = $this->bbcodeFilter($value['Billet']['content']);
                    $values['Billet']['keywords'] = $this->request->params['keywords'];
                }
            }
        }
        $this->set('data', $data);
        } else {
            return $this->redirect('/homes');
        }
    }
}