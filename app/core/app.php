<?php

class app{
    private $controller;
    private $method;
    private $params;

    public function __construct(){
        $this->getUrl();
        $this->render();
    }

    private function getUrl(){
        
        if(!empty($_SERVER['QUERY_STRING'])){
            $url=$_SERVER['QUERY_STRING'];
            $url=trim($url,"/");
            $url=explode("/",$url);
            //define controllers
            $this->controller=isset($url[0])?$url[0]."controller":"homecontroller";

            //define method
            $this->method=isset($url[1])?$url[1]:'index';
            unset($url[0],$url[1]);
            
            //define params
            $this->params=array_values($url);
            
        }else{
            $this->controller="homecontroller";
            $this->method="index";
            $this->params=[];
        }
    }

    private function render(){
        if(class_exists($this->controller)){
            $controller=new $this->controller;
            if(method_exists($controller,$this->method)){
                call_user_func_array([$controller,$this->method],$this->params);

            }else{
                echo "this method: ".$this->method." not exists";
            }
        }else{
            echo "this class: ".$this->controller." not exists";
        }
    }
}