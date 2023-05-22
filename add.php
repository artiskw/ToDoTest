<?php

require 'db_conn.php';

if(isset($_POST['add'])) {
    $title = $_POST['title'];
    $dueDate = $_POST['todoDate'];

    if(empty($title) || empty($dueDate)) {
        header("Location: index.php?mess=error");
        exit();
    } else {
        $stmt = $conn->prepare("INSERT INTO todo (title, todoDate) VALUES (?, ?)");
        $res = $stmt->execute([$title, $dueDate]);

        if($res) {
            header("Location: index.php?mess=success");
            exit();
        } else {
            header("Location: index.php?mess=error");
            exit();
        }
    }
}

$todo = $conn->query("SELECT * FROM todo ORDER BY id DESC");
?>
