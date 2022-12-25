<?php
    session_start();
    require_once './functions.php';
    $connexion = dbConnection();
    $rowCount = 4;
    require_once('./Fpdf/fpdf.php');
    $pdf = new FPDF('p');
    $pdf->AddPage();
    $pdf->SetFont("Arial","U",16);
    $pdf->Cell(200,10,"",0,1,'C');
    $pdf->Image("./Images/est_logo.png", 80, 10, 60, 30);
    $pdf->Cell(200,13,"",0,1,'C');
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(0,10,"Liste principale",0,1,'C');
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont("Arial","B",14);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(53, 54, 56);
    $pdf->Cell(45,10,"Nom",1,0,'C', true);
    $pdf->Cell(45,10,"Prenom",1,0,'C', true);
    $pdf->Cell(45,10,"Cin",1,0,'C', true);
    $pdf->Cell(45,10,"Cne",1,1,'C', true);
    $pdf->SetFont("Arial","",12);
    $pdf->SetTextColor(0, 0, 0);
    
    $k = 1;
    if(isset($_SESSION["arrayMerged"]) && isset($_SESSION["nbEtudiantAdmin"])){
        $arrayMerged = $_SESSION["arrayMerged"];
        foreach($arrayMerged as $key => $value){
            if($k <= $_SESSION["nbEtudiantAdmin"]){
                $pdf->Cell(45,10,"$value[nomCandidat]",1,0,'C');
                $pdf->Cell(45,10,"$value[prenomCandidat]",1,0,'C');
                $pdf->Cell(45,10,"$value[cinCandidat]",1,0,'C');
                $pdf->Cell(45,10,"$value[cneCandidat]",1,1,'C');
                $k += 1;
            }else{
                break;
            }
        }
        $pdf->Output('D','listePrincipale.pdf');
    }
?>



