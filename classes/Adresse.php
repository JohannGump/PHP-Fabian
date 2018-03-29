<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 12/03/2018
 * Time: 09:29
 */

/* TODO EXCERCICE
    Créer une classe adresse avec les propriétés suivantes :
    - rue
    - code postal
    - adresse

    Ces propriétés ne doivent pouvoir être accessible depuis l'extérieur de la classe
    Le code postal doit toujours être une chaine de caractère à 5 caractères

    Lors de l'instanciation, il doit être possible de passer directement des valeurs
*/
class Adresse
{
    private $rue;
    private $cp;
    private $adresse;

    /**
     * Adresse constructor.
     */
    public function __construct($param1=null, $param2=null, $param3=null)
    {
        $this->rue = $param1;
        $this->setCp($param2);
        $this->setAdresse($param3);
        $this->setRue($param3, false);
    }


    /**
     * @return mixed
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param mixed $rue
     */
    public function setRue($rue, $toUpper=true)
    {
        if ($toUpper) {
            $rue = strtoupper($rue);
        }

        $this->rue = $rue;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param mixed $cp
     */
    public function setCp($cp)
    {
        if (strlen($cp) == 5) {
            $this->cp = $cp;
        }
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function afficher() {
        return "<br>".$this->getRue()." ".$this->getCp()." ".$this->getAdresse()."<br>";
    }
}

?>