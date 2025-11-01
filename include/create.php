<?php
require_once __DIR__ . '/../config/db.php';
$TitleName = "Создание задачи";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $status = htmlspecialchars($_POST['status']);

    $sql = "INSERT  INTO tasks (`title`, `description`, `status`) VALUES (:title, :description, :status)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':status' => $status

    ]);
    header('Location: /');
    exit();
}



?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/nav.php'; ?>





<form action="" method="post" class="task-form">
    <label for="create-todo" class="task-label">Создание задачи</label>
    <div class="task-fields">
        <input type="text" name="title" id="create-todo" class="task-input" placeholder="Название задачи" required>
        <textarea name="description" class="task-textarea" placeholder="Описание" required></textarea>
        <select name="status" class="task-select" required>
            <option value="">Выберите статус</option>
            <option value="В процессе">В процессе</option>
            <option value="Выполнен">Выполнен</option>
        </select>
    </div>
    <button type="submit" class="task-btn">Создать задачу</button>
</form>













<?php require_once __DIR__ . '/../layout/footer.php'; ?>