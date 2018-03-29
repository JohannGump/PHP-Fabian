<?php
    class Utilisateur {
        private $nom;
        private $email;
        private $telephone;
        private $enabled;
        private $createdAt;
        private $updatedAt;
        private $typeAccount;
        private $pseudo;

        // quand on utilise des integer en BDD pour représenter un fonctionnement
        // exemple 0 pour compte désactivé
        // et 1 pour compte activé
        // une bonne pratique est de noter ce choix via des constantes
        // qui porte un nom parlant
        // et d'utiliser cette constante partout dans le code
        // plutôt que d'utiliser 0 ou 1 et ne plus se souvenir à quoi ça correspond
        const ACCOUNT_ENABLED = 1;
        const ACCOUNT_DISABLED = 0;

        const TYPE_ACCOUNT_ADMIN = 1;
        const TYPE_ACCOUNT_STANDARD = 0;

        /**
         * Utilisateur constructor.
         * @param $nom
         * @param $email
         * @param $telephone
         * @param $enabled
         * @param $createdAt
         * @param $updatedAt
         * @param $typeAccount
         * @param $pseudo
         */
        public function __construct($nom="", $email="", $telephone="", $enabled="", $typeAccount="", $pseudo="")
        {
            $this->nom = $nom;
            $this->email = $email;
            $this->telephone = $telephone;
            $this->enabled = $enabled;
            $this->createdAt = date('Y-m-d H:i:s');
            $this->typeAccount = $typeAccount;
            $this->pseudo = $pseudo;
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
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @param mixed $email
         */
        public function setEmail($email)
        {
            $this->email = $email;
        }

        /**
         * @return mixed
         */
        public function getTelephone()
        {
            return $this->telephone;
        }

        /**
         * @param mixed $telephone
         */
        public function setTelephone($telephone)
        {
            $this->telephone = $telephone;
        }

        /**
         * @return mixed
         */
        public function getEnabled()
        {
            return $this->enabled;
        }

        /**
         * @param mixed $enabled
         */
        public function setEnabled($enabled)
        {
            $this->enabled = $enabled;
        }

        /**
         * @return mixed
         */
        public function getCreatedAt()
        {
            return $this->createdAt;
        }

        /**
         * @param mixed $createdAt
         */
        public function setCreatedAt($createdAt)
        {
            $this->createdAt = $createdAt;
        }

        /**
         * @return mixed
         */
        public function getUpdatedAt()
        {
            return $this->updatedAt;
        }

        /**
         * @param mixed $updatedAt
         */
        public function setUpdatedAt($updatedAt)
        {
            $this->updatedAt = $updatedAt;
        }

        /**
         * @return mixed
         */
        public function getTypeAccount()
        {
            return $this->typeAccount;
        }

        /**
         * @param mixed $typeAccount
         */
        public function setTypeAccount($typeAccount)
        {
            $this->typeAccount = $typeAccount;
        }

        /**
         * @return mixed
         */
        public function getPseudo()
        {
            return $this->pseudo;
        }

        /**
         * @param mixed $pseudo
         */
        public function setPseudo($pseudo)
        {
            $this->pseudo = $pseudo;
        }

        // récupérer un user en fonction d'un id en paramètre
        public function getUser($id) {
            // CONNEXION BDD PDO
            $dbh = new PDO('mysql:host=localhost;dbname=exercice_crud', "root", "");

            // requete sql pour récupérer tous les users
            $sql = "SELECT * FROM utilisateurs WHERE id = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // récupération des résultats
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            //  vérifier que l'utilisateur existe en base
            if ($result === false) {
                return false;
            }
            else {
                $this->nom = $result['nom'];
                $this->telephone = $result['telephone'];
                $this->email = $result['email'];
                $this->enabled = $result['enabled'];
                $this->createdAt = $result['created_at'];
                $this->updatedAt = $result['updated_at'];
                $this->typeAccount = $result['type_account'];
                $this->pseudo = $result['pseudo'];
            }


            return $result;
        }

        public function create() {
            // CONNEXION BDD PDO
            $dbh = new PDO('mysql:host=localhost;dbname=exercice_crud', "root", "");

            // APPEL DE LA FONCTION DE VERIFICATION
            // ARRETER LA FONCTION
            // SI ERREUR ET RENVOYER LE CODE ERREUR CORRESPONDANT
            $codeValid = $this->isValid();
            if ($codeValid != 0) {
                return $codeValid;
            }

            // CREATION REQUETE SQL
            $sql = "INSERT INTO utilisateurs
                    (nom, email, telephone, enabled, created_at, type_account, pseudo)
                    VALUES (:nom, :email, :telephone, :enabled, :created_at, :type_account, :pseudo)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':telephone', $this->telephone);
            $stmt->bindParam(':enabled', $this->enabled);
            $stmt->bindParam(':created_at', $this->createdAt);
            $stmt->bindParam(':type_account', $this->typeAccount);
            $stmt->bindParam(':pseudo', $this->pseudo);

            // ENVOI DE LA REQUETE

            if (!$stmt->execute()) {
                return -99;
            }

            // RECUPERARER L'ID GENERE
            $id = $dbh->lastInsertId();

            // RENVOIYER 0 POUR OK
            return 0;
        }

        public function update($id) {
            // CONNEXION BDD PDO
            $dbh = new PDO('mysql:host=localhost;dbname=exercice_crud', "root", "");

            // APPEL DE LA FONCTION DE VERIFICATION
            // ARRETER LA FONCTION
            // SI ERREUR ET RENVOYER LE CODE ERREUR CORRESPONDANT
            $codeValid = $this->isValid();
            if ($codeValid != 0) {
                return $codeValid;
            }

            $this->updatedAt = date('Y-m-d H:i:s');

            // CREATION REQUETE SQL
            $sql = "UPDATE utilisateurs 
                    SET nom = :nom, email = :email, telephone = :telephone, enabled = :enabled,
                    updated_at = :updated_at, type_account = :type_account, pseudo = :pseudo
                    WHERE id = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':telephone', $this->telephone);
            $stmt->bindParam(':enabled', $this->enabled);
            $stmt->bindParam(':updated_at', $this->updatedAt);
            $stmt->bindParam(':type_account', $this->typeAccount);
            $stmt->bindParam(':pseudo', $this->pseudo);
            $stmt->bindParam(':id', $id);

            // ENVOI DE LA REQUETE

            if (!$stmt->execute()) {
                return -99;
            }

            // RENVOYER 0 POUR OK
            return 0;
        }

        public function delete($id) {

        }

        static public function getAll() {
            // CONNEXION BDD PDO
            $dbh = new PDO('mysql:host=localhost;dbname=exercice_crud', "root", "");

            // requete sql pour récupérer tous les users
            $sql = "SELECT * FROM utilisateurs ORDER BY created_at DESC";

            // execution de la requete
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            // récupération des résultats
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        public function isValid() {
            return 0;
        }
    }
?>