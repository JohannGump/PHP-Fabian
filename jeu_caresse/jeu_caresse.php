<?php
    session_start();

    // va permettre d'inclure les classes au moment où on en a besoin
    function autoloadClass($classe) {
        require $classe.".php";
    }
    spl_autoload_register("autoloadClass");

    // débuter le jeu en récupérant les noms
    if (isset($_POST['nom1'])) {
        unset($_SESSION['nom1'] );
        unset($_SESSION['force1'] );
        unset($_SESSION['douceur1'] );
        unset($_SESSION['nom2'] );
        unset($_SESSION['force2'] );
        unset($_SESSION['douceur2'] );

        // iniatiliser la premiere les joueurs
        $nom1 = isset($_POST['nom1']) ? $_POST['nom1'] : null;
        $nom2 = isset($_POST['nom2']) ? $_POST['nom2'] : null;
        $personnage = new Personnage($nom1);
        $personnage2 = new Personnage($nom2);

        // stocker en session les valeurs générées par le constructeur pour les deux joueurs
        $_SESSION['nom1'] = $personnage->getNom();
        $_SESSION['force1'] = $personnage->getForceCaresse();
        $_SESSION['douceur1'] = $personnage->getDouceur();

        $_SESSION['nom2'] = $personnage2->getNom();
        $_SESSION['force2'] = $personnage2->getForceCaresse();
        $_SESSION['douceur2'] = $personnage2->getDouceur();
    }
    else {
        // le jeu a déjà débuté, on récupère les valeurs du coup précédent
        if (isset($_SESSION['nom1'])) {
            $personnage = new Personnage($_SESSION['nom1'], $_SESSION['douceur1'], $_SESSION['force1']);
            $personnage2 = new Personnage($_SESSION['nom2'], $_SESSION['douceur2'], $_SESSION['force2']);
        }
    }

    function verification($personnage, $personnage2) {
        $_SESSION['nom1'] = $personnage->getNom();
        $_SESSION['force1'] = $personnage->getForceCaresse();
        $_SESSION['douceur1'] = $personnage->getDouceur();

        $_SESSION['nom2'] = $personnage2->getNom();
        $_SESSION['force2'] = $personnage2->getForceCaresse();
        $_SESSION['douceur2'] = $personnage2->getDouceur();
    }

    $forceUtilise = "";
    /* On a cliqué sur un bouton d'action, on appelle les méthodes correspondantes */
    // et on met à jour les valeurs en session, pour pouvoir les récupérer lros du prochain coup
    if (isset($_GET['caresser1'])) {
        $forceUtilise = $personnage->caresser($personnage2);
        verification($personnage, $personnage2);
    }
    if (isset($_GET['caresserSurement1'])) {
        $forceUtilise = $personnage->caresserSurement($personnage2);
        verification($personnage, $personnage2);
    }
    if (isset($_GET['caresser2'])) {
        $forceUtilise = $personnage2->caresser($personnage);
        verification($personnage, $personnage2);
    }
    if (isset($_GET['caresserSurement2'])) {
        $forceUtilise = $personnage2->caresserSurement($personnage);
        verification($personnage, $personnage2);
    }

    // fin du jeu
    if (isset($personnage)) {
        if ($personnage->getDouceur() > 500) {
            echo "Le joueur 2 a gagné";

            // réinitialiation la partie
            session_destroy();
            header("Location: jeu_caresse.php");
            exit;
        }
        if ($personnage2->getDouceur() > 500) {
            echo "Le joueur 1 a gagné";

            // réinitialiation la partie
            session_destroy();
            header("Location: jeu_caresse.php");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Jeu caresse - PHP Objet</title>
    </head>
        <div style="border:1px solid blue;display:block;margin-bottom:20px;">
            <form action="" method="POST">
                <input name="nom1" placeholder="Nom joueur 1"/><br />
                <input name="nom2" placeholder="Nom joueur 2"/><br />
                <input type="submit" name="demarrer" value="Démarrer le jeu"/>
            </form>
        </div>

        <form style="float:left;width:20%;border:1px solid;">
            <label id="nom1"><?php if (isset($personnage)) echo $personnage ?></label><br /><br />
            <input type="submit" name="caresser1" value="Caresser"/><br /><br />
            <input type="submit" name="caresserSurement1" value="Caresser sûrement"/><br /><br />
            <label>Force de caresse : <?php if (isset($personnage)) echo $personnage->getForceCaresse() ?></label><br />
            <label>Douceur : <?php if (isset($personnage)) echo $personnage->getDouceur() ?></label>
        </form>

        <div>
            Force utilisée : <?php echo $forceUtilise; ?>
        </div>

        <form style="float:right;width:20%;border:1px solid;">
            <label id="nom2"><?php if (isset($personnage2)) echo $personnage2 ?></label><br />
            <input type="submit" name="caresser2" value="Caresser"/><br /><br />
            <input type="submit" name="caresserSurement2" value="Caresser sûrement"/><br /><br />
            <label>Force de caresse : <?php if (isset($personnage2)) echo $personnage2->getForceCaresse() ?></label><br />
            <label>Douceur : <?php if (isset($personnage2)) echo $personnage2->getDouceur() ?></label>
        </form>
    </body>
</html>