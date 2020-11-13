
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
</head>
<body>

    <h1>Liste des utilisateurs</h1>
    <?php

        include 'mesFonctionsSQL.php';
        include 'mesFonctionsTable.php';
        $rows = getAllUsers();
        afficherTableau($rows, getHeaders());
        
    ?>

    <a href=formulaireUtilisateur.php?id=0>Créer un utilisateur</a>
</body>
</html>