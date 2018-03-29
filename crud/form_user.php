<?php
    require 'Utilisateur.php';
    // récupération des informations du formulaire
    // différencier si c'est un ajout ou une modification

    if (isset($_POST['form_create'])) {
        $userHidden = $_POST['user_id'];

        // une checkbox non cochée n'est pas présente dans le tableau POST
        $enabled = isset($_POST['user_enabled']) ? Utilisateur::ACCOUNT_ENABLED : Utilisateur::ACCOUNT_DISABLED;

        $utilisateur = new Utilisateur($_POST['user_name'], $_POST['user_email'],
            $_POST['user_phone'], $enabled, $_POST['user_type'], $_POST['user_pseudo']);

        // mode création
        if ($userHidden == "") {
            $creation = $utilisateur->create();
        }
        // mode modification
        else {
            $creation = $utilisateur->update($userHidden);
        }
    }

    // récupération de tous les utilisateurs
    $utilisateurs = Utilisateur::getAll();

    // supprimer un utilisateur

    $userLoaded = null;
    // récupération d'un utilisateur
    if (isset($_GET['user_to_load'])) {
        $idToLoad = $_GET['user_to_load'];
        $utilisateur = new Utilisateur();

        $result = $utilisateur->getUser($idToLoad);

        // si l'utilisateur n'est pas trouvé, afficher un message d'erreur
        if ($result === false) {
            echo "404";
            exit;
        }

        $userLoaded = $idToLoad;
    }
    else {
        $utilisateur = new Utilisateur();
    }

    // afficher les informations récupérées dans le formulaire
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <pre><?php  ?></pre>
        <div class="container">
            <form method="POST">
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" class="form-control" placeholder="Votre nom" name="user_name" value="<?php echo $utilisateur->getNom(); ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Votre email" name="user_email" value="<?php echo $utilisateur->getEmail(); ?>">
                </div>
                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="tel" class="form-control" placeholder="Votre numéro de téléphone" name="user_phone" value="<?php echo $utilisateur->getTelephone(); ?>">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="user_enabled" <?php if ($utilisateur->getEnabled() == Utilisateur::ACCOUNT_ENABLED) echo "checked" ?>>
                    <label class="form-check-label" for="exampleCheck1">Compte activé</label>
                </div>
                <div class="form-group">
                    <label>Type de compte</label>
                    <select name="user_type">
                        <option value="0" <?php if($utilisateur->getTypeAccount() == Utilisateur::TYPE_ACCOUNT_STANDARD) echo "selected";?>>Normal</option>
                        <option value="1" <?php if($utilisateur->getTypeAccount() == Utilisateur::TYPE_ACCOUNT_ADMIN) echo "selected";?>>Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pseudo</label>
                    <input type="text" class="form-control" placeholder="Pseudo de l'admin" name="user_pseudo" value="<?php echo $utilisateur->getPseudo(); ?>">
                </div>

                <input type="hidden" name="user_id" value="<?php echo $userLoaded; ?>"/>
                <input type="submit" class="btn btn-primary" name="form_create" value="Enregistrer"/>
            </form>

            <form method="GET" style="margin-top: 45px;padding-top:15px;border-top:2px solid;">
                <div class="form-group">
                    <label>Charger un utilisateur</label>
                    <select name="user_to_load">
                        <?php
                            foreach ($utilisateurs as $utilisateur) {
                                echo "<option value='".$utilisateur['id']."'>".$utilisateur['nom']." ".$utilisateur['id']."</option>";
                            }
                        ?>
                    </select>
                </div>

                <input type="submit" name="load_user" class="btn btn-primary" value="Charger"/>
                <input type="submit" name="delete_user" class="btn btn-primary" value="Supprimer"/>
            </form>
        </div>

    </body>
</html>