<?php

declare(strict_types=1);

require_once('src/models/database.php');

function displayHome(string $err='', int $open=0) {
    $data = selectLists();
    $completes = selectCompleted();
    $completed = 3;
    require_once('templates/error.php');
    require_once('templates/home.php');
    require_once('templates/display_list.php');
}

function submitForm(string $title, string $description='') {
    insert($title, $description);
    displayHome();
}

function setComplete(int $id) {
    setCompleted($id);
    displayHome();
}

function setUncomplete(int $id) {
    setUnompleted($id);
    displayHome();
}

function Remove(int $id) {
    Delete($id);
    displayHome();
}