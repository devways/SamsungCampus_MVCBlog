<?php

class Billet extends AppModel {

    public $validate = array(
        'title' => array(
            'alphaNumeric' => array(
                'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
                'required' => true,
                'message' => 'Chiffres et lettres uniquement !'
            ),
            'between' => array(
                'rule' => array('lengthBetween', 3, 35),
                'message' => 'Entre 5 et 15 caractères'
            )
        ),
        'tags' => array(
            'alphaNumeric' => array(
                'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
                'required' => true,
                'message' => 'Chiffres et lettres uniquement !'
            ),
            'between' => array(
                'rule' => array('lengthBetween', 3, 35),
                'message' => 'Entre 5 et 15 caractères'
            )
        ),
        'content' => array(
            'between' => array(
                'rule' => array('lengthBetween', 3, 900),
                'message' => 'Entre 5 et 15 caractères'
            )
        )
    );

    public function newBillet($data, $id) {
        $this->save(array(
                'title' => $data['Billet']['title'],
                'tags' => $data['Billet']['tags'],
                'content' => $data['Billet']['content'],
                'user_id' => $id
        ));
    }
    
    public function editBillet($data, $id) {
        $this->save(array(
                'id' => $id,
                'title' => $data['Billet']['title'],
                'tags' => $data['Billet']['tags'],
                'content' => $data['Billet']['content']
        ));
    }

    public function deleteBillet($id) {
        $this->delete($id);
    }

}