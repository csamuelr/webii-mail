<!DOCTYPE html>
<html lang="pt-br">
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
</head>
<body>
   <div class='cadastro'>      
        <h3>Cadastrar-se</h3>
        <form action="cadastro.php" method="post">
            <div class="container form-group">
                <?php 
                    session_start();
                    if(isset($_SESSION['msg_cad'])){
                        echo "<div class='alert alert-danger' role='alert'>
                                ". $_SESSION['msg_cad']. "
                            </div>";
                    }
                ?>
                <div class="row container-fluid">                    
                    <div id="in" class="col" >
                        <label for="nome">Nome</label>
                        <input class="form-control" id='nome' name="nome" type="text" placeholder="Nome">
                    </div>  
                    
                    <div id="in" class="col">
                        <label for="sobrenome">Sobrenome</label>
                        <input class="form-control" id="sobrenome" name="sobrenome" type="text" placeholder="Sobrenome">
                    </div>
                </div>

                <div  class="container-fluid">
                    <label for="email">E-mail</label>
                    <input class="form-control" id="email" name="email" type="email" placeholder="email@provedor.com">
                </div>

                <div id="in" class="container-fluid">
                    <label for="senha">Senha</label>
                    <input class="form-control" id="senha" name="senha" type="password" placeholder="Senha">
                </div>

                <div id="in" class="container-fluid">
                    <input class="btn btn-outline-primary" type="submit" value="Cadastrar-se">
                </div>

            </div>
        </form>       
   </div>
</body>
</html>