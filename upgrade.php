<?php
require 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <title>ToDo List</title>
</head>
<body>

    <section class="todo-list">
        <div class="todo-list-inner">
            <h2>TO DO List</h2>
            <form action="add.php" method="POST">
                <div class="input-container">
                    <div class="note-add-container">
                        <input type="text" name="title" placeholder="Your note" required>
                        <button type="submit" name="add">ADD</button>
                    </div>
                    <div class="date-container">
                        <label for="todoDate">Due date</label>
                        <input type="date" name="todoDate" required>
                    </div>
                </div>
            </form>
            <?php
            $todo = $conn->query("SELECT * FROM todo ORDER BY id DESC");
            ?>
            <div class="lists-container">
                <?php while ($todoItem = $todo->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="list">
                    <div class="list-top">
                        <div class="checkbox-round">
                            <input type="checkbox" id="checkbox" />
                            <label for="checkbox"></label>
                        </div>
                        <h3><?php echo  $todoItem['title'] ?></h3>
                        <div class="delete-upgrade">
                            <a class="upgrade-to-do" href="upgrade.php?id=<?php echo $todoItem['id']; ?>"><i
                                    class="far fa-pen-to-square"></i></a>
                            <a class="remove-to-do" href="remove.php?id=<?php echo $todoItem['id'] ?>"><i
                                    class="fas fa-trash"></i></a>
                        </div>
                    </div>
                    <div class="list-bottom">
                        <p class="creation-date">Creation date: <?php echo  $todoItem['data_time'] ?></p>
                        <p class="due-date">Due date: <?php echo  $todoItem['todoDate'] ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <script src="js/script.js"></script>
    <script src="https://kit.fontawesome.com/b057f69e10.js" crossorigin="anonymous"></script>
</body>
</html>
<?php
require 'db_conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $fetchItem = $conn->query("SELECT title, todoDate FROM todo WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
    $fetchTitle = $fetchItem['title'];
    $fetchDate = $fetchItem['todoDate'];
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $updateItem = $_POST['title'];
    $updateDate = $_POST['dueDate'];

    $sql = "UPDATE todo SET title = :title, todoDate = :todoDate WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $updateItem);
    $stmt->bindParam(':todoDate', $updateDate);
    $stmt->bindParam(':id', $id);
    $result = $stmt->execute();

    if ($result) {
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        die(print_r($stmt->errorInfo(), true));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Upgrade ToDo</title>
</head>
<body>
    <section class="upgrade-todo">
        <div class="upgrade-todo-inner">
            <h2>Upgrade ToDo</h2>

            <form action="" method="POST">
                <div class="input-container">
                    <div class="note-add-container">
                        <input type="text" name="title" placeholder="Your note" value="<?php echo $fetchTitle; ?>"
                            required>
                        <button type="submit" name="update">UPDATE</button>
                    </div>
                    <div class="date-container">
                        <label for="dueDate">Due date</label>
                        <input type="date" name="dueDate" value="<?php echo $fetchDate; ?>" required>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            </form>
        </div>
    </section>
    <script src="js/script.js"></script>
    <script src="https://kit.fontawesome.com/b057f69e10.js" crossorigin="anonymous"></script>
</body>

</html>
