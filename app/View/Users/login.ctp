<h1>login</h1>

<?php if(!AuthComponent::user()): ?>
<?= $this->Form->create('User'); ?>

    <?= $this->Form->input('username', array('label' => 'username')); ?>
    <?= $this->Form->input('password', array('label' => 'password')); ?>

<?= $this->Form->end('login'); ?>
<?php else: ?>
    <?= AuthComponent::user('username'); ?>
<?php endif; ?>