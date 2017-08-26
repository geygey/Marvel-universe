<?php

   if($_GET['type']=='news')
   {
        $req = $cnx->prepare('SELECT * from lire_article(?)');
        $req->bindParam(1, $_GET['id']);
     
        $req->execute();
      
        $res = $req->fetch();
         
        if($res['n_titre']!="")
        {
            echo $res['n_titre'];
        }
        else
        {
            echo "Cet article n'existe pas";
        }
   }
    
 
 ?>