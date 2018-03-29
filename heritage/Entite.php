<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 13/03/2018
 * Time: 14:46
 */

// interface est une sorte de classe entierement abstraite
interface Entite
{
    public function vivre();

    /*
     * une interface ne peut pas avoir de méthodes avec un corps
    public function manger() {
        echo "manger";
    }
    */
}