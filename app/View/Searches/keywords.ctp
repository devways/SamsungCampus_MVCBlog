<?php foreach($data as $key => $value): ?>
    <div class="row" style="border: 1px solid black">
        <?= $this->Html->link($value['Billet']['title'], "/billet/".$value['Billet']['id']."/search/".$value['Billet']['keywords']); ?>
        <p><?= $value['Billet']['tags']; ?></p>
        <p><?= $value['Billet']['content']; ?></p>
        <p><?= $value['Billet']['created']; ?></p>
        <p><?= $value['Billet']['updated']; ?></p>
        <p><?= $value['Billet']['user']; ?></p>
        <?= $this->Html->link($value['Billet']['comment'].' comment', "/billet/".$value['Billet']['id']."/search/".$value['Billet']['keywords']); ?>
    </div>
<?php endforeach; ?>
