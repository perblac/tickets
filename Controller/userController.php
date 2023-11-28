<?php

if (isset($_POST['login'])) {
    $user = UserRepository::checkUserPassword($_POST['name'], $_POST['password']);
    if ($user != null) {
        $_SESSION['user'] = $user;
    } else {
        echo '<script>alert("Usuario o contraseña incorrectos")</script>';
    }
}

if (isset($_POST['register'])) {
    if (UserRepository::checkIfUsernameExists($_POST['name'])) {
        echo '<script>alert("El nombre de usuario ya existe")</script>';
    } else {
        $user = UserRepository::addUser($_POST['name'], $_POST['password'], $_POST['rol']);
        $_SESSION['user'] = $user;
        header('location: index.php');
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    session_start();
}

?>