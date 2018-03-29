<?php
function autoloadClass($classe) {
    require '../classes/'.$classe.".php";
}
spl_autoload_register("autoloadClass");

// passage par valeur
$var = "texte";
$var2 = $var;
$var2 = "text2";

// fonctionne pour les types primitifs : string, int, boolean

var_dump($var);
var_dump($var2);

// passage par référence : par défaut pour les objets
$perso = new Personnage('fabian');
$perso2 = $perso;
$perso2->setNom('sylvain');

// passage par "valeur" : clone
$perso2 = clone $perso;
$perso->setNom('fabian');
//var_dump($perso);
//var_dump($perso2);

// redéfinition du clonage dans la classe personne
$personne = new Personne("nom", "prenom", "0300000000");
$adresse = new Adresse("rue", "cp", "ville");
$personne->setAdresse($adresse);

var_dump($personne);

$personne2 = clone $personne;

echo "<br><br><br>";

var_dump($personne2);