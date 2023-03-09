<?php

declare(strict_types=1);
session_start();

require_once('src/controllers/home.php');
require_once('src/controllers/task.php');

$action = $_GET['action'] ?? '';
if(!$action) {
    displayHome();
} else {
    if ($action == 'home') {
        $open = (int)$_GET['open'] ?? 0;
        if ($open) {
            if ($_SESSION['open']) {
                $_SESSION['open'] = 0;
            } else {
                $_SESSION['open'] = 1;
            }
        }

        $sess_open = $_SESSION['open'] ?? 0;
        $err = $_GET['error'] ?? '';
        displayHome($err, $sess_open);
    } elseif ($action == 'submit_form_todo') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            submitForm($title, $description, $err);
        } else {
            die('error server request method');
        }
    } elseif ($action == 'complete') {
        $id = (int)$_GET['id'] ?? 0;
        setComplete($id);
    } elseif ($action == 'uncomplete') {
        $id = (int)$_GET['id'] ?? 0;
        setUncomplete($id);
    } elseif ($action == 'remove') {
        $id = (int)$_GET['id'] ?? 0;
        Remove($id);
    } elseif ($action == 'displayTask') {
        $open = (isset($_GET['open'])) ? $_GET['open'] : 0;
        if ($open) {
            if ($_SESSION['open']) {
                $_SESSION['open'] = 0;
            } else {
                $_SESSION['open'] = 1;
            }
        }
        $sess_open = $_SESSION['open'] ?? 0;
        $id = (int)$_GET['id'] ?? 0;
        $err = $_GET['error'] ?? '';
        displayTask($id, $sess_open, $err);
    } elseif ($action == 'submit_form_tasks') {
        $id = (int)$_GET['id'] ?? 0;
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        updateTask($id, $title, $description);
    }
}