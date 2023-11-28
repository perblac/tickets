<?php
class Response
{
    private $id, $idTicket, $idAuthor, $text;
    public function __construct($datos)
    {
        $this->id = $datos['id'];
        $this->idTicket = $datos['id_ticket'];
        $this->idAuthor = $datos['id_author'];
        $this->text = $datos['text'];
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($newId)
    {
        $this->id = $newId;
    }
    public function getIdTicket()
    {
        return $this->idTicket;
    }
    public function setIdTicket($newIdTicket)
    {
        $this->idTicket = $newIdTicket;
    }
    public function getIdAuthor()
    {
        return $this->idAuthor;
    }
    public function setIdAuthor($newIdAuthor)
    {
        $this->idAuthor = $newIdAuthor;
    }
    public function getText()
    {
        return $this->text;
    }
    public function setText($newText)
    {
        $this->text = $newText;
    }
    public function save()
    {
        if ($this->id == null) {
            $id = ResponseRepository::createResponse($this);
            $this->id = $id;
        } else {
            ResponseRepository::saveResponse($this);
        }
    }
}
?>