<?php

include './functions.php';

$note = new Note();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {

    $note->deleteNote($_POST['id']);
}

$notes = $note->index();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Заметки</title>
</head>
<body>

<header>
    <a href="form.php">Создать новую заметку</a>
</header>

<div class="container">
    <div class="notes">
        <?php foreach ($notes as $note): ?>
            <div class="note">
                <h2><?= htmlentities($note['title']) ?></h2>
                <h4><?= htmlentities($note['created_at']) ?></h4>
                <div class="note-actions">
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= htmlentities($note['id']) ?>">
                        <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this note?');">Удалить</button>
                    </form>
                    <a href="form.php?id=<?= htmlentities($note['id']) ?>">Редактировать</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>