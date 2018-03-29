<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 13/03/2018
 * Time: 14:46
 */

class Animal extends EtreVivant
{
    protected $couleur;
    protected $poids;

    // protected rend une propriété/méthode uniquement accessible
    // dans cette classe, ou dans les classes filles (qui hérite de cette classe)
    protected $age;

    protected $nom;

    public function seDeplacer()
    {
        // obligation d'implementer sedeplacer car animal hérite de la calsse abstraite etrevivant
    }

    public function __construct()
    {
        $this->poids = 50;
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
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * @param mixed $couleur
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    }

    /**
     * @return mixed
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * @param mixed $poids
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }
}