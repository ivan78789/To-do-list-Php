<?php
require_once __DIR__ . '/../config/db.php';
$TitleName = 'Редактирование задачи';
//тут я беру айди 
$id = $_GET['id'] ?? null;

//здусь вывожу задачу
$stmt = $conn->prepare('SELECT * FROM tasks WHERE id = :id');
$stmt->execute([':id' => $id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);
//здесть измению
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $title = htmlspecialchars($_POST['title']);
     $description = htmlspecialchars($_POST['description']);
     $status = htmlspecialchars($_POST['status']);

     $stmt = $conn->prepare('UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :id');
     $stmt->execute([
          ':title' => $title,
          ':description' => $description,
          ':status' => $status,
          ':id' => $id,
     ]);

     header('Location: /');
     exit;
}
?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/nav.php'; ?>
<form action="" method="post" class="edit-form">
    <label for="edit-todo" class="edit-label">Редактирование задачи</label>
    <div class="edit-fields">
        <input type="text" name="title" id="edit-todo" class="edit-input" placeholder="Название задачи"
               value="<?= htmlspecialchars($task['title']) ?>" required>
          <textarea name="description" class="edit-textarea" placeholder="Описание"
               required><?= htmlspecialchars($task['description']) ?></textarea>
          <select name="status" class="edit-select" required>
               <option value="В процессе" <?= $task['status'] === 'В процессе' ? 'selected' : '' ?>>В процессе</option>
               <option value="Выполнен" <?= $task['status'] === 'Выполнен' ? 'selected' : '' ?>>Выполнен</option>
          </select>
     </div>
     <button type="submit" class="edit-btn">Обновить задачу</button>
</form>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>