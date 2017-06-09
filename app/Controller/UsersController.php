<?php

class UsersController extends AppController {

    public function index($prenom) {
        $this->layout='default';
        $this->set('prenom', $prenom);

        // debug($this->User->find('all', array(
        //     'fields' => array('User.id', 'User.email'),
        //     'conditions' => array('User.id =' => '2'),
        //     'order' => array('User.id ASC')
        // )));

        // debug($this->User->findById('1'));

        // $this->User->save(array(
        //     'username' => 'tomandjerry',
        //     'name' => 'tom',
        //     'lastname' => 'jerry',
        //     'birthday' => '1999-11-15',
        //     'email' => 'tom@jerry.wipe',
        //     'password' => '000',
        // ));

        // $this->User->id = 3;

        // $this->User->saveField('name', 'tom');
    
        // debug($this->User->find('all'));

        // find('', array())
        // field('nom')
        // read('User.id', 'User.name')

        // save(array())
        // create()
        // saveField('nom')

        // delete(id)
        // deleteAll(array()/boleean)
    }

    public function subscribe() {
        if($this->Auth->user() === null) {
        if($this->request->is('post')) {
            $username = $this->User->find('all', array(
                'conditions' => array('User.username =' => $this->request->data['User']['username']))
            );
            if(empty($username)) {
                $this->User->create();
                $this->User->save(array(
                    'username' => $this->request->data['User']['username'],
                    'name' => $this->request->data['User']['name'],
                    'lastname' => $this->request->data['User']['lastname'],
                    'email' => $this->request->data['User']['email'],
                    'password' => $this->request->data['User']['password'],
                    'birthday' => $this->request->data['User']['birthday'])
                );
            }
        }
        } else {
            return $this->redirect('/homes');
        }
    }

    public function login() {
        if($this->Auth->user() === null) {
        if(!empty($this->request->data)) {
            if($this->Auth->login()){
                
            }
        }
        }
    }

    public function logout() {
        if($this->Auth->user() !== null) {
        $this->Auth->logout();
        }
        return $this->redirect('/homes');
    }

    public function contact() {
        if($this->Auth->user() !== null) {
        debug(time());
        if($this->request->is('post')) {
            $user = $this->User->findById($this->Auth->user('id'));
            debug($user);
            if($user['User']['timme'] !== NULL) {
                $tab = explode(';', $user['User']['timme']);
                debug(count($tab));
                if(count($tab) >= 3) {
                    if(time() - $tab[0] > 60000) {
                        $time = substr($user['User']['timme'], 11, 11).time().';';
                        $this->User->save(array(
                            'id' => $this->Auth->user('id'),
                            'password' => $this->Auth->user('password'),
                            'username' => $this->Auth->user('username'),
                            'name' => $this->Auth->user('name'),
                            'lastname' => $this->Auth->user('lastname'),
                            'birthday' => $this->Auth->user('birthday'),
                            'email' => $this->Auth->user('email'),
                            'timme' => strval($time)
                        ));
                        $admin = $this->User->find('all', array('conditions' => array('role =' => 'Administrateur')));
                        $this->mail($admin, $this->request->params['subject'], $this->request->params['content'], $this->Auth->user('username'));
                    } else if(time() - $tab[1] > 60000) {
                        $time = substr($user['User']['timme'], 0, 11).time().';';
                        $this->User->save(array(
                            'id' => $this->Auth->user('id'),
                            'password' => $this->Auth->user('password'),
                            'username' => $this->Auth->user('username'),
                            'name' => $this->Auth->user('name'),
                            'lastname' => $this->Auth->user('lastname'),
                            'birthday' => $this->Auth->user('birthday'),
                            'email' => $this->Auth->user('email'),
                            'timme' => strval($time)
                        ));
                    }
                } else {
                    $time = $user['User']['timme'].time().';';
                    $this->User->save(array(
                        'id' => $this->Auth->user('id'),
                        'password' => $this->Auth->user('password'),
                        'username' => $this->Auth->user('username'),
                        'name' => $this->Auth->user('name'),
                        'lastname' => $this->Auth->user('lastname'),
                        'birthday' => $this->Auth->user('birthday'),
                        'email' => $this->Auth->user('email'),
                        'timme' => strval($time)
                    ));
                }
                
            } else {
                $time = time().';';
                $this->User->save(array(
                    'id' => $this->Auth->user('id'),
                    'password' => $this->Auth->user('password'),
                    'username' => $this->Auth->user('username'),
                    'name' => $this->Auth->user('name'),
                    'lastname' => $this->Auth->user('lastname'),
                    'birthday' => $this->Auth->user('birthday'),
                    'email' => $this->Auth->user('email'),
                    'timme' => strval($time)
                ));
                $admin = $this->User->find('all', array('conditions' => array('role =' => 'Administrateur'), 'fields' => array('user.email')));
                foreach($admin as $key => &$value) {
                    $value = $value['User']['email'];
                }
                $this->mail($admin, $this->request->data['Contact']['subject'], $this->request->data['Contact']['content'], $this->Auth->user('username'));
            }
        }
        } else {
            return $this->redirect('/homes');
        } 
    }

}