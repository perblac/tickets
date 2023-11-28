<?php
class Ticket
{
    private $id, $idAuthor, $title, $text, $openDate, $closeDate, $isOpen, $assignedWorker, $rating, $responses;
    public function __construct($datos)
    {
        $this->id = $datos['id'];
        $this->idAuthor = $datos['id_author'];
        $this->title = $datos['title'];
        $this->text = $datos['text'];
        $this->openDate = $datos['open_date'];
        $this->closeDate = $datos['close_date'];
        $this->isOpen = $datos['is_open'];
        $this->assignedWorker = $datos['assigned_worker'];
        $this->rating = $datos['rating'];
        $this->responses = $this->loadResponses();
    }
    private function loadResponses()
    {
        return ResponseRepository::getResponsesFromTicket($this);
    }
    public function getResponses()
    {
        return $this->responses;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($newId)
    {
        $this->id = $newId;
    }
    public function getIdAuthor()
    {
        return $this->idAuthor;
    }
    public function setIdAuthor($newIdAuthor)
    {
        $this->idAuthor = $newIdAuthor;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($newTitle)
    {
        $this->title = $newTitle;
    }
    public function getText()
    {
        return $this->text;
    }
    public function setText($newText)
    {
        $this->text = $newText;
    }
    public function getOpenDate()
    {
        return $this->openDate;
    }
    public function getAssignedWorker()
    {
        return $this->assignedWorker;
    }
    public function setAssignedWorker($idWorker)
    {
        $this->assignedWorker = $idWorker;
    }
    public function getCloseDate()
    {
        return $this->closeDate;
    }
    public function setgetCloseDate($newgetCloseDate)
    {
        $this->closeDate = $newgetCloseDate;
    }
    public function getIsOpen()
    {
        return $this->isOpen;
    }
    public function setIsOpen($newIsOpen)
    {
        $this->isOpen = $newIsOpen;
    }
    public function getRating()
    {
        return $this->rating;
    }
    public function setRating($newRating)
    {
        $this->rating = $newRating;
    }
    public function save()
    {
        TicketRepository::saveTicket($this);
    }
    public function close()
    {
        $this->setIsOpen(0);
        TicketRepository::closeTicket($this);
    }
    public function getJSON() {
        // if ($this->idAuthor != null)
        // echo UserRepository::getUserById($this->idAuthor)->getName();
        $array['id'] = $this->id;
        $array['author'] = UserRepository::getUserById($this->idAuthor)->getName();
        $array['title'] = $this->title;
        $array['text'] = $this->text;
        $array['open_date'] = $this->openDate;
        $array['close_date'] = $this->closeDate;
        $array['is_open'] = $this->isOpen;
        if ($this->assignedWorker != null)
        $array['assigned_worker'] = UserRepository::getUserById($this->assignedWorker)->getName();
        else 
        $array['assigned_worker'] = 'sin asignar';
        $array['rating'] = $this->rating;        
        $respuestas = ResponseRepository::getResponsesFromTicket($this);
        $array['respuestas'] = [];
        foreach ($respuestas as $respuesta) {
            $respArray['autor'] = UserRepository::getUserById($respuesta->getIdAuthor())->getName();
            $respArray['texto'] = $respuesta->getText();
            $array['respuestas'][] = $respArray;
        }
        return $array;
    }
}
?>