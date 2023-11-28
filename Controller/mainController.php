<?php
/* -------------------------------------------------------------------------- */
/*                               main controller                              */
/* -------------------------------------------------------------------------- */

//load models
require_once('Model/UserClass.php');
require_once('Model/UserRepository.php');
require_once('Model/TicketClass.php');
require_once('Model/TicketRepository.php');
require_once('Model/ResponseClass.php');
require_once('Model/ResponseRepository.php');
require_once('Model/ViewRepository.php');

//use models
session_start();

if (!empty($_GET['c'])) {
    require('Controller/' . $_GET['c'] . 'Controller.php');
}

if (!isset($_SESSION['user']) && !isset($_GET['registroFrm'])) {
    include('View/loginView.phtml');
    die;
}

include('View/mainView.phtml');
?>