<?php

declare(strict_types=1);

require_once('src/models/database.php');

function displayTask(int $id, int $open=0, string $err = '') {
    $data = getData($id);
    $date = new DateTime($data->date_submit);
    require_once('templates/error.php');
    require_once('templates/task.php');
}

function updateTask(int $id, string $title, string $description) {
    setTask($id, $title, $description);
}