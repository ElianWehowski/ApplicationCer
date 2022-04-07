<?php

//inclusion du modèle
include("modele.php");
$connexion = getConnexion();
$donnees="";

$idobj = $_GET['idobj'];
//charger la liste des employes avec le selectionné
// dans la liste
$requete = "select prix
   from objets
	where id = '".$idobj."'";

$resultats = $connexion->query($requete);
$tab_E = $resultats->fetchALL(PDO::FETCH_ASSOC);
try {
    $resultats = $connexion->query($requete);

} catch (PDOException $e) {
    $message = "probleme pour acceder aux informations de l'objet<br/>";
    $message = $message . $e->getMessage();
}
foreach($tab_E as $tab){
    $donnees = "Prix de l'objet : ".substr($tab['prix'],0,-3) . " €";
}
if($donnees==""){
    $donnees=$requete;
}

// renvoyer le prix
echo $donnees;
?>



