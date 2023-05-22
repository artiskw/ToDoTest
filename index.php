<?php
require 'db_conn.php';

$conn->query("DELETE FROM todo WHERE todoDate < CURDATE()");

$todo = $conn->query("SELECT * FROM todo ORDER BY id DESC");
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
                        <input type="date" name="todoDate" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
            </form>
            <div class="lists-container">
                <?php while($todoItem = $todo->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="list">
                    <div class="list-top">
                        <div class="checkbox-round">
                            <input type="checkbox" id="checkbox-<?php echo $todoItem['id']; ?>" />
                            <label for="checkbox"></label>
                        </div>
                        <h3><?php echo $todoItem['title']; ?></h3>
                        <div class="delete-upgrade">
                            <a class="upgrade-to-do" href="upgrade.php?id=<?php echo $todoItem['id']; ?>"><i
                                    class="far fa-pen-to-square"></i></a>
                            <a class="remove-to-do" href="remove.php?id=<?php echo $todoItem['id']; ?>"><i
                                    class="fas fa-trash"></i></a>
                        </div>
                    </div>
                    <div class="list-bottom">
                        <p class="creation-date">Creation date: <?php echo $todoItem['data_time']; ?></p>
                        <p class="due-date">
                            Due date:
                            <?php echo '<span class="' . (strtotime($todoItem['todoDate']) - time() <= 24 * 60 * 60 ? 'red' : '') . '">' . $todoItem['todoDate'] . '</span>'; ?>
                        </p>
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