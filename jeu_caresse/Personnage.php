<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 13/03/2018
 * Time: 09:43
 */

class Personnage
{
    private $nom;
    private $douceur;
    private $forceCaresse;

    // constante : utilisable comme les propriétés statiques mais non modifiable
    const COUPFIXE = 50;

    /**
     * Personnage constructor.
     * @param $nom
     */
    public function __construct($nom, $douceur = 0, $forceCaresse=null)
    {
        $this->nom = $nom;
        $this->douceur = $douceur;
        if ($forceCaresse == null) {
            $this->forceCaresse = rand(0, 100);
        }
        else {
            $this->forceCaresse = $forceCaresse;
        }
    }

    // méthode magique permettant à PHP de savoir quoi faire si on veut convertir
    // un objet en chaine de caractères
    // et par exemple faire : echo $personnage;
    // si on tente d'afficher un objet et que cette méthode n'est pas redéfinie :
    // erreur fatale
    public function __toString()
    {
        return "Nom : ".$this->nom;
    }

    // rarement utilisé
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    // redéfinir le comportement lors du clonage d'un objet
    // méthode appelée quand on veut par exemple dupliquer un objet
    // sans le passage par "valeur" qui garde la même adresse en mémoire
    public function __clone()
    {
        // TODO: Implement __destruct() method.
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDouceur()
    {
        return $this->douceur;
    }

    /**
     * @param mixed $douceur
     */
    public function setDouceur($douceur)
    {
        $this->douceur = $douceur;
    }

    /**
     * @return mixed
     */
    public function getForceCaresse()
    {
        return $this->forceCaresse;
    }

    /**
     * @param mixed $forceCaresse
     */
    public function setForceCaresse($forceCaresse)
    {
        $this->forceCaresse = $forceCaresse;
    }

    public function caresser($personnage2) {
        $forceUtilise = rand($this->forceCaresse / 2, $this->forceCaresse);
        $nouvelleDouceur = $personnage2->getDouceur() + $forceUtilise;
        $personnage2->setDouceur($nouvelleDouceur);

        return $forceUtilise;
    }

    public function caresserSurement($personnage2) {
        $forceUtilise = 0.75*$this->forceCaresse;
        $nouvelleDouceur = $personnage2->getDouceur() + $forceUtilise;
        $personnage2->setDouceur($nouvelleDouceur);

        return $forceUtilise;
    }

    public function caresserFixement($personnage2) {
        $forceUtilise = self::COUPFIXE;
        $nouvelleDouceur = $personnage2->getDouceur() + $forceUtilise;
        $personnage2->setDouceur($nouvelleDouceur);

        return $forceUtilise;
    }
}