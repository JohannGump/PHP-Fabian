<?php

function autoloadClass($classe) {
    require $classe.".php";
}
spl_autoload_register("autoloadClass");

$animal = new Animal();
$animal->setNom("Gégé");
// une classe fille possède toutes les propriétés et les méthodes de sa classe

$chat = new Chat();
$chat->setNom("Matou");
// setCouleur vient de Animal, mais Chat peut l'utiliser
//$chat->setCouleur("noir");
// idem pour age
$chat->setAge("5");
// miauler est défini uniquement pour Chat, et pas Animal
$chat->miauler("test");
echo "<br>";

$siamois = new Siamois();
$siamois->setNom("Bernard");
$siamois->miauler("test");

var_dump($animal);
echo "<br><br>";
var_dump($chat);
echo "<br><br>";
var_dump($siamois);

// instanceof
if ($siamois instanceof Siamois) {
    // oui siamois est un siamois
    echo "<br>".$siamois->getNom(). " est un siamois";
}
if ($siamois instanceof Chat) {
    // oui siamois est un chat
    echo "<br>".$siamois->getNom(). " est un chat";
}
if ($siamois instanceof Animal) {
    // oui siamois est un animal
    echo "<br>".$siamois->getNom(). " est un animal";
}

if ($chat instanceof Siamois) {
    // non chat n'est pas un siamois
    // jamais affiché
    echo "<br>".$chat->getNom(). " est un siamois";
}

$siamois->boire();



