<?php
$TitleName = "Todo list";
require_once __DIR__ . '/../config/db.php';


if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $sql = "SELECT * FROM tasks";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>

<?php require_once __DIR__ . '/../layout/header.php';?>
<?php require_once __DIR__ . '/../layout/nav.php';?>

<form action="" method="post" >
        <div class="tasks-list">
       <div  class="todo">
         <span class="todo">Список задач</span>
       </div>

    <div class="btn-create">
        <a href="/create" >Создать задачу</a>
    </div>
        <?php foreach ($tasks as $task): ?>
        <!-- если статус выполнен то задача будет вычеркнута, если в процессе то останется так -->
            <div class="task <?= $task['status'] === 'Выполнен' ? 'completed' : '' ?>">
                <h2 class="task-title"><?= htmlspecialchars($task['title']) ?></h2>
                <p class="task-desc"><?= htmlspecialchars($task['description']) ?></p>
                <span class="task-status"><?= htmlspecialchars($task['status']) ?></span>
                <a href="/update?id=<?= htmlspecialchars($task['id']) ?>" class="task-edit">Редактировать</a>
                <a href="/delete?id=<?= htmlspecialchars($task['id']) ?>" class="task-delete">Удалить</a>
            </div>
        <?php endforeach; ?>
    </div>
</form>



<?php require_once __DIR__ . '/../layout/footer.php'; ?>