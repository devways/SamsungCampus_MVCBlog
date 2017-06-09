<h3>Billet</h3>
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