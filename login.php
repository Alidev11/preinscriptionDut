<?php 

    if(date("Y/m/d") <= "2022/12/20"){

    
        echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter | EST SAFI</title>
    <script src="https://kit.fontawesome.com/6d5b5d6689.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login.css">
    
    
</head>
<body>';

        require_once "./functions.php";
        session_start();
        $connexion = dbConnection();
        
        try{
            if(isset($_POST["submit"])){
                $username = $_POST["username"];
                $password = $_POST["password"];
                
                $sqlQuery = "SELECT usernameCandidat, passwordCandidat FROM candidat WHERE usernameCandidat = :username  AND passwordCandidat = :password";
                $resultSelect = selectOne11($sqlQuery, $connexion, $username, $password);

                $sqlQuery = "SELECT usernameAdmin, passwordAdmin FROM administrateur WHERE usernameAdmin = :username  AND passwordAdmin = :password";
                $resultSelect1 = selectOne11($sqlQuery, $connexion, $username, $password);

                if($resultSelect["usernameCandidat"] == $_POST["username"] && 
                $resultSelect["passwordCandidat"] == $_POST["password"]){
                    $_SESSION["usernameCandidat"] = $_POST["username"];
                    $_SESSION["submit"] = $_POST["submit"];
                    header("location: ./index.php");

                }elseif($resultSelect1["usernameAdmin"] == $_POST["username"] && 
                $resultSelect1["passwordAdmin"] == $_POST["password"]){
                    $_SESSION["submit"] = $_POST["submit"];
                    header("location: ./admin.php");
                }
                else{
                    
                    header("location: ./login.php?errors=pass or username");
                    echo "WRONG PASSWORD";
                }
            }
            if(isset($_POST["signupBtn"])){
                $_SESSION["signupBtn"] = $_POST["signupBtn"];
                header("location: ./index.php");
            }
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
    echo '

    <div class="container1">
        <div class="nav">
            <div class="title">Se connecter</div>
            <form method="post" action="./login.php" class="formSignupBtn">
                <button class="signup signupLink" name="signupBtn" type="submit">S\'inscrire </button>
            </form>
            
        </div>
        
        <div class="login">
            <div class="pic"></div>
            <div class="form">
                <form action="login.php" method="POST">
                    <i class="fas fa-users user"></i>
                    <label for="username">Nom d\'utilisateur:</label>
                    <input type="text" name="username" id="username" required>
                    <label for="password">Mot de passe:</label>
                    <input type="password" name="password" id="password" required>
                    <button type="submit" name="submit">Se connecter</button>
                </form>
            </div>
        </div>
        <div class="copyright">&copy; EST SAFI All rights reserved </div>
    </div>
</body>

</html>
';}else
        echo "délai expiré!";
?>