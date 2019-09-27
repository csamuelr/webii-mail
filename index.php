<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>SMAIL</title>
</head>
<body>
    
    <div class="login">
        <form action="login.php" method="post">
            <fieldset>
                <h3>Entrar</h3>       
                <?php 
                    session_start();
                    if(isset($_SESSION['msg_cad'])){
                        echo "<div class='alert alert-danger' role='alert'>
                                ". $_SESSION['msg_login']. "
                            </div>";
                    }  
                ?>
                <div class="container form-group">
                    <div id="in" class="container-fluid">
                        <label for="email">E-mail</label>
                        <input class="form-control" name="email" type="email">
                    </div>
                    <div id="in" class="container-fluid">
                        <label for="senha">Senha</label>
                        <input class="form-control" name="senha" type="password">
                    </div>
                    <div id="btn-entrar" class="container-fluid">
                        <input class="btn btn-success form-control" type="submit" value="Entrar">
                        <a href="form_cadastro.html" class="btn btn-info form-control">Cadastrar-se</a>
                    </div> 
                </div>    

            </fieldset>
        </form>
    </div>
</body>
</html>


