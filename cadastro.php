<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Cadastrar-se</title>

    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- <script src="js.js"></script> -->
</head>

<?php
    
    require "conexao.php";
    
    $con = ConnectDB::get_connect();
    
    if($con){
       
        if(empty($_POST['nome'])){
            $erro = "Campo nome é Obrigatório.";
            echo "". $erro;
        }
        else if (empty($_POST['sobrenome'])){
            $erro = "Campo sobrenome é Obrigatório.";
            echo "". $erro;
        }
        else if(empty($_POST['email'])){
            $erro = "Campo email é Obrigatório.";
            echo "". $erro;
        }
        else if(empty($_POST['senha'])){
            $erro = "Campo senha é Obrigatório.";
            echo "". $erro;
        }
        else{
            $nome      = $_POST['nome'];
            $sobrenome = $_POST['sobrenome'];
            $senha     = $_POST['senha']; 
            $email     = $_POST['email'];

            $stmt = $con->prepare(
                "INSERT INTO usuario (nome, sobrenome, email, senha) VALUES (?,?,?,?)"
            );
            
            $stmt->bind_param('ssss', $nome, $sobrenome, $email, $senha);   
            
            if(!$stmt->execute()){
                $_SESSION['msg_cad'] = "Erro ao realizar o cadastro";
                header("location:form_cadastro.html");
            }                
            else{
                header("location:form_cadastro.html");
            }
            
            $stmt->close();
        }
    }
    $con->close();
?>
