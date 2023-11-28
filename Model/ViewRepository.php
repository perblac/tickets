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
                $s .= '<br><a href="index.php?c=ticket&answer=' . $ticket->getId() . '">Responder</a>';
            } else {
                if (!$ticket->getRating()) {
                    $s .= '<br><a href="index.php?c=ticket&rate=' . $ticket->getId() . '">Valorar</a>';
                }
            }
            $s .= '</div>';
        }
        $s .= '</section>';
        return $s;
    }

    public static function printOpenTickets()
    {
        $tickets = TicketRepository::getUnassignedOpenTickets();
        $s =  '<section class="tickets openTickets">';
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

    public static function printTicket($ticket)
    {
        $s = '<a href="#" onclick="readTicket('.$ticket->getId().')">' . UserRepository::getUserById($ticket->getIdAuthor())->getName() . ': ' . $ticket->getTitle() . '</a>&nbsp;';
        $s .= ($ticket->getIsOpen()?'abierto 🔓':'cerrado 🔒');
        return $s;
    }
}
?>