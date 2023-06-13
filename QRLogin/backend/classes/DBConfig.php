<?php
class DBConfig{
    public function connect(){
        try{
            $conn = new PDO("mysql:host=localhost;dbname=inlogTechnolab", 'root', '',);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function checkAdmin($userId){
        try{
            $sql = "SELECT isAdmin, isSuperAdmin FROM users WHERE id = :userid";
            $exec = $this->connect()->prepare($sql);
            $exec->bindParam(":userid", $userId); 
            if($exec->execute()){
                if(session_status() == PHP_SESSION_NONE){
                    session_start();
                }
                $result = $exec->fetch(PDO::FETCH_OBJ);
                if($result->isAdmin == 1 || $result->isSuperAdmin == 1){
                    if($result->isSuperAdmin == 1){
                        $_SESSION['superAdmin'] = true;
                        $_SESSION['admin'] = true;
                        if(!isset($_GET['page'])){
                            header('Location: ./dash.php?pageno=0&status=true');
                            exit();
                        }else{
                            if($_GET['page'] == "superCheck"){
                                header('Location: https://localhost/phpmyadmin/index.php?page=super');
                            }
                        }
                    }
                    $_SESSION['admin'] = true;
                    $_SESSION['superAdmin'] = false;
                    header('Location: ./dash.php?pageno=0&status=true');
                    exit();
                }else{
                    header( "Location: ./verify.php?status=denied" );
                    exit(); 
                }
            }
        } catch(Exception $e){
            return $e->getMessage();
        }
    }
    
}
?>