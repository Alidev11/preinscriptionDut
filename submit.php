<?php
//etablit la connexion al la base de donnees
   session_start();
   if(isset($_POST["usernameCandidat"]))
      $_SESSION["username"]=$_POST["usernameCandidat"];
   $sessId=session_id();
   include_once "functions.php";
   $connexion = dbConnection ();
   $response = array('success' => false);
   //check if username isset
   if(isset($_POST['usernameCandidat'])){
         $sqlQuery = "select usernameCandidat from candidat WHERE usernameCandidat = :username";
         $username = $_POST["usernameCandidat"];
         $resultSelect = selectAll($sqlQuery, $connexion, $username);
         if(!empty ($resultSelect)){
            $response['success'] = true;
         }
         //check if same username is in database... if so we dont insert, else we insert
         if(empty ($resultSelect)){
            $sqlQuery = "INSERT INTO candidat(usernameCandidat,passwordCandidat) 
                        VALUES(
                                 '".addslashes($_POST["usernameCandidat"])."',
                                 '".addslashes($_POST["passwordCandidat"])."'
                           )";
            $resultInsert = insert($sqlQuery, $connexion);
            if($resultInsert){
               $response['success'] = true;
            }
         }
   }
   echo json_encode($response);

?>
