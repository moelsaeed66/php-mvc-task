<?php

class view{

    public static function load($path,$data=[]){
        if(file_exists(VIEWS.$path.".php")){
            extract($data);
            require(VIEWS.$path.".php");
        }else{
            echo"this file not exists";
        }

    }

    public  function model($model){
        require_once MODELS.$model.'.php';
        return new $model;
    }

}