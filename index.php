<?php
   session_start();
   if(!isset($_SESSION['submit']) && !isset($_SESSION['signupBtn'])){
      header('location:./login.php');
   }
   include_once "functions.php";
   $connexion = dbConnection ();


   if(isset($_SESSION['submit'])){
      $queryy = "select * FROM candidat as c 
      join candidatfiliere as cf 
      ON idCdFiliere_CandidatFiliere = cf.idCdFiliere
      join choisir as choice 
      ON idCandidat = choice.idCandidat_Candidat
      JOIN ecolefiliere as ecFiliere 
      on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere
      WHERE usernameCandidat like '%$_SESSION[usernameCandidat]%' and choice.numChoix = 1
      order by noteCandidat DESC, nomCandidat ASC";
      $resultt = selectOne1($queryy, $connexion);

      $queryy1 = "select * FROM candidat as c 
      join candidatfiliere as cf 
      ON idCdFiliere_CandidatFiliere = cf.idCdFiliere
      join choisir as choice 
      ON idCandidat = choice.idCandidat_Candidat
      JOIN ecolefiliere as ecFiliere 
      on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere
      WHERE usernameCandidat like '%$_SESSION[usernameCandidat]%' and choice.numChoix = 2
      order by noteCandidat DESC, nomCandidat ASC";
      $resultt1 = selectOne1($queryy1, $connexion);
   }
   
?>


<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Preinscription EST SAFI</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

   </head>
   <body>
      <div class="container1">   
      <?php include_once "nav.php"; ?>
         <div id="message"></div>
         <div class="login">
            
            
            <div class="container">
               <!-- <header>Formulaire d'inscription</header> -->
               <i class="fas fa-users user12"></i>
               <?php include_once "progressBar.html";?>

               <div class="form-outer">
                  <form action="" method="post" id="myForm" enctype="multipart/form-data">
                  <div class="page slide-page ">
                        <div class="title">Creation du compte:</div>
                        <?php
                           if(!isset($_SESSION['submit'])){
                              echo '
                              <div class="field field_inputs">
                                 <label name="usernameCandidat" class="label">Nom d\'utilisateur: <span style="color: red;">*</span> </label>
                                 <input name="usernameCandidat" type="text" class="input_user" id="input_user">
                                 <div class="msgUser  messageValid"></div>
                              </div>
                              <div class="field field_inputs">
                           <label name="passwordCandidat" class="label">Mot de passe:<span style="color: red;">*</span></label>
                           <input name="passwordCandidat" type="password" class="input_pwd">
                           <div class="msgPwd messageValid"></div>
                        </div>
                        <div class="field btns">
                           <button name="suivant1" type="button" class="firstNext next">Envoyer</button>
                        </div>
                     </div>


                     <div class="page page2">
                        <div class="title">Informations personnelles:</div>
                        <div class="field field1">
                           <label class="label">Photo:<span style="color: red;">*</span></label>
                           <input name="photo" id="photoFile" class="file_input" type="file">
                        </div>
                        <div class="field field_inputs field2">
                           <label class="label">Nom:<span style="color: red;">*</span></label>
                           <input name="nomCandidat" type="text" class="input_name" placeholder="Ex: Elkarouaoui">
                           <div class="msgNom messageValid"></div>
                        </div>
                        <div class="field field_inputs field3">
                           <label class="label">Prenom:<span style="color: red;">*</span></label>
                           <input name="prenomCandidat" type="text" class="input_prenom" placeholder="Ali">
                           <div class="msgPrenom messageValid"></div>
                        </div>
                        <div class="field field_inputs field4">
                           <label class="label">Email:<span style="color: red;">*</span></label>
                           <input class="emailCandidat input_email" name="emailCandidat" type="email" placeholder="Ex: ali@gmail.com">
                           <div class="msgEmail messageValid"></div>
                        </div>
                        <div class="field field_inputs field5">
                           <label class="label">N° de telephone:<span style="color: red;">*</span></label>
                           <input name="teleCandidat" type="tel" class="input_tel" placeholder="Ex: 0662057434">
                           <div class="msgTel messageValid"></div>
                        </div>
                        <div class="field field_inputs field6">
                           <label class="label">Adresse:<span style="color: red;">*</span></label>
                           <input name="adresseCandidat" type="text" class="input_adr" placeholder="Ex: numero rue quartier ville">
                           <div class="messageValid"></div>
                        </div>
                        <div class="field field_inputs field7">
                           <label class="label">N° CIN:<span style="color: red;">*</span></label>
                           <input name="cinCandidat" type="text" class="input_cin" placeholder="Ex: HH67890">
                           <div class="msgCin messageValid"></div>
                        </div>
                        <div class="field field_inputs field8">
                           <label class="label">N° CNE:<span style="color: red;">*</span></label>
                           <input name="cneCandidat" type="text" class="input_cne" placeholder="Ex: K123576872">
                           <div class="msgCne messageValid"></div>
                        </div>
                        <div class="field field9">
                           <label class="label">CIN:<span style="color: red;">*</span></label>
                           <input name="cinFileCandidat" class="file_input input_cinFile" type="file">
                        </div>
                        <div class="field btnGrid">
                           <button name="previous1" type="button" class="prev-1 prev">Previous</button>
                           <button name="suivant2" type="button" class="next-1 next">Envoyer</button>
                        </div>
                     </div>


                     <div class="page page3">
                        <div class="title">Informations educationnelles:</div>
                        <div class="field">
                           <div class="label">Filiere de bac:<span style="color: red;">*</span></div>
                           <select id="filieres" name="filiereCandidat" class="input_filiere">
                              <option value=""></option>
                              <option value="Science physique">SC PHYSIQUE</option>
                              <option value="Science math">SC MATH</option>
                              <option value="Science economique">SC ÉCONOMIQUES</option>
                              <option value="Techniques de gestion et comptabilité">TECHNIQUES DE GESTION ET COMPTABILITÉ</option>
                              <option value="Svt">SVT</option>
                              <option value="Sciences et technologies électriques">SCIENCES ET TECHNOLOGIES ÉLECTRIQUES</option>
                              <option value="Sciences et technologies mécaniques">SCIENCES ET TECHNOLOGIES MÉCANIQUES</option>
                           </select>
                        </div>
                        <div class="field">
                           <div class="label">Annee de bac:<span style="color: red;">*</span></div>
                           <select name="anneeBacCandidat" class="input_annee">
                           <option value=""></option>
                              <option value="2023">2023</option>
                              <option value="2022">2022</option>
                              <option value="2021">2021</option>
                           </select>
                        </div>
                        <div class="field">
                           <div class="label">Note de bac(75% + 25%):<span style="color: red;">*</span></div>
                           <input name="noteCandidat" type="text" class="input_note" placeholder="Ex: 16.54">
                           <div class="msgNote messageValid"></div>
                        </div>
                        <div class="field">
                           <div class="label">Baccalauréat:<span style="color: red;">*</span></div>
                           <input name="bacCandidat" class="file_input" type="file">
                        </div>
                        <div class="field">
                           <div class="label">Relevé de notes de bac:<span style="color: red;">*</span></div>
                           <input name="releveNoteCandidat" class="file_input" type="file">
                        </div>
                        <div class="field">
                           <div class="label">1er choix de filiere:<span style="color: red;">*</span></div>
                           <select name="filiere1Candidat" class="input_choix1">
                           <option value=""></option>
                              <option value="DUT techniques instrumentales & management de la qualité">DUT Techniques instrumentales & management de la qualité</option>
                              <option value="DUT Genie informatique">DUT Genie informatique</option>
                              <option value="DUT génie industriel & maintenance">DUT Génie industriel & maintenance</option>
                              <option value="DUT techniques de management">DUT Techniques de management</option>
                           </select>
                        </div>
                        <div class="field">
                           <div class="label">2eme choix de filiere:<span style="color: red;">*</span></div>
                           <select name="filiere2Candidat" class="input_choix2">
                           <option value=""></option>
                              <option value="DUT techniques instrumentales & management de la qualité">DUT Techniques instrumentales & management de la qualité</option>
                              <option value="DUT Genie informatique">DUT Genie informatique</option>
                              <option value="DUT génie industriel & maintenance">DUT Génie industriel & maintenance</option>
                              <option value="DUT techniques de management">DUT Techniques de management</option>
                           </select>
                        </div>
                        <div class="field btnGrid btns">
                           <button name="previousFinal" type="button" class="prev-2 prev">Précedent</button>
                           <button name="suivant3" type="button" class="submit next">Envoyer</button>
                        </div>
                     </div>';
                           }else{
                              echo '
                              <div class="field field_inputs">
                                 <label name="usernameCandidat" class="label">Nom d\'utilisateur: <span style="color: red;">*</span> </label>
                                 <input name="usernameCandidat" type="text" class="input_user notAllowed" id="input_user" value="'.$_SESSION["usernameCandidat"].'" readonly>
                                 <div class="msgUser  messageValid"></div>
                              </div>
                              <div class="field field_inputs">
                                 <label name="passwordCandidat" class="label">Mot de passe:<span style="color: red;">*</span></label>
                                 <input name="passwordCandidat" type="password" class="input_pwd notAllowed" value="'.$resultt["passwordCandidat"].'" readonly>
                                 <div class="msgPwd messageValid"></div>
                              </div>
                              <div class="field btns">
                                 <button name="suivant1" type="button" class="firstNext next">Envoyer</button>
                              </div>
                           </div>


                           <div class="page page2">
                              <div class="title">Informations personnelles:</div>
                              <div class="field field1">
                                 <label class="label">Photo:<span style="color: red;">*</span></label>
                                 <input name="photo" id="photoFile" class="file_input" type="file" value="'.$resultt["photoCandidat"].'">
                              </div>
                              <div class="field field_inputs field2">
                                 <label class="label">Nom:<span style="color: red;">*</span></label>
                                 <input name="nomCandidat" type="text" class="input_name" placeholder="Ex: Elkarouaoui" value="'.$resultt["nomCandidat"].'">
                                 <div class="msgNom messageValid"></div>
                              </div>
                              <div class="field field_inputs field3">
                                 <label class="label">Prenom:<span style="color: red;">*</span></label>
                                 <input name="prenomCandidat" type="text" class="input_prenom" placeholder="Ali" value="'.$resultt["prenomCandidat"].'">
                                 <div class="msgPrenom messageValid"></div>
                              </div>
                              <div class="field field_inputs field4">
                                 <label class="label">Email:<span style="color: red;">*</span></label>
                                 <input class="emailCandidat input_email" name="emailCandidat" type="email" placeholder="Ex: ali@gmail.com" value="'.$resultt["emailCandidat"].'">
                                 <div class="msgEmail messageValid"></div>
                              </div>
                              <div class="field field_inputs field5">
                                 <label class="label">N° de telephone:<span style="color: red;">*</span></label>
                                 <input name="teleCandidat" type="tel" class="input_tel" placeholder="Ex: 0662057434" value="'.$resultt["teleCandidat"].'">
                                 <div class="msgTel messageValid"></div>
                              </div>
                              <div class="field field_inputs field6">
                                 <label class="label">Adresse:<span style="color: red;">*</span></label>
                                 <input name="adresseCandidat" type="text" class="input_adr" placeholder="Ex: numero rue quartier ville" value="'.$resultt["adresseCandidat"].'">
                                 <div class="messageValid"></div>
                              </div>
                              <div class="field field_inputs field7">
                                 <label class="label">N° CIN:<span style="color: red;">*</span></label>
                                 <input name="cinCandidat" type="text" class="input_cin" placeholder="Ex: HH67890" value="'.$resultt["cinCandidat"].'">
                                 <div class="msgCin messageValid"></div>
                              </div>
                              <div class="field field_inputs field8">
                                 <label class="label">N° CNE:<span style="color: red;">*</span></label>
                                 <input name="cneCandidat" type="text" class="input_cne" placeholder="Ex: K123576872" value="'.$resultt["cneCandidat"].'">
                                 <div class="msgCne messageValid"></div>
                              </div>
                              <div class="field field9">
                                 <label class="label">CIN:<span style="color: red;">*</span></label>
                                 <input name="cinFileCandidat" class="file_input input_cinFile" type="file" value="'.$resultt["cinFileCandidat"].'">
                              </div>
                              <div class="field btnGrid">
                                 <button name="previous1" type="button" class="prev-1 prev">Previous</button>
                                 <button name="suivant2" type="button" class="next-1 next">Envoyer</button>
                              </div>
                           </div>


                           <div class="page page3">
                              <div class="title">Informations educationnelles:</div>
                              <div class="field">
                                 <div class="label">Filiere de bac:<span style="color: red;">*</span></div>
                                 <select id="filieres" name="filiereCandidat" class="input_filiere">
                                    <option value="'.$resultt["nomCdFiliere"].'" selected>'.$resultt["nomCdFiliere"].'</option>
                                    <option value=""></option>
                                    <option value="Science physique">SC PHYSIQUE</option>
                                    <option value="Science math">SC MATH</option>
                                    <option value="Science economique">SC ÉCONOMIQUES</option>
                                    <option value="Techniques de gestion et comptabilité">TECHNIQUES DE GESTION ET COMPTABILITÉ</option>
                                    <option value="Svt">SVT</option>
                                    <option value="Sciences et technologies électriques">SCIENCES ET TECHNOLOGIES ÉLECTRIQUES</option>
                                    <option value="Sciences et technologies mécaniques">SCIENCES ET TECHNOLOGIES MÉCANIQUES</option>
                                 </select>
                              </div>
                              <div class="field">
                                 <div class="label">Annee de bac:<span style="color: red;">*</span></div>
                                 <select name="anneeBacCandidat" class="input_annee" >
                                    <option value="'.$resultt["anneeBacCandidat"].'" selected>'.$resultt["anneeBacCandidat"].'</option>
                                    <option value=""></option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                 </select>
                              </div>
                              <div class="field">
                                 <div class="label">Note de bac(75% + 25%):<span style="color: red;">*</span></div>
                                 <input name="noteCandidat" type="text" class="input_note" placeholder="Ex: 16.54" value="'.$resultt["noteCandidat"].'">
                                 <div class="msgNote messageValid"></div>
                              </div>
                              <div class="field">
                                 <div class="label">Baccalauréat:<span style="color: red;">*</span></div>
                                 <input name="bacCandidat" class="file_input" type="file" value="'.$resultt["bacCandidat"].'">
                              </div>
                              <div class="field">
                                 <div class="label">Relevé de notes de bac:<span style="color: red;">*</span></div>
                                 <input name="releveNoteCandidat" class="file_input" type="file" value="'.$resultt["releveNoteCandidat"].'">
                              </div>
                              <div class="field">
                                 <div class="label">1er choix de filiere:<span style="color: red;">*</span></div>
                                 <select name="filiere1Candidat" class="input_choix1">
                                    <option value="'.$resultt["nomEcFiliere"].'" selected>'.$resultt["nomEcFiliere"].'</option>
                                    <option value=""></option>
                                    <option value="DUT techniques instrumentales & management de la qualité">DUT Techniques instrumentales & management de la qualité</option>
                                    <option value="DUT Genie informatique">DUT Genie informatique</option>
                                    <option value="DUT génie industriel & maintenance">DUT Génie industriel & maintenance</option>
                                    <option value="DUT techniques de management">DUT Techniques de management</option>
                                 </select>
                              </div>
                              <div class="field">
                                 <div class="label">2eme choix de filiere:<span style="color: red;">*</span></div>
                                 <select name="filiere2Candidat" class="input_choix2">
                                    <option value="'.$resultt1["nomEcFiliere"].'" selected>'.$resultt1["nomEcFiliere"].'</option>
                                    <option value="DUT techniques instrumentales & management de la qualité">DUT Techniques instrumentales & management de la qualité</option>
                                    <option value="DUT Genie informatique">DUT Genie informatique</option>
                                    <option value="DUT génie industriel & maintenance">DUT Génie industriel & maintenance</option>
                                    <option value="DUT techniques de management">DUT Techniques de management</option>
                                 </select>
                              </div>
                              <div class="field btnGrid btns">
                                 <button name="previousFinal" type="button" class="prev-2 prev">Précedent</button>
                                 <button name="suivant3" type="button" class="submit next">Envoyer</button>
                              </div>
                           </div>
                              
                              
                              ';
                           }
                          
                        ?>
                        
                     
                     
                  </form>
               </div>
            </div>
            <!-- <div class="form_side">
                <div class="pic"></div>
            </div> -->
         </div>
         <div class="copyright">&copy; EST SAFI All rights reserved </div>
      </div>
   </body>
   <script src="script.js"></script>
</html>