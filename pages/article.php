<?php
//Fct quand on doit appeler la bdd et récupérer sa réponse
function lire_article($libellePlpgsql, $id, $cnx, $option){
    $req = $cnx->prepare($libellePlpgsql);
    $req->bindParam(1, $id);
    $req->execute();
    if($option==0){
        $res = $req->fetch();
    }
    else{
        $res=$req->fetchAll();
    }
    return $res;
}
//Fct pour générer des balise img et vidéo invisible pour les images et vidéos de l'article
//Ces balises seront ensuite récupérées en JS
function recup_img_vid($article){
    for($x=1;$x<4;$x++)
    {
                if(isset($article['n_img'.$x]))
                {
                    $classe="imgD$x";
                    ?>
                    <img src="<?php echo $article['n_img'.$x];?>" class="img-responsive center-block <?php echo $classe;?>" style="margin-bottom:1%; display:none; width:50%;">
                    <?php
                }
                if(isset($article['n_vid'.$x])){
                    $classe="vidD$x";
                    ?>
                    <div class="embed-responsive embed-responsive-16by9 <?php echo $classe;?>" style="margin-bottom:1%; display:none;">
                        <iframe class="embed-responsive-item " width="480" height="360" src="<?php echo $article['n_vid'.$x];?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <?php
                }
    }
}
//Si l'article est une news
function format_news($article){
    //On génère les img et vidéos
    recup_img_vid($article);
    //On affiche le titre de la new et son texte
                    ?>
            <h3 class="titreArticle text-center"><?php echo $article['n_titre']; ?></h3>
            
            <?php echo $article['n_texte']; 
}
//Si l'article est un film
function format_film($film, $identifiant){
    //On génère les img et vidéos
    recup_img_vid($film);
    //On affiche le bouton pour générer en pdf, le nom du film, son résumé et son texte
    ?>
          <a href="#" id="btn-PDF" data-type="film" data-id="<?php echo $identifiant;?>" class="pull-right btn btn-primary btn-warning"><span class="glyphicon glyphicon-download-alt"></span>Télécharger en PDF</a>
            <h3 class="titreArticle text-center"><?php echo $film['nomfilm']; ?></h3> 
          <?php
          echo $film['resume'];
          echo $film['texte']; 
}
//Si l'article est une série
function format_serie($serie, $tableau, $identifiant){
    //On génère les img et vidéos
    recup_img_vid($serie);
    //On affiche le bouton pdf, le nom de la série et puis on fait une boucle pour les saisons et les épisodes
    ?>
          <a href="#" id="btn-PDF" data-type="serie" data-id="<?php echo $identifiant;?>" class="pull-right btn btn-primary btn-warning"><span class="glyphicon glyphicon-download-alt"></span>Télécharger en PDF</a>
          <h3 class="titreArticle text-center"><?php echo $serie['nomserie']; ?></h3> 
          
          <?php
          
          echo $serie['texte'];
          
          $numeroSaison=$tableau[0]['numerosaison'];
          ?>
          
          <br><a href="#lien1"><h4 id="lien1" class="titreSaison" data-id="saison1">  
          <?php
          echo 'Saison '.$tableau[0]['numerosaison'].' : '.$tableau[0]['nombreepisode'].' episodes';
          ?>
                <i class="pull-right glyphicon glyphicon-chevron-down"></i></h4></a> 
          <br><div id="saison1">
          <?php
          $x=1;
          foreach( $tableau as $row ){
              
              if($numeroSaison!=$row['numerosaison'])
              {
                  $x++;
                  ?>
          </div><br><a href="#lien<?php echo $x;?>"><h4 id="lien<?php echo $x;?>"class="titreSaison" data-id="<?php echo 'saison'.$x;?>">
                  <?php 
                  echo 'Saison '.$row['numerosaison'].' : '.$row['nombreepisode'].' episodes';
                  ?><i class="pull-right glyphicon glyphicon-chevron-down"></i></h4></a><br><div id="<?php echo 'saison'.$x;?>"><?php
                  echo 'Episode '.$row['numeroepisode'].' : '.$row['titreepisode'];
                  $numeroSaison=$row['numerosaison'];
                  ?><br><?php
              }
              else
              {
                  ?>   
                <?php
                  echo 'Episode '.$row['numeroepisode'].' : '.$row['titreepisode'];
                  ?>   <br>
                <?php
              }
              
              
          }
}
?>
<?php
//Si, quand on on fait appel à article.php, l'argumrent get type = news
//Si c'est une news sur laquelle on a cliqué
   if($_GET['type']=='news')
   {
       //On récupère l'article dans la BD puis on l'affiche
        $res=lire_article('SELECT * from lire_article(?)', $_GET['id'], $cnx, 0);
        if($res['n_titre']!="")
        {
            format_news($res);
        }
        else
        {
            echo "Cet article n'existe pas";
        }
   }//Si on a cliqué sur un film, on le récupère dans la bd et on l'affiche
   else if($_GET['type']=='films'){
       $film=lire_article('SELECT * from lire_article_film(?)', $_GET['id'], $cnx, 0);
       format_film($film, $_GET['id']);
   }//Si on a cliqué sur une série, on récupère la série dans la bd ainsi que les épisodes et saisons puis on affiche le tout
   else if(($_GET['type']=='series')){

       $serie=lire_article('SELECT * from lire_article_serie(?)', $_GET['id'], $cnx, 0);
       $tab_saison_episodes=lire_article('SELECT * from lire_saison_episode(?)', $serie['idserie'], $cnx, 1);//
       format_serie($serie, $tab_saison_episodes, $_GET['id']);
       
   }
    
 
 ?>
<script>
    $(document).ready(function () {
        //Pour récupère les balises img et vidéos afin de les mettre dans le texte qui provient de la BD
        var img, vid;       
        for(var i=1;i<4;i++){
            
            img=$(".imgD"+i).prop('outerHTML');
            //alert("boucle img "+img)
            $(".imgD"+i).remove();
            $(".img"+i).html(img);
            $(".imgD"+i).css({"display":"block"});
        }
        
        for(var i=1;i<4;i++){
            vid=$(".vidD"+i).prop('outerHTML');
            $(".vidD"+i).remove();
            $(".video"+i).html(vid);
            $(".vidD"+i).css({"display":"block"});
        }
     //Qd on clique sur un titre de saison pour une série
     $(document).on("click", "h4[data-id*='saison']", function(e){
     //Si l'enfant balise i a le chevron vers le bas (donc si on voyait les épisodes,
     //On met le chevron vers la droite
        if($(this).children("i").attr("class")=="pull-right glyphicon glyphicon-chevron-down"){
            $(this).children("i").attr("class", "pull-right glyphicon glyphicon-chevron-right")
        }//Si l'enfant balise i a le chevron vers la droite (donc les épisodes étaient caché),
     //On met le chevron vers le bas
        else{
            $(this).children("i").attr("class", "pull-right glyphicon glyphicon-chevron-down")
        }
        //On met une animation sur le display none ou display block
        var id=$(this).data("id");
         $("#"+id).toggle(2000);
     });//Quand on clique sur le bouton PDF, on ouvre une nouvelle fenetre qui génèrera le pdf
     $(document).on("click", "#btn-PDF", function(e){
        window.open('http://localhost/marvel-universe/lib/php/pdf.php?id='+$(this).data("id")+"&type="+$(this).data("type"), '_blank');
                   
     });
});
</script>
                