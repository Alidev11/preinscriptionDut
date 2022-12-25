<?php
//etablit la connexion al la base de donnees
    session_start();
    if(!isset($_SESSION['submit'])){
        header('location:./login.php');
     }
    $sessId=session_id();
    include_once "functions.php";
    $connexion = dbConnection ();
    // $response = array('success' => false);
    //check if username isset

    $query = "select count(DISTINCT idCandidat_Candidat) as numGI FROM choisir
    WHERE idEcFiliere_EcoleFiliere = 1;";

    $result = selectOne1($query, $connexion);

    $query1 = "select count(DISTINCT idCandidat_Candidat) as numGIM FROM choisir
    WHERE idEcFiliere_EcoleFiliere = 6;";

    $result1 = selectOne1($query1, $connexion);

    $query2 = "select count(DISTINCT idCandidat_Candidat) as numTM FROM choisir
    WHERE idEcFiliere_EcoleFiliere = 7;";

    $result2 = selectOne1($query2, $connexion);

    $query4 = "select count(DISTINCT idCandidat_Candidat) as numTIMQ FROM choisir
    WHERE idEcFiliere_EcoleFiliere = 8;";

    $result4 = selectOne1($query4, $connexion);

    $query3 = "select count(DISTINCT idCandidat) as numTotal FROM candidat";

    $result3 = selectOne1($query3, $connexion);


    if(isset($_SESSION["filiereAdmin"]) && isset($_SESSION["pPhysiqueAdmin"])){
        $sqlQuery = "
        select DISTINCT nomCandidat, prenomCandidat, cinCandidat, cneCandidat, nomEcFiliere 
        from candidat as c 
        join choisir as choice 
        ON idCandidat = choice.idCandidat_Candidat 
        JOIN ecolefiliere as ecFiliere 
        on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere 
        WHERE nomEcFiliere like '%$_SESSION[filiereAdmin]%' 
        order by noteCandidat DESC LIMIT $_SESSION[nbEtudiantAdmin];
        ";
        $resultSelect = selectAll1($sqlQuery, $connexion);
// --------------------------------- CALCULATE LIMIT ------------------------------------------
        $sqlQuery2 = "
            select COUNT(nomCandidat) as numScMath 
            from candidat as c 
            join candidatfiliere as cf 
            ON idCdFiliere_CandidatFiliere = cf.idCdFiliere
            join choisir as choice 
            ON idCandidat = choice.idCandidat_Candidat
            JOIN ecolefiliere as ecFiliere 
            on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere
            WHERE nomEcFiliere like '%$_SESSION[filiereAdmin]%' and cf.nomCdFiliere like '%Math%'
            order by noteCandidat DESC, nomCandidat ASC;
        ";
        $resultSelect2 = selectOne1($sqlQuery2, $connexion);
        $limitScMath = intval($resultSelect2["numScMath"] * intval($_SESSION["pMathAdmin"])/100);
        // echo $limitScMath;

        $sqlQuery3 = "
            select COUNT(nomCandidat) as numScPhy 
            from candidat as c 
            join candidatfiliere as cf 
            ON idCdFiliere_CandidatFiliere = cf.idCdFiliere
            join choisir as choice 
            ON idCandidat = choice.idCandidat_Candidat
            JOIN ecolefiliere as ecFiliere 
            on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere
            WHERE nomEcFiliere like '%$_SESSION[filiereAdmin]%' and cf.nomCdFiliere like '%Physique%'
            order by noteCandidat DESC, nomCandidat ASC;
        ";
        $resultSelect3 = selectOne1($sqlQuery3, $connexion);
        $limitScPhy = intval($resultSelect3["numScPhy"] * intval($_SESSION["pPhysiqueAdmin"])/100);
        // echo $limitScPhy;

        $sqlQuery4 = "
            select COUNT(nomCandidat) as numScEco 
            from candidat as c 
            join candidatfiliere as cf 
            ON idCdFiliere_CandidatFiliere = cf.idCdFiliere
            join choisir as choice 
            ON idCandidat = choice.idCandidat_Candidat
            JOIN ecolefiliere as ecFiliere 
            on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere
            WHERE nomEcFiliere like '%$_SESSION[filiereAdmin]%' and cf.nomCdFiliere like '%economique%'
            order by noteCandidat DESC, nomCandidat ASC;
        ";
        $resultSelect4 = selectOne1($sqlQuery4, $connexion);
        $limitScEco = intval($resultSelect4["numScEco"] * intval($_SESSION["pEcoAdmin"])/100);
        // echo $limitScEco;

        $sqlQuery5 = "
            select COUNT(nomCandidat) as numSvt 
            from candidat as c 
            join candidatfiliere as cf 
            ON idCdFiliere_CandidatFiliere = cf.idCdFiliere
            join choisir as choice 
            ON idCandidat = choice.idCandidat_Candidat
            JOIN ecolefiliere as ecFiliere 
            on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere
            WHERE nomEcFiliere like '%$_SESSION[filiereAdmin]%' and cf.nomCdFiliere like '%Svt%'
            order by noteCandidat DESC, nomCandidat ASC;
        ";
        $resultSelect5 = selectOne1($sqlQuery5, $connexion);
        $limitSvt = intval($resultSelect5["numSvt"] * intval($_SESSION["pSvtAdmin"])/100);
        // echo $limitSvt;

        $sqlQuery6 = "
            select COUNT(nomCandidat) as numElec 
            from candidat as c 
            join candidatfiliere as cf 
            ON idCdFiliere_CandidatFiliere = cf.idCdFiliere
            join choisir as choice 
            ON idCandidat = choice.idCandidat_Candidat
            JOIN ecolefiliere as ecFiliere 
            on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere
            WHERE nomEcFiliere like '%$_SESSION[filiereAdmin]%' and cf.nomCdFiliere like '%elec%'
            order by noteCandidat DESC, nomCandidat ASC;
        ";
        $resultSelect6 = selectOne1($sqlQuery6, $connexion);
        $limitElec = intval($resultSelect6["numElec"] * intval($_SESSION["pElecAdmin"])/100);
        // echo $limitElec;

        // echo $arrayMerged["numScPhy"];
        // --------------------------------------------------------------------------------------

        $sqlQueryy = "
        select DISTINCT nomCandidat, prenomCandidat, cinCandidat, cneCandidat, nomEcFiliere 
        from candidat as c 
        join candidatfiliere as cf 
        ON idCdFiliere_CandidatFiliere = cf.idCdFiliere
        join choisir as choice 
        ON idCandidat = choice.idCandidat_Candidat 
        JOIN ecolefiliere as ecFiliere 
        on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere 
        WHERE nomEcFiliere like '%$_SESSION[filiereAdmin]%' and cf.nomCdFiliere LIKE '%math%'
        order by noteCandidat DESC LIMIT $limitScMath;
        ";
        $resultSelectt = selectAll1($sqlQueryy, $connexion);

        $sqlQueryy1 = "
        select DISTINCT nomCandidat, prenomCandidat, cinCandidat, cneCandidat, nomEcFiliere 
        from candidat as c 
        join candidatfiliere as cf 
        ON idCdFiliere_CandidatFiliere = cf.idCdFiliere
        join choisir as choice 
        ON idCandidat = choice.idCandidat_Candidat 
        JOIN ecolefiliere as ecFiliere 
        on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere
        WHERE nomEcFiliere like '%$_SESSION[filiereAdmin]%' and cf.nomCdFiliere LIKE '%physique%'
        order by noteCandidat DESC LIMIT $limitScPhy;
        ";

        $resultSelectt1 = selectAll1($sqlQueryy1, $connexion);

        $sqlQueryy2 = "
        select DISTINCT nomCandidat, prenomCandidat, cinCandidat, cneCandidat, nomEcFiliere 
        from candidat as c 
        join candidatfiliere as cf 
        ON idCdFiliere_CandidatFiliere = cf.idCdFiliere
        join choisir as choice 
        ON idCandidat = choice.idCandidat_Candidat 
        JOIN ecolefiliere as ecFiliere 
        on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere 
        WHERE nomEcFiliere like '%$_SESSION[filiereAdmin]%' and cf.nomCdFiliere LIKE '%eco%'
        order by noteCandidat DESC LIMIT $limitScEco;
        ";
        $resultSelectt2 = selectAll1($sqlQueryy2, $connexion);

        $sqlQueryy3 = "
        select DISTINCT nomCandidat, prenomCandidat, cinCandidat, cneCandidat, nomEcFiliere 
        from candidat as c 
        join candidatfiliere as cf 
        ON idCdFiliere_CandidatFiliere = cf.idCdFiliere
        join choisir as choice 
        ON idCandidat = choice.idCandidat_Candidat 
        JOIN ecolefiliere as ecFiliere 
        on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere
        WHERE nomEcFiliere like '%$_SESSION[filiereAdmin]%' and cf.nomCdFiliere LIKE '%elec%'
        order by noteCandidat DESC LIMIT $limitElec;
        ";

        $resultSelectt3 = selectAll1($sqlQueryy3, $connexion);

        $sqlQueryy4 = "
        select DISTINCT nomCandidat, prenomCandidat, cinCandidat, cneCandidat, nomEcFiliere 
        from candidat as c 
        join candidatfiliere as cf 
        ON idCdFiliere_CandidatFiliere = cf.idCdFiliere
        join choisir as choice 
        ON idCandidat = choice.idCandidat_Candidat 
        JOIN ecolefiliere as ecFiliere 
        on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere 
        WHERE nomEcFiliere like '%$_SESSION[filiereAdmin]%' and cf.nomCdFiliere LIKE '%svt%'
        order by noteCandidat DESC LIMIT $limitSvt;
        ";
        $resultSelectt4 = selectAll1($sqlQueryy4, $connexion);

        $arrayMerged = array_merge($resultSelectt,$resultSelectt1,$resultSelectt2,$resultSelectt3,$resultSelectt4);
        $_SESSION["arrayMerged"] = $arrayMerged;
        
        // arsort($arrayMerged);
        // print_r($arrayMerged);


    }
    
    $sqlQuery1 = "
        select nomCandidat, prenomCandidat, cinCandidat, cneCandidat, noteCandidat, cf.nomCdFiliere, nomEcFiliere, choice.numChoix 
        from candidat as c 
        join candidatfiliere as cf 
        ON idCdFiliere_CandidatFiliere = cf.idCdFiliere
        join choisir as choice 
        ON idCandidat = choice.idCandidat_Candidat
        JOIN ecolefiliere as ecFiliere 
        on choice.idEcFiliere_EcoleFiliere = ecFiliere.idEcFiliere 
        order by noteCandidat DESC, nomCandidat ASC;
        ";
    $resultSelect1 = selectAll1($sqlQuery1, $connexion);
    



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6d5b5d6689.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <link rel="stylesheet" href="./style.css">
    <!-- <link rel="stylesheet" href="login.css"> -->
    <title>Admin</title>
</head>
<body>
    <div class="container22">
        <?php include_once "aside.php" ?>
        
        <div class="container12">
            <div class="nav1">
                <img src="./Images/est_logo.png" alt="est safi logo" class="logo_est">
                <div class="title_nav">Interface administrateur</div>
                <div class="signup1"><a href="logout.php" class="signupLink">Se déconnecter</a></div>
            </div>
            <div id="message"></div>

<!-- /////////////////// DASHBOARD /////////////////////////////////// -->
            <div class="cards">
                <div class="card1">
                    <div class="upper">
                        <i class="fa-solid fa-font-awesome"></i>
                        <div class="innerTxt"> N° candidat total</div>
                    </div>
                    <div class="lower">
                        <div class="innerNumber"> <?php echo $result3["numTotal"]; ?></div>
                        <i class="fa-solid fa-chart-line chart_icon"></i>
                    </div>
                </div>
                <div class="card1">
                <div class="upper">
                        <i class="fa-solid fa-font-awesome"></i>
                        <div class="innerTxt"> N° candidat pour GI</div>
                    </div>
                    <div class="lower">
                        <div class="innerNumber"> <?php echo $result["numGI"]; ?></div>
                        <i class="fa-solid fa-chart-line chart_icon"></i>
                    </div> 
                </div>
                <div class="card1">
                    <div class="upper">
                        <i class="fa-solid fa-font-awesome"></i>
                        <div class="innerTxt"> N° candidat pour GIM</div>
                    </div>
                    <div class="lower">
                        <div class="innerNumber"> <?php echo $result1["numGIM"]; ?></div>
                        <i class="fa-solid fa-chart-line chart_icon"></i>
                    </div> 
                </div>
                <div class="card1">
                    <div class="upper">
                        <i class="fa-solid fa-font-awesome"></i>
                        <div class="innerTxt"> N° candidat pour TM</div>
                    </div>
                    <div class="lower">
                        <div class="innerNumber"> <?php echo $result2["numTM"]; ?></div>
                        <i class="fa-solid fa-chart-line chart_icon"></i>
                    </div> 
                </div>
            </div>
            <div class="stat">
                <div class="chart1">
                    <canvas id="myChart"></canvas>
                </div>
            </div>


<!-- ////////////////////// LISTE CANDIDATS ////////////////////////////////////////  -->

    <?php
        echo '
        <table class="tableau none">
        <caption class="caption">Liste des candidats</caption>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>CIN</th>
                    <th>CNE</th>
                    <th>Note de bac</th>
                    <th>Filiere de bac</th>
                    <th>Filiere choisie</th>
                    <th>N° de choix</th>
                </tr>
            </thead>
            <tbody>';?>
            <?php
                foreach($resultSelect1 as $key => $value){
                    $i = 1;
                echo '
                    <tr class="row">
                        <td>' ; print_r($value['nomCandidat']); echo '</td>
                        <td>'; print_r($value['prenomCandidat']); echo '</td>
                        <td>'; print_r($value['cinCandidat']); echo '</td>
                        <td>'; print_r($value['cneCandidat']); echo '</td>
                        <td>'; print_r($value['noteCandidat']); echo '</td>
                        <td>'; print_r($value['nomCdFiliere']); echo '</td>
                        <td>'; print_r($value['nomEcFiliere']); echo '</td>
                        <td>'; print_r($value['numChoix']); echo '</td>
                    </tr>';
                } echo ' 
            </tbody>
        </table>' 
    ?>


<!-- /////////////////// LISTE PRINCIPALE /////////////////////////////////// -->

            <div class="login none">
                
                <div class="form-outer formListe">
                
                    <form action="./listPrincipale.php" method="post" id="listePrincipForm">
                    <i class="fas fa-users user12"></i>
                        <div class="input_cont">
                            <label for="filiere">Filiere: </label>
                            <select name="filiere" class="input_choix1">
                                <option value=""></option>
                                <option value="DUT techniques instrumentales & management de la qualité">DUT Techniques instrumentales & management de la qualité</option>
                                <option value="DUT Genie informatique">DUT Genie informatique</option>
                                <option value="DUT génie industriel & maintenance">DUT Génie industriel & maintenance</option>
                                <option value="DUT techniques de management">DUT Techniques de management</option>
                            </select>
                        </div>
                        <!-- <input type="text" name="filiere" id="filiere" required> -->

                        <div class="input_cont">
                            <label for="nbEtudiant">Nombre des etudiants: </label>
                            <input type="text" name="nbEtudiant" id="nbEtudiant" required>
                        </div>

                        <div class="input_cont">
                            <label for="pMath">Pourcentage sc math: </label>
                            <input type="text" name="pMath" id="pMath">
                        </div>

                        <div class="input_cont">
                            <label for="pPhysique">Pourcentage sc physique: </label>
                            <input type="text" name="pPhysique" id="pPhysique">
                        </div>

                        <div class="input_cont">
                            <label for="pEco">Pourcentage sc economique: </label>
                            <input type="text" name="pEco" id="pEco">
                        </div>

                        <div class="input_cont">
                            <label for="pSvt">Pourcentage SVT: </label>
                            <input type="text" name="pSvt" id="pSvt">
                        </div>

                        <div class="input_cont">
                            <label for="pElec">Pourcentage tech électriques: </label>
                            <input type="text" name="pElec" id="pElec">
                        </div>
                        <div class="btn_cont">
                            <button type="submit" name="afficher" class="afficher">Afficher</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
                if(isset($_GET["etat"]) && $_GET["etat"] == 1){
                    echo '<script>window.open("./pdf.php");
                    </script>';
                }else
                    echo ' ';
            ?>
            
            <div class="login1 none">
                <div class="form-outer formListe">
                
                    <form action="./listAtt.php" method="post" id="listeAttForm">
                    <i class="fas fa-users user12"></i>
                        <div class="input_cont">
                            <label for="filiere1">Filiere: </label>
                            <select name="filiere1" class="input_choix1">
                                <option value=""></option>
                                <option value="DUT techniques instrumentales & management de la qualité">DUT Techniques instrumentales & management de la qualité</option>
                                <option value="DUT Genie informatique">DUT Genie informatique</option>
                                <option value="DUT génie industriel & maintenance">DUT Génie industriel & maintenance</option>
                                <option value="DUT techniques de management">DUT Techniques de management</option>
                            </select>
                        </div>

                        <div class="input_cont">
                            <label for="nbEtudiant1">Nombre des etudiants: </label>
                            <input type="text" name="nbEtudiant1" id="nbEtudiant" required>
                        </div>

                        <div class="input_cont">
                            <label for="pMath1">Pourcentage sc math: </label>
                            <input type="text" name="pMath1" id="pMath">
                        </div>

                        <div class="input_cont">
                            <label for="pPhysique1">Pourcentage sc physique: </label>
                            <input type="text" name="pPhysique1" id="pPhysique">
                        </div>

                        <div class="input_cont">
                            <label for="pEco1">Pourcentage sc economique: </label>
                            <input type="text" name="pEco1" id="pEco">
                        </div>

                        <div class="input_cont">
                            <label for="pSvt1">Pourcentage SVT: </label>
                            <input type="text" name="pSvt1" id="pSvt">
                        </div>

                        <div class="input_cont">
                            <label for="pElec1">Pourcentage tech électriques: </label>
                            <input type="text" name="pElec1" id="pElec">
                        </div>
                        <div class="btn_cont">
                            <button type="submit" name="afficher1" class="afficher">Afficher</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
                if(isset($_GET["etat1"]) && $_GET["etat1"] == 1){
                    $arraySliced = array_slice($arrayMerged, -$_SESSION["nbEtudiantAdmin1"], $_SESSION["nbEtudiantAdmin1"]);
                    $_SESSION["arraySliced"] =  $arraySliced;
                    echo '<script>window.open("./listAttPdf.php");
                    </script>';
                }else
                    echo ' ';
        ?>
        </div>
    </div>
    <script>
            let myChart = document.getElementById('myChart').getContext('2d');
            // Global Options
            Chart.defaults.global.defaultFontFamily = 'montserrat';
            Chart.defaults.global.defaultFontSize = 21;
            Chart.defaults.global.defaultFontColor = '#000';
    
            let massPopChart = new Chart(myChart, {
                type:'pie', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data:{
                    labels:['GI', 'GIM', 'TM', 'TIMQ'],
                    datasets:[{
                    label:'Population',
                    data:[
                        <?php echo $result["numGI"]; ?>,
                        <?php echo $result1["numGIM"]; ?>,
                        <?php echo $result2["numTM"]; ?>,
                        <?php echo $result4["numTIMQ"]; ?>
                    ],
                    //backgroundColor:'green',
                    backgroundColor:[
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ],
                    }]
                },
                options:{
                    title:{
                        display: true,
                        text: 'Nombre des candidats pour chaque filiere',
                        position: "top",
                    },
                    legend:{
                        display:true,
                        position:'right',
                        labels:{
                            fontColor:'#000'
                        }
                    },
                    
                    tooltips:{
                    enabled:true
                    }
                }
            });
    </script>
</body>
<script src="./app.js"></script>
</html>