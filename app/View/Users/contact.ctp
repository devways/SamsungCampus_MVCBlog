<?= $this->Form->create('Contact'); ?>

    <?= $this->Form->input('subject', array('label' => 'subject')); ?>
    <?= $this->Form->input('content', array('label' => 'contenu')); ?>

<?= $this->Form->end('send'); ?>