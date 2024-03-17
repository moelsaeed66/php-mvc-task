<?php

class usercontroller extends view {
    public function __construct(){
        $this->usermodel=$this->model('user');
    }
    // public function register(){
    //     view::load('users/register');
    // }
    
    public function register(){
        
        $data=[
            'username'=>'',
            'email'=>'',
            'password'=>'',
            'usernameerror'=>'',
            'emailerror'=>'',
            'passworderror'=>''


        ];
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            
            $data=[
                'username'=>trim($_POST['username']),
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'usernameerror'=>'',
                'emailerror'=>'',
                'passworderror'=>''

            ];
            

            $usernamevalidation="/^[a-zA-Z0-9]*$/";
            $passwordvalidation="/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
            //validate username
            if(empty($data['username'])){
                $data['usernameerror']="please enter your email";
            }elseif(!preg_match($usernamevalidation,$data['username'])){
                $data['usernameerror']="username can only contain letters and numbers";
            }
            

            //validate email
            if(empty($data['email'])){
                $data['emailerror']="please enter your email";
            }elseif (!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
                $data['emailerror']="please enter correct email";
            }else{
                if($this->usermodel->findUserByEmail($data['email'])){
                    $data['emailerror']="email is already taken";
                }
            }
            

            //validate password
            if(empty($data['password'])){
                $data['passworderror']="please enter your password";
            }elseif(strlen($data['password']<6)){
                $data['passworderror']="password must be more than 6 chars";
            }elseif(!preg_match($passwordvalidation,$data['password'])){
                $data['passworderror']="password should have at least numric and letters";
            }

            //check all errors
            if(empty($data['passworderror'])&& empty($data['emailerror'])&&empty($data['usernameerror'])){
                $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);
                //register user from model
                if($this->usermodel->register($data)){
                    header("location:".BURL."user/login");
                }else{
                    die("some thing went wrong");
                } 
            }
        }
        view::load("users/register",$data);
            
    }


    public function login(){
        $data=[
            'username'=>'',
            'password'=>'',
            'usernameerror'=>'',
            'passworderror'=>''
        ];
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $data=[
            'username'=>trim($_POST['username']),
            'password'=>trim($_POST['password']),
            'usernameerror'=>'',
            'passworderror'=>''
            ];
        //validate username
            if(empty($data['username'])){
                $data['usernameError']="please enter your name";
            }
        //validate password
            if(empty($data['password'])){
                $data['passwordError']="please enter your password";
            }
        //check errors is empty
            if(empty($data['usernameerror']) && empty($data['passworderror'])){
                $logged=$this->usermodel->login($data['username'],$data['password']);
                // var_dump($logged);die;
                if($logged){
                    // var_dump($logged);die;
                    $this->createUserSession($logged);
                }else{
                    
                    $data['passworderror']="password or username is incorrect,please try agin";
                    view::load("users/login",$data);
                }
            }
            
        }else{
            $data=[
                'username'=>'',
                'password'=>'',
                'usernameerror'=>'',
                'passworderror'=>''
            ];
        }
        view::load("users/login",$data);

    }

    public function createUserSession($user){
        
        $_SESSION['user_id']=$user->id;
        $_SESSION['username']=$user->name;
        $_SESSION['email']=$user->email;
        header('location:'.BURL.'home/index');
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['usernaem']);
        unset($_SESSION['email']);
        header('location:'.BURL.'user/login');
    }

}