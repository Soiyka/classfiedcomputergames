<?php
session_start();
// Проверка авторизации администратора
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

include 'config.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить новую запись</title>
    <style>
        .container { max-width: 600px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        .message { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Добавить новую запись</h2>
        
        <?php
        // Вывод сообщений об успехе/ошибке
        if (isset($_SESSION['message'])) {
            echo '<div class="message ' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>

        <form action="add_record.php" method="POST">
            <div class="form-group">
                <label for="title">Заголовок:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="content">Содержание:</label>
                <textarea id="content" name="content" rows="6" required></textarea>
            </div>

            <div class="form-group">
                <label for="category">Категория:</label>
                <select id="category" name="category" required>
                    <option value="">Выберите категорию</option>
                    <option value="news">Новости</option>
                    <option value="articles">Статьи</option>
                    <option value="tutorials">Обучение</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Статус:</label>
                <select id="status" name="status" required>
                    <option value="active">Активный</option>
                    <option value="draft">Черновик</option>
                    <option value="archived">Архив</option>
                </select>
            </div>

            <button type="submit">Добавить запись</button>
            <a href="admin.php" style="margin-left: 10px;">Вернуться в админку</a>
        </form>
    </div>
</body>
</html>