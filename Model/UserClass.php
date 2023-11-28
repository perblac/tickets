<?php
class User
{
    private $id, $name, $rol;
    public function __construct($datos)
    {
        $this->id = $datos['id'];
        $this->name = $datos['name'];
        $this->rol = $datos['rol'];
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($newId)
    {
        $this->id = $newId;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($newName)
    {
        $this->id = $newName;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public function setRol($newRol)
    {
        $this->id = $newRol;
    }
}
?>