<?php
class ViewRepository
{

    public static function printUserTickets($user)
    {
        $tickets = TicketRepository::getUserTickets($user);
        $s =  '<section class="tickets">';
        foreach ($tickets as $ticket) {
            $s .= '<div class="ticket">';
            $s .= ViewRepository::printTicket($ticket);
            if ($ticket->getIsOpen()) {
                $s .= '<a href="index.php?c=ticket&answer=' . $ticket->getId() . '">Responder</a>';
            } else {
                $s .= '<br>Cerrado';
                $s .= ' - <a href="index.php?c=ticket&rate=' . $ticket->getId() . '">Valorar</a>';
            }
            $s .= '</div>';
        }
        $s .= '</section>';
        return $s;
    }

    public static function printOpenTickets()
    {
        $tickets = TicketRepository::getUnassignedOpenTickets();
        $s =  '<section class="tickets">';
        foreach ($tickets as $ticket) {
            $s .= '<div class="ticket">';
            $s .= ViewRepository::printTicket($ticket);
            $s .= '<br><a href="index.php?c=ticket&assign=' . $ticket->getId() . '">Escoger</a>';
            $s .= '</div>';
        }
        $s .= '</section>';
        return $s;
    }

    public static function printMyTickets()
    {
        $tickets = TicketRepository::getOpenTicketsOfWorker($_SESSION['user']);
        $s =  '<section class="tickets">';
        foreach ($tickets as $ticket) {
            $s .= '<div class="ticket">';
            $s .= ViewRepository::printTicket($ticket);
            $s .= '<br><a href="index.php?c=ticket&answer=' . $ticket->getId() . '">Responder</a>';
            $s .= '<br><a href="index.php?c=ticket&close=' . $ticket->getId() . '">cerrar</a>';
            $s .= '</div>';
        }
        $s .= '</section>';
        return $s;
    }

    /*
    public static function printTicket($ticket)
    {
        $s = 'titulo:' . $ticket->getTitle() . ' - texto:' . $ticket->getText();
        $s .= '<br>Por: ' . UserRepository::getUserById($ticket->getIdAuthor())->getName();
        if ($ticket->getAssignedWorker() != null) {
            $s .= '<br>Asignado a ' . UserRepository::getUserById($ticket->getAssignedWorker())->getName();
        }
        $s .= '<br>Fecha de apertura:' . $ticket->getOpenDate();
        if ($ticket->getIsOpen() == 0) {
            $s .= '<br>Fecha de cierre:' . $ticket->getCloseDate();
        }
        if ($ticket->getResponses() != null) {
            foreach ($ticket->getResponses() as $response) {
                $s .= '<br>' . UserRepository::getUserById($response->getIdAuthor())->getName() . ' :' . $response->getText();
            }
        }
        if ($ticket->getRating() != null) {
            $s .= '<br>Valoracion:' . $ticket->getRating();
        }
        return $s;
    }
    */

    public static function printTicket($ticket)
    {
        $s = '<a href="#" onclick="readTicket('.$ticket->getId().')">' . UserRepository::getUserById($ticket->getIdAuthor())->getName() . ': ' . $ticket->getTitle() . '</a>&nbsp;';
        // if ($ticket->getAssignedWorker() != null) {
        //     $s .= '<br>Asignado a ' . UserRepository::getUserById($ticket->getAssignedWorker())->getName();
        // }
        // $s .= '<br>Fecha de apertura:' . $ticket->getOpenDate();
        // if ($ticket->getIsOpen() == 0) {
        //     $s .= '<br>Fecha de cierre:' . $ticket->getCloseDate();
        // }
        // if ($ticket->getResponses() != null) {
        //     foreach ($ticket->getResponses() as $response) {
        //         $s .= '<br>' . UserRepository::getUserById($response->getIdAuthor())->getName() . ' :' . $response->getText();
        //     }
        // }
        // if ($ticket->getRating() != null) {
        //     $s .= '<br>Valoracion:' . $ticket->getRating();
        // }
        return $s;
    }
}
?>