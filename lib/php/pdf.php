<?php
function calcul_saut($url){
    //On récupère hauteur, largeur de l'image concernée
    list($width, $height, $type, $attr) = getimagesize($url);
    //On calcule son ratio (hauteur/largeur)
        $ratio=$height/$width;
        //on fait le ratio * 540 (taille de la largeur de l'image codée en dur)
        $y=$ratio*540;
        //On sait qu'un br fait 15 px
        $taille_saut=15;
        //hauteur de l'image générée/nbre de pixels pour un br = nombre de br à faire
        $nbre_saut=ceil($y/$taille_saut);
        $libelle_saut='';//On concatène avec une boucle
        for($i=0;$i<$nbre_saut;$i++)
            $libelle_saut.='<br>';
        return $libelle_saut;
}
require('./fpdf181/html2pdf.php');
include("fonctions_serveur.php");
connexion($connexionUser);
$result;
$pdf=new PDF_HTML();
$pdf->SetFont('Arial','',12);
$pdf->AddPage();
    if($_GET['type']=="serie")
    {
        //On lit dans la table série et article
        $req = $connexionUser->prepare('SELECT * from lire_article_serie(?)');
        $req->bindParam(1, $_GET['id']);
        $req->execute();
        $serie = $req->fetch();

        //On lit dans la table saison et épisode
        $req = $connexionUser->prepare('SELECT * from lire_saison_episode(?)');
        $req->bindParam(1, $serie['idserie']);
        $req->execute();
        $tableau=$req->fetchAll();

        //On appelle calcul_saut pour savoir combien de br mettre pour que le texte se mette après l'image
        $libelle_saut=calcul_saut('http://localhost/marvel-universe'.substr($serie['n_img1'],1));
        //image et texte
        $image='<img align="center" width="540" src="http://localhost/marvel-universe'.substr($serie['n_img1'],1).'">';     
        $txt=$libelle_saut.$serie['texte'].'<br><br>';
//Boucle pour concaténer dans la variable saison ttes les saisons et épisodes
          $numeroSaison=$tableau[0]['numerosaison'];
          $saison='Saison 1 : '.$tableau[0]['nombreepisode'].' episodes<br>';
            $x=1;
              foreach( $tableau as $row )
              {

                if($numeroSaison!=$row['numerosaison'])
                {
                    $x++;
                    $saison.='<br>Saison '.$row['numerosaison'].' : '.$row['nombreepisode'].' episodes<br>';
                    $saison.='Episode '.$row['numeroepisode'].' : '.$row['titreepisode'];
                    $numeroSaison=$row['numerosaison'];
                    $saison.='<br>';
                }
                else
                {
                      $saison.='Episode '.$row['numeroepisode'].' : '.$row['titreepisode'].'<br>';
                }  
              }
              //On met le tout dans result
        $result=$image.$txt.$saison;
    }
    else if($_GET['type']=="film"){
        //On lit dans la table article et film
        $req = $connexionUser->prepare('SELECT * from lire_article_film(?)');
        $req->bindParam(1, $_GET['id']);
        $req->execute();
        $film = $req->fetch();
        //On appelle calcul_saut pour savoir combien de br mettre pour que le texte se mette après l'image
        $libelle_saut=calcul_saut('http://localhost/marvel-universe'.substr($film['n_img1'],1));
        $image='<img align="center" width="540" src="http://localhost/marvel-universe'.substr($film['n_img1'],1).'">';     
       //On remplace les <li> et <ul> par du vide ou des sauts de pages
        $a_remplacer=array("<li>", "</li>", "<ul>", "</ul>");
        $remplacement=array("<br>", "","","");
        $texte=str_replace($a_remplacer, $remplacement, $film['texte']);
       
        $txt=$libelle_saut.$film['resume'].'<br><br>'.$texte;
        $result=$image.$txt;
    }
    //On écrit le résultat avec writeHtml
    $pdf->WriteHTML(utf8_decode($result));
    //On affiche le pdf !
    $pdf->Output();
    exit;
?>