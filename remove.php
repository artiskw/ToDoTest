<?php
require 'db_conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (empty($id)) {
        echo 0;
    } else {
        $stmt = $conn->prepare("DELETE FROM todo WHERE id=?");
        $res = $stmt->execute([$id]);

        if ($res) {
           
            header("Location: index.php?mess=success");
            exit();
        } else {
            header("Location: index.php?mess=error");
            exit();
        }
    }
} else {

    header("Location: index.php?mess=error");
    exit();
}
?>