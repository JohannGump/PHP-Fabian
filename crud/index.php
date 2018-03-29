
// créer une classe utilisateur qui modèlise les informations suivantes :
- nom
- email (respecte un format email valide)
- telephone (doit commencer par 0 et avoir 10 chiffres)
- compte activé/désactivé
- date de création du compte (doit être un objet de type datetime)
- date de modification du compte (doit être un objet de type datetime)
- type de compte : admin/normal
- si le compte est de type admin, on doit avoir un pseudo en plus
(avec héritage ou pas)

- écrire les méthodes qui vont :
    - aller chercher les informations d'un utilisateur en bdd
    - enregistrer un utilisateur en bdd
    - modifier un utilisateur en bdd
    - supprimer un utilisateur
    - récupérer tous utilisateurs
    - qui vérifie si les données sont valides
    (renvoie 0 su tout est bon, ou -1, -2, -3 si il y a une erreur)

- choisir judicieusement entre méthode statique ou pas
- penser à mettre à jour les date de création / modification

<?php