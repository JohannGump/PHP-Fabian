<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 12/03/2018
 * Time: 09:29
 */

/**
 * Class Personne
 * propriétés : private - protected - public
 * méthodes : private - protected - public
 * constructeur
 * getter/setter
 * propriétés et méthodes statiques
 *
 */
class Personne
{
    // propriétés de la classe
    private $nom;
    private $prenom;
    private $telephone;
    private $email;
    private $siteweb;
    private $adresse;

    static public $planete = "Terre";
    static private $planete2 = "Mars";

    // private : propriété ou méthode accessible uniquement au sein de la classe
    // public : propriété ou méthode accessible au sein et en dehors de la classe
    // protected : bientôt :)

    // constructeur, appelé lors de l'instanciation de la classe
    public function __construct($nom, $prenom, $telephone, $email="fab@mail.fr")
    {
        // $this fait référence à l'instance en particulier
        $this->setNom($nom);
        $this->prenom = $prenom;
        //$this->telephone = $telephone;
        $this->setTelephone($telephone);
        $this->email = $email;

        echo "Personne instanciée<br />";

        // self fait référence à la classe elle-même, sans besoin d'instance
        echo "Planete 2 :".Personne::$planete2."<br />";
        echo "Planete 2 :".self::$planete2."<br />";
    }

    public function __clone() {
        $this->adresse = clone $this->adresse;
    }

    /**
     * GETTER ET SETTER / accesseurs et mutateurs
     * permet de centraliser les accès aux propriétés privées
     * en y ajoutant par exemple des vérifications de format
     *
     */
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone)
    {
        if ($telephone == null) {
            $telephone = "0320202020";
        }

        if (strlen($telephone) == 10) {
            $this->telephone = $telephone;
        }

    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSiteweb()
    {
        if (strpos($this->siteweb, "http://") === false) {
            $this->siteweb = "http://".$this->siteweb;
        }

        return $this->siteweb;
    }

    public function setSiteweb($siteweb)
    {
        $this->siteweb = $siteweb;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }


    // méthodes de classe
    public function parler() {
        echo "Je m'appelle ".$this->prenom." ".$this->nom."<br>";
        echo "Je viens de la planète ".self::$planete;
    }

    static public function direBonjour() {

        echo "Bonjour <br>";

        // dans une méthode statique, le mot clé $this ne peut pas être utilisé
        // une méthode statique fait référence à la classe et non à une instance en particulier
        // seules les propriétés statiques de la classe sont utilisables
        echo "Bonjour ".self::$planete;

        // impossible de faire par ex :
        // echo $this->nom;
    }
}

    /*
    function insertIntoBD($nom, $prenom) {
        $sql = "INSERT INTO personne(nom, prenom) VALUES ('".$nom."', '".$prenom."')";

        mysqli_connect('');
        $result = mysqli_query($sql);
    }

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    insertIntoBD($nom, $prenom);
    */
?>