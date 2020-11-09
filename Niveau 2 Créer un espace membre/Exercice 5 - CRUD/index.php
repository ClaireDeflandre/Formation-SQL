<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coucou</title>
</head>
<body>
    
    <?php
        include 'mesfonctionsphp.php';
        include 'mesfonctionsTab.php';
        $rows = getAllUsers();
        afficherTab($rows, getHeaderTab());
    ?>

    <a href="formulaireUtilisateur.php?id=0">Créer un utilisateur</a>
</body>
</html>