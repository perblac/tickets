<?php
class UserRepository
{
    public static function checkUserPassword($name, $pass)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM users WHERE name = '" . $name . "' AND password = '" . md5($pass) . "'";
        $result = $bd->query($q);
        if ($result->num_rows > 0) {
            $datos = $result->fetch_assoc();
            $user = new User($datos);
            return $user;
        } else {
            return null;
        }
    }

    public static function checkIfUsernameExists($name)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM users WHERE name = '" . $name . "'";
        $result = $bd->query($q);
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    public static function addUser($name, $pass, $rol)
    {
        $bd = Conectar::conexion();
        $q = "INSERT INTO users VALUES ( NULL, '" . $name . "', '" . md5($pass) . "', " . $rol . " )";
        $result = $bd->query($q);
        $id_user = $bd->insert_id;
        return UserRepository::getUserById($id_user);
    }

    public static function getUserById($id)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM users WHERE id = " . $id;
        $result = $bd->query($q);
        if ($datos = $result->fetch_assoc()) {
            return new User($datos);
        }
        return null;
    }

    public static function getUsersExceptMe()
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM users WHERE id != " . $_SESSION['user']->getId();
        $result = $bd->query($q);
        $users = [];
        while ($datos = $result->fetch_assoc()) {
            $users[] = new User($datos);
        }
        return $users;
    }

    public static function setUserRol($id, $rol)
    {
        $bd = Conectar::conexion();
        $q = "UPDATE users SET rol = " . $rol . " WHERE id = " . $id;
        $result = $bd->query($q);
    }
}
?>