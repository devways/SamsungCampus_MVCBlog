<?php

class User extends AppModel {

    public $validate = array(
        'username' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'message' => 'Chiffres et lettres uniquement !'
            ),
            'between' => array(
                'rule' => array('lengthBetween', 3, 15),
                'message' => 'Entre 5 et 15 caractères'
            )
        ),
        'name' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'message' => 'Chiffres et lettres uniquement !'
            ),
            'between' => array(
                'rule' => array('lengthBetween', 3, 15),
                'message' => 'Entre 5 et 15 caractères'
            )
        ),
        'lastname' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'message' => 'Chiffres et lettres uniquement !'
            ),
            'between' => array(
                'rule' => array('lengthBetween', 3, 15),
                'message' => 'Entre 5 et 15 caractères'
            )
        ),
        'password' => array(
            'rule' => array('minLength', '8'),
            'message' => '8 caractères minimum'
        ),
        'email' => 'email',
        'birthday' => array(
            'rule' => 'date',
            'message' => 'Entrez une date valide',
            'allowEmpty' => true
        )
    );   

}