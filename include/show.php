<?php
$TitleName = "Просмотр задачи";
require_once __DIR__ . '/../config/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: /404');
    exit;
}

$sql = "SELECT * FROM tasks WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    header('Location: /404');
    exit;
}
?>

<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/nav.php'; ?>

<div class="task-view">
    <h2 class="task-title"><?= htmlspecialchars($task['title']) ?></h2>
    <p class="task-desc"><?= htmlspecialchars($task['description']) ?></p>
    <span class="task-status <?= $task['status'] === 'Выполнен' ? 'completed' : '' ?>">
        <?= htmlspecialchars($task['status']) ?>
    </span>
    <div class="task-actions">
        <a href="/update?id=<?= $task['id'] ?>" class="task-edit">Редактировать</a>
        <a href="/delete?id=<?= $task['id'] ?>" class="task-delete">Удалить</a>
        <a href="/" class="task-back">Назад к списку</a>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>