<?php    
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    } 
    if(!isset($_SESSION['superAdmin'])){
        header('Location: http://localhost/QRLogin/web/');
    }
    if(isset($_SESSION['superAdmin'])){
        if($_SESSION['superAdmin'] == 0){
            header('Location: http://localhost/QRLogin/web/');
        }if($_SESSION['superAdmin'] == 1){
            if(isset($_GET['page'])){
                if($_GET['page'] == "super"){
                    header('Location: ./technoBase/index.php');
                }
            }else{
                header('Location: http://localhost/QRLogin/web/backend/verify.php?page=superCheck');
            }
        }else{
            header('Location: http://localhost/QRLogin/web/');
        }
    }
?>
