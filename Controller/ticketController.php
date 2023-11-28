<?php

if (isset($_GET['assign'])) {
    $ticket = TicketRepository::getTicketById($_GET['assign']);
    $ticket->setAssignedWorker($_SESSION['user']->getId());
    $ticket->save();
}

if (isset($_GET['close'])) {
    $ticket = TicketRepository::getTicketById($_GET['close']);
    $ticket->close();
    $ticket->save();
}

if (isset($_POST['newTicket'])) {
    TicketRepository::createTicket($_SESSION['user'], $_POST['title'], $_POST['text']);
}

if (isset($_POST['rate'])) {
    $ticket = TicketRepository::getTicketById($_POST['id']);
    $rating =  $_POST['rating'];
    $ticket->setRating($rating);
    $ticket->save();
}

if (isset($_POST['answer'])) {
    $datos['id'] = null;
    $datos['id_ticket'] = $_POST['id'];
    $datos['id_author'] = $_SESSION['user']->getId();
    $datos['text'] = $_POST['text'];
    $response = new Response($datos);
    $response->save();
}

?>