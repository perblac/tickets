<?php

if (isset($_POST['newRol'])) {
    UserRepository::setUserRol($_POST['idUser'], $_POST['newRol']);
}

?>