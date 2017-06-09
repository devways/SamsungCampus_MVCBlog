<h3>Last User</h3>
<?php foreach($users as $key => $value): ?>
    <div class="row" style="border: 1px solid black">
        <p><?= $value['User']['username']; ?></p>
        <p><?= $value['User']['name']; ?></p>
        <p><?= $value['User']['lastname']; ?></p>
        <p><?= $value['User']['birthday']; ?></p>
        <p><?= $value['User']['created']; ?></p>
        <p><?= $value['User']['role']; ?></p>
    </div>
<?php endforeach; ?>

<h3>Last Billet</h3>
<?php foreach($billets as $key => $value): ?>
    <div class="row" style="border: 1px solid black">
        <p><?= $value['Billet']['title']; ?></p>
        <p><?= $value['Billet']['tags']; ?></p>
        <p><?= $value['Billet']['content']; ?></p>
        <p><?= $value['Billet']['created']; ?></p>
        <p><?= $value['Billet']['updated']; ?></p>
        <p><?= $value['Billet']['user']; ?></p>
    </div>
<?php endforeach; ?>

<h3>Last Comment</h3>
<?php foreach($comments as $key => $value): ?>
    <div class="row" style="border: 1px solid black">
        <p><?= $value['Comment']['created']; ?></p>
        <p><?= $value['Comment']['user']; ?></p>
        <p><?= $value['Comment']['content']; ?></p>
    </div>
<?php endforeach; ?>