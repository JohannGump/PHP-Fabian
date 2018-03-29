<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 12/03/2018
 * Time: 09:40
 */

// déclaration de la classe
//require 'Personne.php';
//require 'Adresse.php';

// va permettre d'inclure les classes au moment où on en a besoin
function autoloadClass($classe) {
    require "classes/".$classe.".php";
}
spl_autoload_register("autoloadClass");

echo "Bienvenue<br />";

$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$email = $_GET['email'];

// instanciation
// crée une instance de la classe Personne, et la stocke dans la variable $personne
$personne = new Personne($nom, $prenom, "0320", $email);

// Propriété privée, impossible d'y accéder à l'extérieur de la classe
// $personne->nom = "Dupond";

// on passe par le mutateur
$personne->setNom("Dupond");
$personne->setSiteweb("google.fr");

/*
 Pour ne pas faire la vérification à chaque fois dans le code, on va centraliser
cette condition dans un mutateur
*/
/*
$telephone = "065454";
if (strlen($telephone) == 10) {
    $personne->telephone = $telephone;
}
*/

// et on l'appellera de cette façon
//$personne->setTelephone("0654545454");
$adresse = new Adresse();
$adresse->setRue("rue de Paris");
$adresse->setCp("59000");
$adresse->setAdresse("Lille");
$personne->setAdresse($adresse);

// la variable adresse ne sert plus, on peut la détruire, l'instance est
// stocker dans la variable personne via sa propriété $adresse
$adresse = "";

echo "La personne 1 veut s'exprimer : <br/>";
$personne->parler();
$personne->getAdresse()->afficher();

echo "<br>Nom de la personne : ".$personne->getNom();
echo "<br><a href='".$personne->getSiteweb()."'>Site web de la personne.</a>";

// instanciation
/*
$personne2 = new Personne( "dupond");
$personne2->nom = "dupond";
$personne2->prenom = "jean";

$telephone = "0652";
if (strlen($telephone) == 10) {
    $personne2->telephone = $telephone;
}
*/

/*** STATIC ***/

// appel d'un propriété static publique
echo "<br>Planète : ".Personne::$planete."<br>";
Personne::$planete = "Mars";
echo "<br>Planète : ".Personne::$planete."<br>";

Personne::direBonjour()."<br>";

/* ça marche c'est pas l'écriture recommandée, ne fonctionne que en PHP */
//echo $personne::$planete;



var_dump($personne);

