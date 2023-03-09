
<?php ob_start() ?>
<div class="container_tasks">
    <h2><?= ucfirst($data->title) ?></h2>
    <label>Created at : <?= $date->format('Y-m-d') ?></label>
    <p><?= ucfirst($data->description) ?></p>
    <br>
    <div class="items_links">
        <a href="index.php?action=displayTask&open=1&id=<?= $data->id ?>" class="update"><i class="bi bi-arrow-counterclockwise"></i> Update</a>
        <?php if ($data->status == 0): ?>
            <a href="index.php?action=complete&id=<?= $data->id ?>" class="completed"><i class="bi bi-check2-circle"> Completed</i></a>
        <?php else : ?>
            <a href="index.php?action=uncomplete&id=<?= $data->id ?>" class="uncompleted"><i class="bi bi-arrow-left-circle"> Uncompleted</i></a>
        <?php endif ?>
        <a href="index.php?action=remove&id=<?= $data->id ?>" class="remove"><i class="bi bi-trash"> Remove</i></a>
    </div>
    <br>
    <a href="index.php?action=home" class="back_home">Back to the home screen</a>
</div>
<?php if ($open == 1): ?>
<div class="form_tasks">
    <br>
    <hr>
    <br>
    <h2 style="text-align:center;">Updating task</h2>
    <form action="index.php?action=submit_form_tasks&id=<?= $data->id ?>" method="post" class="form-todo">
        <div class="form-contr">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?= ucfirst($data->title) ?>" required>
        </div>
        <div class="form-contr">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" value="<?= ucfirst($data->description) ?>">
        </div>
        <input type="submit" value="Sumbit">
    </form>
</div>
<?php endif ?>
<?php 
$content = ob_get_clean();
require_once('templates/layout.php'); 
?>
