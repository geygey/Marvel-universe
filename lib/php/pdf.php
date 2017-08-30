<?php
function calcul_saut($url){
    list($width, $height, $type, $attr) = getimagesize($url);
        $ratio=$height/$width;
        $y=$ratio*540;
        $taille_saut=15;
        $nbre_saut=ceil($y/$taille_saut);
        $libelle_saut='';
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
        
        $req = $connexionUser->prepare('SELECT * from lire_article_serie(?)');
        $req->bindParam(1, $_GET['id']);
        $req->execute();
        $serie = $req->fetch();


        $req = $connexionUser->prepare('SELECT * from lire_saison_episode(?)');
        $req->bindParam(1, $serie['idserie']);
        $req->execute();
        $tableau=$req->fetchAll();

        $libelle_saut=calcul_saut('http://localhost/marvel-universe'.substr($serie['n_img1'],1));
        
        $image='<img align="center" width="540" src="http://localhost/marvel-universe'.substr($serie['n_img1'],1).'">';     
        $txt=$libelle_saut.$serie['texte'].'<br><br>';

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
        $result=$image.$txt.$saison;
    }
    else if($_GET['type']=="film"){
        $req = $connexionUser->prepare('SELECT * from lire_article_film(?)');
        $req->bindParam(1, $_GET['id']);
        $req->execute();
        $film = $req->fetch();
        
        $libelle_saut=calcul_saut('http://localhost/marvel-universe'.substr($film['n_img1'],1));
        $image='<img align="center" width="540" src="http://localhost/marvel-universe'.substr($film['n_img1'],1).'">';     
       
        $a_remplacer=array("<li>", "</li>", "<ul>", "</ul>");
        $remplacement=array("<br>", "","","");
        $texte=str_replace($a_remplacer, $remplacement, $film['texte']);
        echo $texte;
        $txt=$libelle_saut.$film['resume'].'<br><br>'.$texte;
        $result=$image.$txt;
    }
    $pdf->WriteHTML(utf8_decode($result));
    $pdf->Output();
    exit;
?>