<h1>EDIT BILLET</h1>

<?= $this->Form->create('Billet'); ?>

    <?= $this->Form->input('title', array('label' => 'title', 'value' => $title)); ?>
    <?= $this->Form->input('tags', array('label' => 'tags', 'value' => $tags)); ?>
    <?= $this->Form->input('content', array('label' => 'content', 'value' => $content)); ?>

<?= $this->Form->end('Edit Billet'); ?>