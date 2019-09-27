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
<body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark  align-middle justify-content-center">
        <ul class="navbar-nav ">    
            <li class="nav-item">
                <a class="btn btn-sm btn-outline-light" href="caixa_entrada.php">Caixa de Entrada</a>
            </li>
        </ul>
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="btn btn-sm btn-outline-success" href="caixa_saida.php">Caixa de Saída</a>
            </li>
        </ul>
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="btn btn-sm btn-outline-light" href="pdf.php">Relatório</a>
            </li>
        </ul>
        <ul class="navbar-nav">
                <li class="nav-item">
                <button id="escrever" type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#enviar-email" data-backdrop="static">Escrever</button>
            </li>
        </ul>
        <ul class="navbar-nav"> 
            <li class="nav-item">
                <a class="btn btn-sm btn-outline-light" href="logout.php">Logout</a>
            </li>
        </ul>                
    </nav>
    
    <?php
        session_start();
        require "conexao.php";        
        
        $con = ConnectDB::get_connect();
       
        if($con){
            $usuario = $_SESSION['user_id'];
            // $sql = "select * from email where destinatario=$usuario";
            $sql = "SELECT u.nome, u.sobrenome, u.email, e.data, e.assunto, e.mensagem FROM usuario AS u JOIN email AS e ON remetente=$usuario WHERE u.id=e.destinatario";
           
            if($res = $con->query($sql)){
                if($res->num_rows > 0){
                    $html =  "
                        <div class='container'>
                        <h3>Caixa de Saida</h3>
                        <table class='table table-hover table-light'>
                        <thead>
                            <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>Destinatário</th>
                            <th scope='col'>Assunto</th>
                            <th scope='col'>Data</th>
                            <th scope='col'> - </th>
                            </tr>
                        </thead>
                        <tbody>
                    ";
                    $i = 1;
                    while($row = $res->fetch_array()){
                        $html .= "<tr>";
                        $html .= "<th scope='row'>$i</th>";
                        $html .= "<td>" . $row['nome']. " ". $row['sobrenome'] . "</td>";
                        $html .= "<td>" . $row['assunto']   . "</td>";
                        $html .= "<td>" . $row['data']      . "</td>";
                        $html .= "<td>" . "<button id='escrever' type='button' class='btn btn-sm btn-outline-primary' data-toggle='modal' data-target='#mensagem$i' data-backdrop='static'>Ver Mensagem</button>"  . "</td>";                        
                        $html .= "</tr>";                        

                        $html .= "
                        <div class='modal fade' id='mensagem$i' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                    ". $row['assunto'] ."
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                        
                                    </div>
                                    
                                        <div class='modal-body'>                    
                                            " . $row['mensagem']. "
                                            <div class='modal-footer'>
                                                <button class='btn btn-outline-dark' type='button' data-dismiss='modal'>Sair</button>
                                                <!-- <button class='btn btn-info' type='submit'>Enviar</button>
                                                <input id='btn-enviar-email' class='btn btn-info' type='submit' value='Enviar'> -->
                                            </div>                    
                                        </div>
                                                    
                                </div>
                            </div>
                        </div>
                        ";
                        $i++;
                    }
                    $html .= "</tbody></table></div>";
                    echo $html;

                    $res->free();
                }
            }
        }
        $con->close();
    ?>

    <div class="modal fade" id="enviar-email" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="enviar_email.php" method="post">
                    <div class="modal-body">                    
                        <div class="form-group">
                            <label for="destinatario">Destinatário</label>
                            <input id="destinatario" name="destinatario" type="text" class="form-control">
                            <small id="destinatarioHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="assunto">Assunto</label>
                            <input id="assunto" name="assunto" type="text" class="form-control">
                            <small id="assuntoHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="mensagem">Mensagem</label>
                            <textarea id="mensagem" name="mensagem" cols="50" rows="6" required></textarea>
                            <small id="mensagemHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-dark" type="button" data-dismiss="modal">Cancelar</button>
                            <!-- <button class="btn btn-info" type="submit">Enviar</button> -->
                            <input id="btn-enviar-email" class="btn btn-info" type="submit" value='Enviar'>
                        </div>                    
                    </div>
                </form>                
            </div>
        </div>
    </div>


</body>
</html>