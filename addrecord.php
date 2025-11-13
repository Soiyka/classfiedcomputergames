<?php
session_start();
// Проверка авторизации
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $database = new Database();
        $db = $database->getConnection();

        // Получаем данные из формы
        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $status = $_POST['status'];
        
        // Валидация данных
        if (empty($title) || empty($content) || empty($category)) {
            throw new Exception("Все поля обязательны для заполнения");
        }

        // Подготовленный запрос для безопасности
        $query = "INSERT INTO posts (title, content, category, status, created_at, updated_at) 
                  VALUES (:title, :content, :category, :status, NOW(), NOW())";
        
        $stmt = $db->prepare($query);
        
        // Привязка параметров
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':status', $status);
        
        // Выполнение запроса
        if ($stmt->execute()) {
            $_SESSION['message'] = "Запись успешно добавлена!";
            $_SESSION['message_type'] = "success";
        } else {
            throw new Exception("Ошибка при добавлении записи");
        }
        
    } catch (Exception $e) {
        $_SESSION['message'] = "Ошибка: " . $e->getMessage();
        $_SESSION['message_type'] = "error";
    }
    
    // Перенаправляем обратно на форму
    header('Location: add_form.php');
    exit;
} else {
    // Если запрос не POST, перенаправляем на форму
    header('Location: add_form.php');
    exit;
}
?>