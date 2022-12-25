<?php
//etablit la connexion al la base de donnees
    session_start();
    $response = array('success' => false);
    if(isset($_POST["afficher1"])){
        $_SESSION["filiereAdmin1"]=$_POST["filiere1"];
        $_SESSION["nbEtudiantAdmin1"]=$_POST["nbEtudiant1"];
        $_SESSION["pMathAdmin1"]=$_POST["pMath1"];
        $_SESSION["pPhysiqueAdmin1"]=$_POST["pPhysique1"];
        $_SESSION["pEcoAdmin1"]=$_POST["pEco1"];
        $_SESSION["pSvtAdmin1"]=$_POST["pSvt1"];
        $_SESSION["pElecAdmin1"]=$_POST["pElec1"];
        $_SESSION["afficher1"]=$_POST["afficher1"];
        $response['success'] = true;

    }
    echo json_encode($response);
    header("location:./admin.php?etat1=".$response['success']);
?>
