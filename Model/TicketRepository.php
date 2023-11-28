<?php
class TicketRepository
{

    public static function getTicketById($id)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM tickets WHERE id = " . $id;
        $ticket = null;
        $result = $bd->query($q);
        while ($datos = $result->fetch_assoc()) {
            $ticket = new Ticket($datos);
        }
        return $ticket;
    }

    public static function getAllTickets()
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM tickets";
        $tickets = [];
        $result = $bd->query($q);
        while ($datos = $result->fetch_assoc()) {
            $tickets[] = new Ticket($datos);
        }
        return $tickets;
    }

    public static function getUnassignedOpenTickets()
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM tickets WHERE is_open = 1 AND assigned_worker IS NULL";
        $tickets = [];
        $result = $bd->query($q);
        while ($datos = $result->fetch_assoc()) {
            $tickets[] = new Ticket($datos);
        }
        return $tickets;
    }
    public static function getOpenTicketsOfWorker($user)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM tickets WHERE is_open = 1 AND assigned_worker = " . $user->getId();
        $tickets = [];
        $result = $bd->query($q);
        while ($datos = $result->fetch_assoc()) {
            $tickets[] = new Ticket($datos);
        }
        return $tickets;
    }
    public static function getAssignedTickets($user)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM tickets WHERE assigned_worker = " . $user->getId();
        $tickets = [];
        $result = $bd->query($q);
        while ($datos = $result->fetch_assoc()) {
            $tickets[] = new Ticket($datos);
        }
        return $tickets;
    }
    public static function getUserTickets($user)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM tickets WHERE id_author = " . $user->getId();
        $tickets = [];
        $result = $bd->query($q);
        while ($datos = $result->fetch_assoc()) {
            $tickets[] = new Ticket($datos);
        }
        return $tickets;
    }

    public static function createTicket($user, $title, $text)
    {
        $bd = Conectar::conexion();
        $q = "INSERT INTO tickets VALUES (NULL,
                                        " . $user->getId() . ",
                                        '" . $title . "',
                                        '" . $text . "',
                                        NOW(),
                                        NULL,
                                        1,
                                        NULL,
                                        NULL)";
        $result = $bd->query($q);
        return $bd->insert_id;
    }

    public static function saveTicket($ticket)
    {
        $bd = Conectar::conexion();
        $q = "UPDATE tickets SET is_open = " . $ticket->getIsOpen() . ",
                               assigned_worker = " . (($ticket->getAssignedWorker() == null) ? 'NULL' : $ticket->getAssignedWorker()) . ",
                               rating = " . (($ticket->getRating() == null) ? 'NULL' : $ticket->getRating()) . "
            WHERE id = " . $ticket->getId();
        $result = $bd->query($q);
    }

    public static function closeTicket($ticket)
    {
        $bd = Conectar::conexion();
        $q = "UPDATE tickets SET is_open = " . $ticket->getIsOpen() . ",
                               close_date = NOW()
            WHERE id = " . $ticket->getId();
        $result = $bd->query($q);
    }
}
?>