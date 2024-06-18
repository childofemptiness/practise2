<?php

include './functions.php';

$note = new Note();

$id = null;

$title = '';

$content = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = isset($_POST['id']) ? $_POST['id'] : null;

    $title = $_POST['title'];

    $content = $_POST['content'];

    if ($id) {

        $note->updateNote($id, $title, $content);
    } else {

        $note->createNote($title, $content);
    }

    header('Location: index.php');

    exit();
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $noteData = $note->getNote($id);

    $title = $noteData['title'];

    $content = $noteData['content'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title><?= $id ? 'Редактировать заметку' : 'Создать заметку' ?></title>
</head>
<body>
    <h1><?= $id ? 'Редактировать заметку' : 'Создать новую заметку' ?></h1>
    <form method="POST" action="">
        <?php if ($id): ?>
            <input type="hidden" name="id" value="<?= htmlentities($id) ?>">
        <?php endif; ?>
        <label for="title">Заголовок</label>
        <input type="text" id="title" name="title" value="<?= htmlentities($title) ?>" required>
        <label for="content">Содержимое</label>
        <textarea id="content" name="content" required><?= htmlentities($content) ?></textarea>
        <button type="submit"><?= $id ? 'Изменить' : 'Сохранить' ?></button>
    </form>
    <a href="index.php">Вернуться к списку заметок</a>
</body>
</html>