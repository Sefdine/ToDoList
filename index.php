<?php

declare(strict_types=1);
session_start();

require_once('src/controllers/home.php');
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
    }
}