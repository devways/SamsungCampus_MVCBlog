<?= $this->Html->link('precendant', "/billet/page/$precedant"); ?>
<?= $this->Html->link($page, "/billet/page/".$page); ?>
<?= $this->Html->link('suivant', "/billet/page/$suivant"); ?>
<?php foreach($data as $key => $value): ?>
    <div class="row" style="border: 1px solid black">
        <p><?= $value['Billet']['title']; ?></p>
        <p><?= $value['Billet']['tags']; ?></p>
        <p><?= $value['Billet']['content']; ?></p>
        <p><?= $value['Billet']['created']; ?></p>
        <p><?= $value['Billet']['updated']; ?></p>
        <p><?= $value['Billet']['user']; ?></p>
        <?= $this->Html->link($value['Billet']['comment'].' comment', "/billet/".$value['Billet']['id']); ?>
    </div>
<?php endforeach; ?>