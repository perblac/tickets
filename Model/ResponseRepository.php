<?php
class ResponseRepository
{
    public static function getResponseById($id)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM responses WHERE id = " . $id;
        $result = $bd->query($q);
        $response = null;
        while ($datos = $result->fetch_assoc()) {
            $response = new Response($datos);
        }
        return $response;
    }

    public static function getResponsesFromTicket($ticket)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM responses WHERE id_ticket = " . $ticket->getId();
        $result = $bd->query($q);
        $responses = [];
        while ($datos = $result->fetch_assoc()) {
            $responses[] = new Response($datos);
        }
        return $responses;
    }

    public static function createResponse($response)
    {
        $bd = Conectar::conexion();
        $q = "INSERT INTO responses VALUES (NULL,
                                           " . $response->getIdTicket() . ",
                                           " . $response->getIdAuthor() . ",
                                           '" . $response->getText() . "' )";
        $result = $bd->query($q);
        return $bd->insert_id;
    }
    public static function saveResponse($response)
    {
        $bd = Conectar::conexion();
        $q = "UPDATE responses SET id_author = " . $response->getIdAuthor() . ",
                                   text = '" . $response->getText() . "'";
        $result = $bd->query($q);
    }
}
?>