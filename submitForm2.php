<?php
//etablit la connexion al la base de donnees
   session_start();
   include_once "functions.php";
   $connexion = dbConnection ();
   $i=0;
   $response = array('success' => false);
   if(isset($_POST['filiereCandidat'])){
         $sqlQuery = "SELECT nomCdFiliere FROM candidatfiliere";
         $result = selectAll1($sqlQuery, $connexion);
         if(empty ($result)){
            $sqlQuery = "INSERT INTO candidatfiliere(nomCdFiliere) 
                  VALUES(
                           '".addslashes($_POST["filiereCandidat"])."'
                     )";
            insert($sqlQuery, $connexion);
         }else{
            foreach($result as $x => $x_value) {
               if($_POST["filiereCandidat"] == $x_value["nomCdFiliere"]){
                  $i += 1;
               }
            };
            if($i == 0){
               $sqlQuery = "INSERT INTO candidatfiliere(nomCdFiliere) 
                  VALUES(
                           '".addslashes($_POST["filiereCandidat"])."'
                     )";
               insert($sqlQuery, $connexion);
            }
         }
         $idCand = $_SESSION["IDcandidat"];
         $src = $_FILES['bacCandidat']['tmp_name'];
         $ext = pathinfo($_FILES['bacCandidat']['name'], PATHINFO_EXTENSION);
         $dest="./Candidat/Bac/".$idCand.".".$ext;
         move_uploaded_file($src,$dest);

         $src1 = $_FILES['releveNoteCandidat']['tmp_name'];
         $ext1 = pathinfo($_FILES['releveNoteCandidat']['name'], PATHINFO_EXTENSION);
         $dest1="./Candidat/ReleveNotes/".$idCand.".".$ext1;
         move_uploaded_file($src1,$dest1);


         $sqlQuery = "UPDATE candidat
         SET 
         anneeBacCandidat = '".addslashes($_POST["anneeBacCandidat"])."',
         noteCandidat = '".addslashes($_POST["noteCandidat"])."',
         bacCandidat = '".addslashes($dest)."',
         releveNoteCandidat = '".addslashes($dest1)."' WHERE idCandidat = :idCand;";
         
         
         update($sqlQuery, $connexion, $idCand);

         $sqlQuery = "select * from candidatfiliere where nomCdFiliere = :filiere";
         $filiere = $_POST["filiereCandidat"];
         $varName1 = ":filiere";
         $resultSelect = selectOne($sqlQuery, $connexion, $filiere, $varName1);
         if($resultSelect){
            $response['success'] = true;
         }
         $sqlQuery = "UPDATE candidat
         SET idCdFiliere_CandidatFiliere = '".addslashes($resultSelect["idCdFiliere"])."' WHERE idCandidat = :idCand;";
         update($sqlQuery, $connexion, $idCand);

         $i=0;
         $j=0;
         $sqlQuery = "SELECT nomEcFiliere FROM ecolefiliere";
         $result1 = selectAll1($sqlQuery, $connexion);
         if(empty ($result1)){
            $sqlQuery = "INSERT INTO ecolefiliere(nomEcFiliere) 
                  VALUES(
                           '".addslashes($_POST["filiere1Candidat"])."',
                           '".addslashes($_POST["filiere2Candidat"])."'

                     )";
            insert($sqlQuery, $connexion);
         }else{
            foreach($result1 as $key => $value) {
               if($_POST["filiere1Candidat"] == $value["nomEcFiliere"])
                  $i += 1;
               elseif($_POST["filiere2Candidat"] == $value["nomEcFiliere"])
                  $j +=1;
            };
            if($i == 0){
               $sqlQuery = "INSERT INTO ecolefiliere(nomEcFiliere) 
                  VALUES(
                           '".addslashes($_POST["filiere1Candidat"])."'
                     )";
               insert($sqlQuery, $connexion);
            }elseif($j == 0){
               $sqlQuery = "INSERT INTO ecolefiliere(nomEcFiliere) 
                  VALUES(
                           '".addslashes($_POST["filiere2Candidat"])."'
                     )";
               insert($sqlQuery, $connexion);
            }
         }

         $sqlQuery = "select * from ecolefiliere where nomEcFiliere = :ECfiliere1";
         $ECfiliere = $_POST["filiere1Candidat"];
         $varName1 = ":ECfiliere1";
         $resultSelect1 = selectOne($sqlQuery, $connexion, $ECfiliere, $varName1);

         $sqlQuery = "select * from ecolefiliere where nomEcFiliere = :ECfiliere2";
         $ECfiliere = $_POST["filiere2Candidat"];
         $varName1 = ":ECfiliere2";
         $resultSelect2 = selectOne($sqlQuery, $connexion, $ECfiliere, $varName1);

         $sqlQuery = "SELECT * FROM choisir";
         $result1 = selectAll1($sqlQuery, $connexion);
         $x = 0;
         $y = 0;
         if(empty ($result1)){
            $sqlQuery = "INSERT INTO choisir(idCandidat_Candidat, idEcFiliere_EcoleFiliere, numChoix) 
                  VALUES(
                           '".addslashes($_SESSION["IDcandidat"])."',
                           '".addslashes($resultSelect1["idEcFiliere"])."',
                           '".addslashes("1")."'
                     )";
            insert($sqlQuery, $connexion);
            $sqlQuery1 = "INSERT INTO choisir(idCandidat_Candidat, idEcFiliere_EcoleFiliere, numChoix) 
                  VALUES(
                           '".addslashes($_SESSION["IDcandidat"])."',
                           '".addslashes($resultSelect2["idEcFiliere"])."',
                           '".addslashes("2")."'
                     )";
            insert($sqlQuery1, $connexion);
         }else{
            foreach($result1 as $key => $value) {
               if($_SESSION["IDcandidat"] == $value["idCandidat_Candidat"] && $value["numChoix"] == 1)
                  $x += 1;
               if($_SESSION["IDcandidat"] == $value["idCandidat_Candidat"] && $value["numChoix"] == 2)
                  $y +=1;
            };
            if($x == 0){
               $sqlQuery11 = "INSERT INTO choisir(idCandidat_Candidat, idEcFiliere_EcoleFiliere, numChoix) 
                  VALUES(
                           '".addslashes($_SESSION["IDcandidat"])."',
                           '".addslashes($resultSelect1["idEcFiliere"])."',
                           '".addslashes("1")."'
                     )";
               insert($sqlQuery11, $connexion);
            }if($y == 0){
               $sqlQuery12 = "INSERT INTO choisir(idCandidat_Candidat, idEcFiliere_EcoleFiliere, numChoix) 
                  VALUES(
                           '".addslashes($_SESSION["IDcandidat"])."',
                           '".addslashes($resultSelect2["idEcFiliere"])."',
                           '".addslashes("2")."'
                     )";
               insert($sqlQuery12, $connexion);
            }
         }

         $idCand = $_SESSION["IDcandidat"];
         $sqlQuery0 = "UPDATE choisir
         SET idEcFiliere_EcoleFiliere = '".addslashes($resultSelect1["idEcFiliere"])."' WHERE idCandidat_Candidat = :idCand and numchoix = 1;";
         update($sqlQuery0, $connexion, $idCand);

         $sqlQuery00 = "UPDATE choisir
         SET idEcFiliere_EcoleFiliere = '".addslashes($resultSelect2["idEcFiliere"])."' WHERE idCandidat_Candidat = :idCand and numchoix = 2;";
         update($sqlQuery00, $connexion, $idCand);
   }
   echo json_encode($response);

?>
