<?php
session_start();
 include("fonctions_serveur.php");
   connexion($connexionUser);
   $res;
   if($_POST['fonction']=='authentification')
 {
    $mdp_crypte=encrypt($_POST['mdp']); 
//print_r($res);
    $req = $connexionUser->prepare('SELECT * from lire_compte(?,?);');
    $req->bindParam(1, $_POST['login']);
    $req->bindParam(2, $mdp_crypte);
    $req->execute();
    $res = $req->fetch();
    //print_r($res);
    if($res!=""){
        
        $_SESSION['mdp']=$res['n_mdp'];
        $_SESSION['logged']=true;
        //echo $_SESSION['mdp'].'---'.$_SESSION['logged'];
        echo 1;
    }
    else{
        echo 0;
    }
    
    //$result = $req->fetchAll();
   /*
    foreach( $result as $row ){
      echo $row['login'].'***';
    }*/
    
 }
 else if($_POST['fonction']=='ajout_compte')
 {
   /*
    $req = $connexionUser->prepare('INSERT INTO compte(login, motdepasse, email) VALUES(?,?,?)');
    $req->bindParam(1, $_POST['login']);
    $req->bindParam(2, $_POST['mdp']);
    $req->bindParam(3, $_POST['email']);
    $req->execute();
    */
   // $req = $connexionUser->prepare('INSERT INTO compte(login, motdepasse, email) VALUES(?,?,?)');
    $mdp_crypte=encrypt($_POST['mdp']);
    $req = $connexionUser->prepare('SELECT ajout_compte(?,?,?)');
    $req->bindParam(1, $_POST['login']);
    $req->bindParam(2, $mdp_crypte);
    $req->bindParam(3, $_POST['email']);
    $req->execute();
    $res=$req->fetch();
    echo $res['ajout_compte'];
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
   

 else if($_POST['fonction']=="load_comments"){
     //SELECT * FROM lire_commentaires(1);
   echo $_POST['id'];
    $req = $connexionUser->prepare('SELECT * FROM lire_commentaires(?)');
    $req->bindParam(1, $_POST['id']);
    $result = $req->fetchAll();
   print_r($result);
   
    foreach( $result as $row ){
      echo $row['textecommentaire'];
    }
 }
   
?>