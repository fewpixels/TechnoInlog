<?php    
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    } 
    if(!isset($_SESSION['admin']) && !isset($_SESSION['superAdmin'])){
        header('Location: ../index.php');
    }
    if(isset($_SESSION['admin']) || isset($_SESSION['superAdmin'])){
        if(isset($_SESSION['superAdmin'])){
            if($_SESSION['superAdmin'] == false){
                if($_SESSION['admin'] == false){
                    header('Location: ./verify.php?status=denied');
                }
            }
        }elseif($_SESSION['admin'] == false){
                header('Location: ./verify.php?status=denied');
            }
    }
?>
