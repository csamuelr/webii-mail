<?php

    require "conexao.php";    
    
    $con = ConnectDB::get_connect();

    if ($con){
        if(empty($_POST['email'])){
            $erro = "Campo email é Obrigatório.";
            echo "". $erro;
        }
        else if(empty($_POST['senha'])){
            $erro = "Campo senha é Obrigatório.";
            echo "". $erro;
        }
        else{
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $stmt = $con->prepare(
                "SELECT id, email, senha FROM usuario WHERE email=?" 
            );

            $stmt->bind_param('s', $email);

            $stmt->execute();
            $result = $stmt->get_result();
            $aux    = $result->fetch_assoc();

            $q_user  = $aux['id'];
            $q_email = $aux['email'];
            $q_senha = $aux['senha'];

            $result; 
            if(!strcmp($email, $q_email) && !strcmp($senha, $q_senha)){
                session_start();
                $_SESSION['user_id'] = $q_user;
                $_SESSION['user_email'] = $q_email;
                $_SESSION['msg_login'] = "Email ou senha inválidos!";

                header("location:caixa_entrada.php");
            }
            else{
                unset($_SESSION['user_id']);
                unset($_SESSION['user_email']);  
                header("location:index.php");        
            }
            echo "<div class='alert alert-warning' role='alert'> $result </div>";
                            
            $stmt->close();
        }
    }
    $con->close();
?>
