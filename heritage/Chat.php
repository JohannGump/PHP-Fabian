<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 13/03/2018
 * Time: 14:46
 */

class Chat extends Animal  implements Entite, Survivre
{
    public function __construct()
    {
        parent::__construct();
        $this->couleur = "blanc";
    }

    public function miauler() {
        // $this->age accessible car chat hérite de animal
        // et c'est une propriété protected
        echo "MIAOU, j'ai ".$this->age." ans";
    }



    public function vivre() {
        echo "Je vis pour boire";
    }

    public function faireDuFeu()
    {
        echo "Je sais pas faire du feu mais il faut";
    }
}