<?php
session_start();

include_once 'database.php';

if(isset($_POST['formconnection']))
{
    //$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root','');
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = htmlspecialchars ($_POST['mdpconnect']);
    $date = date('Y-m-d H:i:s');
    //$sql="INSERT INTO connexions(login, motdepasse, date) VALUES ('$mailconnect','$mdpconnect','$date')";
    //$bdd ->query($sql);
   

    if(!empty($mailconnect) AND !empty($mdpconnect))
    {
        
        //$requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
        //$requser->execute(array($mailconnect));
        //$userexist = $requser->rowCount();
        //$userinfo = $requser->fetch();
        $userinfo = $database->get("membres","*",[
            'name'=>$mailconnect,]);

        if($userinfo)
        {            
            if (password_verify ($mdpconnect, $userinfo['motdepasse']))
            {
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['mail'] = $userinfo['mail'];
            header("Location: profil.php?id=".$_SESSION['id']);
            }
            else
            {
                $erreur = "Mauvais mail ou mot de passe";
            }
        }
        
    }
    else
    {
        $erreur = "Tous les champs doivent être complétés";
    }
}

?>

<html>
    <head>
        <title>Connection</title>
        <meta charset="utf-8">
    </head>
    <body>
        <div align="center">
            <h2>Connection</h2>
            <br /><br />
            <form method="POST" action="">
                <input type="text" name="mailconnect" placeholder="Mail"/>
                <input type="password" name="mdpconnect" placeholder="Mot de passe"/>
                <input type="submit" name="formconnection" value="Se connecter"/>
            </form>  
            <?php
            if(isset($erreur))
            {
            echo '<font color="red">'.$erreur.'</font>'; 
            }
            ?>

        </div>
    </body>
</html>  

