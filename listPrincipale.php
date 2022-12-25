<?php
//etablit la connexion al la base de donnees
    session_start();
    $response = array('success' => false);
    if(isset($_POST["afficher"])){
        $_SESSION["filiereAdmin"]=$_POST["filiere"];
        $_SESSION["nbEtudiantAdmin"]=$_POST["nbEtudiant"];
        $_SESSION["pMathAdmin"]=$_POST["pMath"];
        $_SESSION["pPhysiqueAdmin"]=$_POST["pPhysique"];
        $_SESSION["pEcoAdmin"]=$_POST["pEco"];
        $_SESSION["pSvtAdmin"]=$_POST["pSvt"];
        $_SESSION["pElecAdmin"]=$_POST["pElec"];
        $_SESSION["afficher"]=$_POST["afficher"];
        $response['success'] = true;

    }
    echo json_encode($response);
    header("location:./admin.php?etat=".$response['success']);
?>
