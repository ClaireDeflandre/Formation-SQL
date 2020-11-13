<?php
    include 'mesFonctionsSQL.php';
    include 'mesFonctionsTable.php';

    $id = $_GET['id'];
    if ($id == 0){
        $user = getNewUser();
        $action = "CREATE";
        $libelle = "Créer";
    }else{
        $user = readUser($id);
        $action ="UPDATE";
        $libelle = "Mettre à jour";
    }
?>

<html>
<header>
    <link rel="stylesheet" href="style.css">
</header>
<body>

<form action="createUpdate.php" method="get">
    <p>
        <a href="index.php">Liste des utilisateurs</a>

        <input type="hidden" name="id" value="<?php echo $user['id']; ?>"/>
        <input type="hidden" name="action" value="<?php echo $action; ?>"/>
        <div>
            <label for="name">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $user['Nom']; ?>">
        </div>
        <div>
            <label for="prenom">Prenom:</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $user['Prenom']; ?>">
        </div>
        <div>
            <label for="age">Age:</label>
            <input type="text" id="age" name="age" value="<?php echo $user['Age']; ?>">
        </div>
        <div>
            <label for="adresse">Adresse:</label>
            <input type="text" id="adresse" name="adresse" placeholder="<?php echo $user['Adresse']; ?>">
        </div>
            
        <div>
            <button type="submit"><?php echo $libelle; ?></button>
        </div>
    </p>
</form>
<br>
<p>
		<div>
			<button><?php echo '<a href=createUpdate.php?id='.$user['id'].'&action=DELETE>Supprimer</a>'; ?></button>
		</div>
        </p>

</html>

<?php

header("index.php");
?>
