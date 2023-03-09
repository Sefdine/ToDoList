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
    $conn = connect();
    $sql = "INSERT INTO todo_list (title, description) VALUES ('$title', '$description')";
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
    $sql = "UPDATE todo_list SET status = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    if ($result) {
        header('Location: index.php?action=home&error=completed');
    } else {
        header('Location: index.php?action=home&error=errcompleted');
    }
    $stmt->close();
    $conn->close();
}


function setUnompleted(int $id) {
    $conn = connect();
    $sql = "UPDATE todo_list SET status = 0 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $result = $stmt->execute();
    if ($result) {
        header('Location: index.php?action=home&error=uncompleted');
    } else {
        header('Location: index.php?action=home&error=errcompleted');
    }
    $stmt->close();
    $conn->close();
}

function Delete(int $id) {
    $conn = connect();
    $sql = "DELETE FROM todo_list WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $result = $stmt->execute();
    if ($result) {
        header('Location: index.php?action=home&error=deleted');
    } else {
        header('Location: index.php?action=home&error=errdeleted');
    }
    $stmt->close();
    $conn->close();
}

function selectCount(){
    $conn = connect();
    $sql = 'SELECT counts FROM completed';
    $result = $conn->query($sql);
    if($result === false){
        $count = 0;
    } else if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $count = $row['counts'];
        $result->close();
    } else {
        $count = 0;
    }
    $conn->close();
    return $count;
}

function getData(int $id) {
    $conn = connect();
    $sql = "SELECT * FROM todo_list WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $result = $stmt->execute();
    if ($result == false) {
        $row = null;
    } else {
        $result_set = $stmt->get_result();
        if ($result_set->num_rows == 0) {
            $row = null;
        } else {
            $row = $result_set->fetch_object();
        }
        $result_set->close();
    }
    $stmt->close();
    $conn->close();
    return $row;
}

function setTask(int $id, string $title, string $description) {
    $conn = connect();
    $sql = "UPDATE todo_list SET title = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $title, $description, $id);
    $result = $stmt->execute();
    if ($result) {
        header('Location: index.php?action=displayTask&error=updated_success&id='.$id);
    } else {
        header('Location: index.php?action=displayTask&error=updated_failed&id='.$id);
    }
    $stmt->close();
    $conn->close();
}