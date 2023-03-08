<?php

function connect(){
    $host = 'localhost';
    $user = 'root';
    $pass = 'root';
    $db = 'todo_list';

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die('Connection failed: '.$conn->connect_error);
    }
    return $conn;
}

function insert(string $title, string $description=''){
    $now = date('Y-m-d h:m:s');
    $conn = connect();
    $sql = "INSERT INTO todo_list (title, description, date_submit) VALUES ('$title', '$description', '$now')";
    if ($conn->query($sql) == TRUE) {
        header('Location: index.php?action=home&error=insert_success');
    } else {
        header('Location: index.php?action=home&error=insert_failed');
    }
    $conn->close();
}

function selectLists() {
    $conn = connect();
    $sql = 'SELECT id, title FROM todo_list WHERE status = 0 ORDER BY id ASC';
    $result = $conn->query($sql);
    $data = [];
    if ($result) {
        while ($row = $result->fetch_object()) {
            $data[] = $row;
        }
        $result->close();
    }
    $conn->close();
    return $data;
}

function selectCompleted() {
    $conn = connect();
    $sql = 'SELECT id, title FROM todo_list WHERE status = 1 ORDER BY id ASC';
    $result = $conn->query($sql);
    $data = [];
    if ($result) {
        while ($row = $result->fetch_object()) {
            $data[] = $row;
        }
        $result->close();
    }
    $conn->close();
    return $data;
}

function setCompleted(int $id) {
    $conn = connect();
    $sql = "UPDATE todo_list SET status = 1 WHERE id = $id";
    $result = $conn->query($sql);
    if ($result) {
        header('Location: index.php?action=home&error=completed');
    } else {
        header('Location: index.php?action=home&error=errcompleted');
    }
    $result->close();
    $conn->close();
}

function setUnompleted(int $id) {
    $conn = connect();
    $sql = "UPDATE todo_list SET status = 0 WHERE id = $id";
    $result = $conn->query($sql);
    if ($result) {
        header('Location: index.php?action=home&error=uncompleted');
    } else {
        header('Location: index.php?action=home&error=errcompleted');
    }
    $result->close();
    $conn->close();
}

function Delete(int $id) {
    $conn = connect();
    $sql = "DELETE FROM todo_list WHERE id = $id";
    $result = $conn->query($sql);
    if ($result) {
        header('Location: index.php?action=home&error=deleted');
    } else {
        header('Location: index.php?action=home&error=errdeleted');
    }
    $result->close();
    $conn->close();
}