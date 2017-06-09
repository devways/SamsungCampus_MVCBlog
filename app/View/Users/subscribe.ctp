<h1>subscribe</h1>

<?= $this->Form->create('User'); ?>

    <?= $this->Form->input('username', array('label' => 'username')); ?>
    <?= $this->Form->input('name', array('label' => 'name')); ?>
    <?= $this->Form->input('lastname', array('label' => 'lastname')); ?>
    <?= $this->Form->input('birthday', array('label' => 'birthday')); ?>
    <?= $this->Form->input('password', array('label' => 'password')); ?>
    <?= $this->Form->input('email', array('label' => 'email')); ?>

<?= $this->Form->end('subscribe'); ?>