<h3>Comment</h3>
<?php foreach($comments as $key => $value): ?>
    <div class="row" style="border: 1px solid black">
        <p><?= $value['Comment']['created']; ?></p>
        <p><?= $value['Comment']['user']; ?></p>
        <p><?= $value['Comment']['content']; ?></p>
    </div>
<?php endforeach; ?>