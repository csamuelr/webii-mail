<?php
    session_start();
    require "fpdf/fpdf.php";
    
    require "conexao.php";

    $con = ConnectDB::get_connect();

    $pdf= new FPDF();
    
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190, 10, utf8_decode("E-mails Enviados"), 0, 0, 'c');
    $pdf->Ln(15);

    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(90, 7, 'Destinatario', 1, 0, 'C');
    $pdf->Cell(90, 7, 'Assunto', 1, 0, 'C');
    $pdf->Ln();

    if($con){
        $usuario = $_SESSION['user_id'];
        $sql = "SELECT u.nome, u.sobrenome, e.assunto FROM usuario AS u JOIN email AS e ON destinatario=$usuario WHERE u.id=$usuario";
   
        if($res = $con->query($sql)){
            if($res->num_rows > 0){                
                while($row = $res->fetch_array()){
                    $pdf->SetFont('arial', 'I', 10);
                    $nome = $row['nome']  . " ". $row['sobrenome'];
                    $pdf->Cell(90, 7, utf8_decode($nome), 1, 0, 'C');
                    $pdf->Cell(90, 7, utf8_decode($row['assunto']), 1, 0, 'C');
                    $pdf->Ln(7);
                }
                $pdf->Ln(2);
                $pdf->Cell(90, 7, utf8_decode("TOTAL"), 1, 0, 'c');
                $pdf->Cell(90, 7, utf8_decode($res->num_rows), 1, 0, 'c');               
                $res->free();
            }
        }
    }

    $pdf->Ln(10);
    
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190, 10, utf8_decode("E-mails Recebidos"), 0, 0, 'c');
    $pdf->Ln(15);

    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(90, 7, 'Remetente', 1, 0, 'C');
    $pdf->Cell(90, 7, 'Assunto', 1, 0, 'C');
    $pdf->Ln();

    if($con){
        $usuario = $_SESSION['user_id'];
        $sql = "SELECT u.nome, u.sobrenome, e.assunto FROM usuario AS u JOIN email AS e ON remetente=$usuario WHERE u.id=$usuario";
   
        if($res = $con->query($sql)){
            if($res->num_rows > 0){                
                while($row = $res->fetch_array()){
                    $pdf->SetFont('arial', 'I', 10);
                    $nome = $row['nome']  . " ". $row['sobrenome'];
                    $pdf->Cell(90, 7, utf8_decode($nome), 1, 0, 'C');
                    $pdf->Cell(90, 7, utf8_decode($row['assunto']), 1, 0, 'C');
                    $pdf->Ln(7);
                }
                $pdf->Ln(2);
                $pdf->Cell(90, 7, utf8_decode("TOTAL"), 1, 0, 'c');
                $pdf->Cell(90, 7, utf8_decode($res->num_rows), 1, 0, 'c');               
                $res->free();
            }
        }
    }

    $con->close();
    $pdf->Output();
?>