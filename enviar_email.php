<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Caixa de Saída</title>

    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- <script src="js.js"></script> -->
</head>
<?php

    session_start();
    require "conexao.php";
    
    $con = ConnectDB::get_connect();

    // echo $_POST['destinatario'] . $_POST['assunto'] . $_POST['mensagem'];

    if($con){
        if(empty($_POST['destinatario'])){
            echo "empty 1";
        }
        else if(empty($_POST['assunto'])){
            echo "empty 2";
        }
        else if(empty($_POST['mensagem'])){
            echo "empty 3";
        }
        else{
            // echo "else";
            if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
                // echo "if";
                $usuario      = $_SESSION['user_id'];
                $destinatario = $_POST['destinatario'];
                $assunto      = $_POST['assunto'];
                $mensagem     = $_POST['mensagem'];

                $stmt = $con->prepare(
                    "SELECT id FROM usuario WHERE email=?"
                );

                // echo "select 1";
                $stmt->bind_param('s', $destinatario);
                $stmt->execute();
                // echo "execute 1";

                $result = $stmt->get_result();
                $aux = $result->fetch_assoc();
                // echo "fetch";
                if($aux['id'] != NULL){
                    $destinatario = $aux['id'];
                }
                else{
                    echo "<h4>Erro. O Email informado não existe.</h4>";
                    $stmt->close();
                    $con->close();
                    exit();
                }

                $stmt = $con->prepare(
                    "INSERT INTO email (remetente, destinatario, assunto, mensagem) VALUES (?,?,?,?)"
                );

                // echo "select 2";
                $stmt->bind_param('ssss', $usuario, $destinatario, $assunto, $mensagem);
              
                if(!$stmt->execute())
                    echo "<h4>Erro. Email Não Enviado.</h4>";

                else{
                    echo "<h4>Email Enviado.</h4>";
                }
                
                $stmt->close();
            }
            else{
                location('reload:index.php');
            }
        }
        $con->close();
    }
?>