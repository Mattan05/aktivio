<?php
require_once("router.php");
require_once("users.php");

App::get('/', function(){
    include("client/dist/static.html");
});

App::post("/register", function(){
    $data = (array) json_decode(file_get_contents('php://input'));

    if(strlen($data["password"])<6){
        return "Password must be at least 6 characters long";
    }
    
/*     $data['id']="users_" . uniqid(true); */
    $result = UserDb::register($data);
    if($result["success"]){
        echo $result["success"];
    }elseif($result["error"]){
        echo"".$result["error"]."";
    }
});

App::post("/login", function(){
    $data = (array) json_decode(file_get_contents('php://input'));

    if(!$data["email"] || !$data["password"]){
        return "Ange både Email och Lösenord.";
    }

    $result = UserDb::login($data);
    if($result['success']){
        echo $result["success"];
    }elseif($result["error"]){
        echo $result["error"];
    }
});

