<?php 
function sum($a,$b){
    return $a+$b;
}



function findUserByUsername($username){
    $content = file_get_contents('./data.json');
    $users = json_decode($content,true) ;
    for($i = 0 ; $i<sizeof($users); $i++){
        $user = $users[$i];
        if($user['username'] == $username) 
            return  $user;
    }
    return null;
}

function getCurrentUser(){
    if(isset($_SESSION['username'])){
        return findUserByUsername($_SESSION['username']);
    }
    return null;
}