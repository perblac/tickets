<?php
if (isset($_GET['id'])) {
    $ticket = TicketRepository::getTicketById($_GET['id']);
    header("application/json");
    echo json_encode($ticket->getJSON());
    die();
}

?>