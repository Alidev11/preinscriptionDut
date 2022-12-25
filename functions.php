<?php
//etablit la connexion al la base de donnees

function dbConnection () {
    try {
		$connexion = new PDO('mysql:host=localhost; dbname=php_project_lp','root','');
		$connexion->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connexion->exec("SET NAMES 'utf8'");
	} catch (PDOException $th) {
		echo $th->getMessage();
		exit;
	}
    return $connexion;
}



    function selectOne11($sqlQuery, $connexion, $param1, $param2){
        $requete=$connexion->prepare($sqlQuery);
        $requete->bindValue(':username', $param1);
        $requete->bindValue(':password', $param2);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function selectAll($sqlQuery, $connexion, $username){
        $requete=$connexion->prepare($sqlQuery);
        $requete->bindValue(':username', $username);
        $requete->execute();
        $result = $requete->fetchall(PDO::FETCH_ASSOC);
        return $result;
    }
    function selectAll1($sqlQuery, $connexion){
        $requete=$connexion->prepare($sqlQuery);
        $requete->execute();
        $result = $requete->fetchall(PDO::FETCH_ASSOC);
        return $result;
    }
    function selectOne1($sqlQuery, $connexion){
        $requete=$connexion->prepare($sqlQuery);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function selectOne($sqlQuery, $connexion, $param, $string){
        $requete=$connexion->prepare($sqlQuery);
        $requete->bindValue($string, $param);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function insert($sqlQuery, $connexion){
        $requete=$connexion->prepare($sqlQuery);
        return $requete->execute();
    }
    function update($sqlQuery, $connexion, $param){
        $requete=$connexion->prepare($sqlQuery);
        $requete->bindValue(':idCand', $param);
        return $requete->execute();
    }
    function delete($sqlQuery, $connexion){
        $requete=$connexion->prepare($sqlQuery);
        return $requete->execute();
    }
    
?>