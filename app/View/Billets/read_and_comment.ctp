<div class="row" style="border: 1px solid black">
    <p><?= $billet['Billet']['title']; ?></p>
    <p><?= $billet['Billet']['tags']; ?></p>
    <p><?= $billet['Billet']['content']; ?></p>
    <p><?= $billet['Billet']['created']; ?></p>
    <p><?= $billet['Billet']['updated']; ?></p>
    <p><?= $billet['Billet']['user']; ?></p>
</div>

<?php foreach($comment as $key => $value): ?>
    <div class="row" style="border: 1px solid black">
        <p><?= $value['Comment']['user']; ?></p>
        <p><?= $value['Comment']['created']; ?></p>
        <p><?= $value['Comment']['content']; ?></p>
    </div>
<?php endforeach; ?>

<?= $this->Form->create('Comment'); ?>

    <?= $this->Form->input('content', array('label' => 'comment')); ?>

<?= $this->Form->end('Add Comment'); ?>