
<?php

if (isset($_POST['pseudo']) && isset($_POST['motdepasse']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mdp = password_hash ($_POST['motdepasse'], PASSWORD_DEFAULT);
    $date = date('Y-m-d H:i:s');

    $base= new PDO('mysql:host=localhost;dbname=formulaire','root',"");
    $sql="INSERT INTO connexions(login, motdepasse, date) VALUES ('$pseudo','$mdp','$date')";
    $base ->query($sql);
    echo $sql;
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
</head>
<body>
        <h1>Connexion</h1>
        <br /><br />
        <form method="POST" action="">
            <table>
                <tr>
                    <td align="right">
                    <label for="pseudo">Pseudo :</label>
                    </td>
                    <td align="right">
                    <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo">
                    </td>
                </tr>   
                <tr>
                    <td align="right">
                    <label for="motdepasse">Mot de passe :</label>
                    </td>
                    <td>
                    <input type="text" placeholder="Votre mot de passe" id="motdepasse" name="motdepasse">
                    </td>
                </tr>              
                    <td></td>
                 
                    <td align="center">
                        <br>
                        <input type="submit" name="inscription" value="Je m'inscris"/>
                    </td>
            </table>
        </form>
   
</body>
</html>