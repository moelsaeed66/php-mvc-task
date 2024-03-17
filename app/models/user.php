<?php

class user extends model{
    private $db;
    public function __construct(){
        $this->db=new model();
    }
    
    //insert data
    public function register($data){
        $this->db->query('INSERT INTO `user`( `name`, `email`, `password`) 
        VALUES(:name,:email,:password)');
        //set values
        $this->db->bind(':name',$data['username']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM `user` WHERE email=:email');
        //set value
        $this->db->bind(':email',$email);
        if($this->db->getRows()>0){
            return true;

        }else{
            return false;
        }

    }

        //match data
        public function login($username,$password){
            //prepare statment
            $this->db->query('SELECT * FROM `user` WHERE name=:name');
            //set values
            $this->db->bind(':name',$username);
            //get single data
            $row=$this->db->single();
            $hashedpassword=$row->password;
            if(password_verify($password,$hashedpassword)){
                return $row;
            }else{
                return false;
            }
        }

}