<?php 
class currencies{
    public $id;
    public $name;
    public $taux;


    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setTaux($taux): void
    {
        $this->taux = $taux;
    }
}
