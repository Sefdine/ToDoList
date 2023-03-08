
<div class="container">
    <a href="index.php?action=home&open=1">Completed(<?= $completed ?>)</a>
    <br>
    <div class="closed">
        <?php if ($open == 1):?>
            <?php foreach($completes as $item): ?>
                <div class="display_list">
                    <p><?= $item->title ?></p>
                    <a href="index.php?action=uncomplete&id=<?= $item->id ?>" class="uncompleted"><i class="bi bi-arrow-left-circle"> Uncompleted</i></a>
                    <a href="index.php?action=remove&id=<?= $item->id ?>" class="remove"><i class="bi bi-trash"> Remove</i></a>
                </div>
            <?php endforeach; ?>
        <?php endif ?>
        <hr>
    </div>
    <div class="list">
        <?php foreach($data as $item): ?>
            <div class="display_list">
                <p><?= $item->title ?></p>
                <a href="index.php?action=complete&id=<?= $item->id ?>" class="completed"><i class="bi bi-check2-circle"> Completed</i></a>
                <a href="index.php?action=remove&id=<?= $item->id ?>" class="remove"><i class="bi bi-trash"> Remove</i></a>
            </div>
        <?php endforeach; ?>
    </div>
</div>



        