<?php
session_start();


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];
        
        
            try {
                require_once 'config.php';
                
                $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "❌ Ошибка: " . $e->getMessage() . "\n";
            }
    
    
                
                // Ищем пользователя по email
            $stmt = $pdo->prepare("SELECT id_user, username, password, email, role FROM User WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
                
                // Проверяем что пользователь найден 
               if ($user) {
                    // Для hash('sha256')
                    if ($user['password'] === hash('sha256', $password)) {
                        $_SESSION['user_id'] = $user['id_user'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['role'] = $user['role'];
                         header('Location: index.php');
    
                        exit;
                    } else {
                        echo "Неверные данные";
                    }
                }
    
                else{
                    echo "Пользователь не неайден";
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
            <div id="login">
                        <h2>Вход</h2>
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" placeholder="Введите ваш email">
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Пароль:</label>
                                <input type="password" id="password" name="password" placeholder="Введите ваш пароль">
                            </div>
                            
                            <button type="submit" class="btn">Войти</button>
                        </form>
                 <div class="text-center">
                    <p>Нет аккаунта?<a href="register.php"><button class="link">Зарегистрируйтесь</button></a></p>
                    <p><a href="index.php"><button class="link">Войти без аккаунта</button></a></p>
                </div>
             </div>
        </div>
    </body>
</html>