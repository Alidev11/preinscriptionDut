<?php
//etablit la connexion al la base de donnees
   session_start();
   // $_SESSION["username"];
   
   include_once "functions.php";
   $connexion = dbConnection();
   
   $response = array('success' => false);
   if(isset($_POST['nomCandidat'])){
      $sqlQuery = "select idCandidat from candidat WHERE usernameCandidat = :username";
      $username = $_SESSION["username"];
      $varName1 = ":username";
      $resultSelect = selectOne($sqlQuery, $connexion, $username, $varName1);
      $idCand = $resultSelect["idCandidat"];
      $_SESSION["IDcandidat"] = $idCand;
      
      $src = $_FILES['photo']['tmp_name'];
      $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
      $dest="./Candidat/Photo/".$idCand.".".$ext;
      move_uploaded_file($src,$dest);

      $src1 = $_FILES['cinFileCandidat']['tmp_name'];
      $ext1 = pathinfo($_FILES['cinFileCandidat']['name'], PATHINFO_EXTENSION);
      $dest1="./Candidat/cinFile/".$idCand.".".$ext1;
      move_uploaded_file($src1,$dest1);

      $sqlQuery = "UPDATE candidat 
      SET photoCandidat = '".addslashes($dest)."',
      nomCandidat= '".addslashes($_POST["nomCandidat"]). "',
      prenomCandidat= '".addslashes($_POST["prenomCandidat"])."',
      emailCandidat= '".addslashes($_POST["emailCandidat"])."',
      teleCandidat= '".addslashes($_POST["teleCandidat"])."',
      adresseCandidat= '".addslashes($_POST["adresseCandidat"])."',
      cinCandidat= '".addslashes($_POST["cinCandidat"])."',
      cneCandidat= '".addslashes($_POST["cneCandidat"])."',
      cinFileCandidat=  '".addslashes($dest1)."' WHERE idCandidat = :idCand;";
      
      if(update($sqlQuery, $connexion, $idCand)){
         $response['success'] = true;
      }
   }
   echo json_encode($response);

?>
