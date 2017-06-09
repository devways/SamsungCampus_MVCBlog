<h1>NEW BILLET</h1>

<?= $this->Form->create('Billet'); ?>

    <?= $this->Form->input('title', array('label' => 'title')); ?>
    <?= $this->Form->input('tags', array('label' => 'tags')); ?>
    <?= $this->Form->input('content', array('label' => 'content')); ?>

<?= $this->Form->end('Add Billet'); ?>