<?php
require_once __DIR__ . '/../config/db.php';
$TitleName = 'Удаление задачи';

$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;


    $stmt = $conn->prepare('DELETE FROM tasks WHERE id = :id');
    $stmt->execute([':id' => $id]);

    header('Location: /');
    exit;
}

$stmt = $conn->prepare('SELECT * FROM tasks WHERE id = :id');
$stmt->execute([':id' => $id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/nav.php'; ?>
<div class="task delete-task <?= $task['status'] === 'Выполнен' ? 'completed' : '' ?>">
    <h2 class="task-title"><?= htmlspecialchars($task['title']) ?></h2>
    <p class="task-desc"><?= htmlspecialchars($task['description']) ?></p>
    <span class="task-status"><?= htmlspecialchars($task['status']) ?></span>

    <div class="task-actions">
        <form action="/delete" method="post" class="task-form">
            <input type="hidden" name="id" value="<?= $task['id'] ?>">
            <button type="submit" class="task-btn btn-delete">Удалить задачу</button>
            <a href="/" class="task-btn btn-cancel">Отмена</a>
        </form>
    </div>
</div>





<?php require_once __DIR__ . '/../layout/footer.php'; ?>