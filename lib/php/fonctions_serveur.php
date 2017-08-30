<?php
function connexion(&$cnx)
{
    try
    {
        $cnx=new PDO('pgsql:host=localhost;port=5432;dbname=marvel-universe;user=postgres;password=mdp');
        
    } catch (Exception $ex) {
        echo "<h1>Echec de la connexion à la base de données</h1> "+ex;
    }
    
}
function encrypt($str) {
    
    return md5($str);
    
}

?>