<?php
session_start();
 include("fonctions_serveur.php");
   connexion($connexionUser);
   $res;
   //Si on veut s'authentifier
   if($_POST['fonction']=='authentification')
 {
       //On crypte le mdp
    $mdp_crypte=encrypt($_POST['mdp']); 
    $req = $connexionUser->prepare('SELECT * from lire_compte(?,?);');
    $req->bindParam(1, $_POST['login']);
    $req->bindParam(2, $mdp_crypte);
    $req->execute();
    $res = $req->fetch();
    //Si on a réussi à trouver concordance, on affecte les $_SESSION
    if($res!=""){
        $_SESSION['login']=$res['n_login'];
        $_SESSION['logged']=true;
        echo 1;
    }
    else{
        echo 0;
        
    }
    
 }//ajouter un compte
 else if($_POST['fonction']=='ajout_compte')
 {
     //On crypte le mdp puis on ajoute l'user
    $mdp_crypte=encrypt($_POST['mdp']);
    $req = $connexionUser->prepare('SELECT ajout_compte(?,?,?)');
    $req->bindParam(1, $_POST['login']);
    $req->bindParam(2, $mdp_crypte);
    $req->bindParam(3, $_POST['email']);
    $req->execute();
    $res=$req->fetch();
    echo $res['ajout_compte'];
    //Si l'ajout a réussi, on affecte les $_SESSION
    if($res['ajout_compte']==1)
    {
        $_SESSION['login']=$_POST['login'];
        $_SESSION['logged']=true;
    }
 }
 else if($_POST['fonction']=='modification_compte')
 {
     //on crypte le mdp et on modifie le compte. Update est une variable qui va adapter l'update dans la bd selon 
     //les champs remplis
    $mdp_crypte=encrypt($_POST['mdp']);
    $req = $connexionUser->prepare('SELECT modifie_compte(?,?,?,?)');
    $req->bindParam(1, $_POST['update']);
    $req->bindParam(2, $_SESSION['login']);
    $req->bindParam(3, $mdp_crypte);
    $req->bindParam(4, $_POST['mail']);
    $req->execute();
    $res=$req->fetch();
    echo $res['modifie_compte'];
 }
  else if($_POST['fonction']=='recup_logins')
 {
    $req = $connexionUser->prepare('SELECT * FROM lire_logins()');
    $req->execute();
    $result = $req->fetchAll();
   
    foreach( $result as $row ){
      echo $row['login'].'***';
    }
    
 }
 else if($_POST['fonction']=='recup_emails')
 {
    $req = $connexionUser->prepare('SELECT * FROM lire_emails()');
    $req->execute();
    $result = $req->fetchAll();
   
    foreach( $result as $row ){
      echo $row['email'].'***';
    }
    
 }
   
?>