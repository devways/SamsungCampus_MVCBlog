<?php

class Comment extends AppModel {
    public function newComment($data, $user_id, $billet_id) {
        $this->save(array(
                'user_id' => $user_id,
                'billet_id' => $billet_id,
                'content' => $data['Comment']['content']
        ));
    }
}