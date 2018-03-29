<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 13/03/2018
 * Time: 14:46
 */

abstract class EtreVivant
{
    abstract public function seDeplacer();

    // propriété privée intuile car la classe abstraite ne peut être instanciée
    // comme la propriété est privée, seule EtreVivant peut l'utiliser
    // et donc aucune utilité
    private $property;

    public function boire() {
        echo "Je bois";
    }


}