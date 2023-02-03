<?php

class Users extends DbObject {

    public $id;
    public $firstname;
    public $lastname;
	public $email;
    public $number_phone;
	public $password;
	public $status;

    public function getFirstname(){
        return $this->firstname;
    }

    public function getLastname(){
        return $this->lastname;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function getNumber_phone(){
        return $this->number_phone;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function getStatus(){
        return $this->status;
    }

    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setNumber_phone($number_phone): void
    {
        $this->number_phone = $number_phone;
    }

    public function setPassword($password) {
		$this->password = hash('sha256', $password);
	}

    public function setStatus($status): void
    {
        $this->status = $status;
    }





    



    public function verifyPassword($password) {
		$hashPassword = hash('sha256', $password);
		return ($hashPassword === $this->password);
	}
}

?>