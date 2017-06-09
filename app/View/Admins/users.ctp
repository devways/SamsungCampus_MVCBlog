<h3>User</h3>
<?php foreach($users as $key => $value): ?>
    <div class="row" style="border: 1px solid black">
        <p><?= $value['User']['username']; ?></p>
        <p><?= $value['User']['name']; ?></p>
        <p><?= $value['User']['lastname']; ?></p>
        <p><?= $value['User']['birthday']; ?></p>
        <p><?= $value['User']['created']; ?></p>
        <p><?= $value['User']['role']; ?></p>
        <?= $this->Html->link($value['User']['status'], "/admin/status/".$value['User']['id']); ?>
    </div>
<?php endforeach; ?>