<?php
session_start();
    //require_once('php/config.php');
    //require_once('php/function.php');
    // include_once('php/analyticstracking.php');
    // $page = 'recuperation';

    if(isset($_GET['section']))
    {
        $section = htmlspecialchars($_GET['section']);
    }
    else
    {
        $section = "";
    }

    if(isset($_POST['recup_submit'],$_POST['recup_mail'])) 
    {
        if(!empty($_POST['recup_mail']))
        {
            $recup_mail = htmlspecialchars ($_POST['recup_mail']);
            if(filter_var($mail,FILTER_VALIDATE_EMAIL)) 
            {
                $mailexist = $bdd->prepare('SELECT id,pseudo FROM membres WHERE mail = ?');
                $mailexist->execute(array($recup_mail));
                $mailexist_count = $mailexist->rowCount();
                if($mailexist_count == 1)
                {
                    $pseudo = $mailexist->fetch();
                    $pseudo = $pseudo['pseudo'];
                    $_SESSION['recup_mail'] = $recup_mail;
                    $recup_code ="";
                    for($i=0; $i<8; $i++)
                    {
                        $recup_code.= mt_rand(0,9);
                    }
                    $_SESSION['recup_code'] = $recup_code;

                    $mail_recup_exist = $bdd->prepare('SELECT id FROM recuperation WHERE mail = ?');
                    $mail_recup_exist->execute(array($recup_mail));
                    $mail_recup_exist = $mail_recup_exist->rowCount();

                    if($mail_recup_exist==1)
                    {
                        $recup_insert = $bdd->prepare('UPDATE recuperation SET code = ? WHERE mail = ?');
                        $recup_insert->execute(array($recup_code,$recup_mail));
                    }
                    else
                    {
                    $recup_insert = $bdd->prepare('INSERT INTO recuperation(mail,code) VALUES (?,?)');
                    $recup_insert->execute(array($recup_mail,$recup_code));
                    }


                    $message ='
                    <htlm>
                    <head>
                        <title>Récupération de mot de passe</title>
                        <meta charset="utf-8"/>
                    </head>
                    <body>
                        <font color="#303030";>
                            <div align="center">
                                <table width="600px">
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br />
                                            <div align="center">Bonjour<b>'.$pseudo.'</b>,</div><br/>
                                            Voici votre code de récupération:'.$recup_code.'<br/><br/><br/>
                                            A bientôt sur <a href="#">Surbookée</a> ! <br/>
                                            <br/><br/><br/><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <font size="2">
                                                Ceci est un mail automatique, merci de ne pas y répondre
                                            </font>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </font>
                    </body>
                    </html>
                    ';
               



                    mail($recup_mail, "Récupération de mot de passe", $message,$header);
                


                }
                else
                {
                    $error = "Cette adresse mail n'est pas enregistrée";
                }

            }
            else
            {
                $error ="Adresse mail invalide";
            }
        } 
        else
        {
            $error="Veuillez entrer votre adresse mail";
        }
    }

    if(isset($_POST['verif_submit'],$_POST['verif_code']))
    {
        if(!empty($_POST['verif_code']))
        {
            $verif_code = htmlspecialchars($_POST['verif_code']);
            $verif_req = $bdd->prepare('SELECT id FROM recuperation WHERE mail = ? AND code = ?');
            $verif_req->execute(array($_SESSION['recup_mail'],$verif_code));
            $verif_req = $verif_req->rowCount();
            if($verif_req==1)
            {
                $up_req = $bdd->prepare('UPDATE recuperation SET confirme = 1 WHERE mail = ?');
                $up_req->execute(array($_SESSION['recup_mail']));
                header('Location:url href""');
            }
            else
            {
                $error = "Code invalide";
            }
        }
        else
            {
                $error = "Veuillez entrer votre code de confirmation";
            }
    }

    if(isset($_POST['change_submit']))
    {
        if(isset($_POST['change_mdp'], $_POST['change_mdpc']))
        {
            $verif_confirme = $bdd->prepare('SELECT confirme FROM recuperation WHERE mail = ?');
            $verif_confirme->execute(array($_SESSION['recup_mail']));    
            $verif_confirme = $verif_confirme->fetch();
            $verif_confirme = $verif_confirme['confirme'];
            if($verif_confirme == 1){
                $mdp = htmlspecialchars($_POST['change_mdp']);
                $mdpc = htmlspecialchars($_POST['change_mdpc']);
                if(!empty($mdp) AND !empty($mdpc))
                {
                    if($mdp == $mdpc)
                    {
                        $mdp = sha1($mdp);
                        $ins_mdp = $bdd->prepare('UPDATE membres SET motdepasse = ? WHERE mail = ?');
                        $ins_mdp->execute(array($mdp,$_SESSION['recup_mail']));
                        $del_req = $bdd->prepare('DELETE FROM recuperation WHERE mail = ?');
                        $del_req->execute(array($_SESSION['recup_mail']));
                        header('Location: url href""');
                    }
                    else
                        {
                            $error = "Vos mots de passe ne correspondent pas";
                        }
                    }
                }
                else
                    {
                        $error = "Veuillez remplir tous les champs";
                    }
            } 
            else 
            {
                $error = "Veuillez valider votre mot de passe grâce au mail qui vous a été envoyé";
            }
        else
            {
                $error = "Veuillez remplir tous les champs";
            }
        }
    

    require_once('recuperation.view.php');


     ?>