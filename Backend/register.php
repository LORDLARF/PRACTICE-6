<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashed_password]);

            header('Location: ../Frontend/index.html?success=1');
            exit;
        } catch (PDOException $e) {
            echo "Ошибка: Пользователь с таким именем уже существует или проблемы с БД.";
        }
    } else {
        echo "Заполните все поля!";
    }
}
?>