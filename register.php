<?php
session_start();

    if (isset($_POST['email'])){
        try{
            require_once 'config.php';
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            
            $stmt = $pdo->prepare("SELECT * FROM `User` WHERE `email` = :email");
            $stmt->execute(['email' => $_POST['email']]);
            if ($stmt->rowCount() > 0) {
                header('Location: index.php'); // Возврат на форму регистрации
                die; // Остановка выполнения скрипта
            }else {
                $stmt = $pdo->prepare("INSERT INTO `User` (`username`,`email`,`password`) VALUES (:username,:email,:password)");
                $stmt-> execute(['username' => $_POST['username'],'email' => $_POST['email'],'password' => hash('sha256', $_POST['password']),]);
                }
                    
        } catch (PDOException $e) {
                echo "Ошибка: " . $e->getMessage() . "\n";
        }
    }
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="styles.css">
        <title>Регистрация</title>
    </head>
    <body>
        <div class="container">
            <div class="form-container">
                <h2>Регистрация</h2>
                <form action="register.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="username" id="username" name="username" placeholder="Введите ваше имя">
                    </div>
                        
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Введите ваш email">
                    </div>
                        
                    <div class="form-group">
                        <label for="password">Пароль:</label>
                        <input type="password" id="password" name="password" placeholder="Введите пароль">
                    </div>
                        
                        
                    <button type="submit" class="btn">Зарегистрироваться</button>
                </form>
                    
                <div class="text-center">
                    <p>Уже есть аккаунт?<a href="login.php"><button class="link">Войдите</button></a></p>
                    <p><a href="index.php"><button class="link">Войти без аккаунта</button></a></p>
                </div>
            </div>
        </div>
    </body>
</html>


