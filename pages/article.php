<?php
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
    //print_r($res);
    return $res;
}
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
function format_news($article){
    recup_img_vid($article);
                    ?>
            <h3 class="titreArticle text-center"><?php echo $article['n_titre']; ?></h3>
            
            <?php echo $article['n_texte']; 
}
function format_film($film, $identifiant){
    recup_img_vid($film);
    ?>
          <a href="#" id="btn-PDF" data-type="film" data-id="<?php echo $identifiant;?>" class="pull-right btn btn-primary btn-warning"><span class="glyphicon glyphicon-download-alt"></span>Télécharger en PDF</a>
            <h3 class="titreArticle text-center"><?php echo $film['nomfilm']; ?></h3> 
          <?php
          echo $film['resume'];
          echo $film['texte']; 
}
function format_serie($serie, $tableau, $identifiant){
    recup_img_vid($serie);
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
function construireCommentaires($idArticle){
    if(isset($_SESSION['logged'])){
        if($_SESSION['logged']){
            echo '<label data-id="'.$idArticle.'" id="connected" style="display:none;">oui</label>';
        }
        else{
            echo '<label id="connected" style="display:none;">non</label>';
        }
    }
    else{
        echo '<label id="connected" style="display:none;">non</label>';
    }
}
?>
<?php
   if($_GET['type']=='news')
   {
        $res=lire_article('SELECT * from lire_article(?)', $_GET['id'], $cnx, 0);
        if($res['n_titre']!="")
        {
            format_news($res);
            construireCommentaires($_GET['id']);
        }
        else
        {
            echo "Cet article n'existe pas";
        }
   }
   else if($_GET['type']=='films'){
       $film=lire_article('SELECT * from lire_article_film(?)', $_GET['id'], $cnx, 0);
       format_film($film, $_GET['id']);
       construireCommentaires($_GET['id']);
   }
   else if(($_GET['type']=='series')){

       $serie=lire_article('SELECT * from lire_article_serie(?)', $_GET['id'], $cnx, 0);
       $tab_saison_episodes=lire_article('SELECT * from lire_saison_episode(?)', $serie['idserie'], $cnx, 1);//
       format_serie($serie, $tab_saison_episodes, $_GET['id']);
       construireCommentaires($_GET['id']);
       
   }
    
 
 ?>
<script>
    $(document).ready(function () {
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
     if($("#connected").html()=="oui"){
            //alert(parseInt($("#connected").data("id")))
            var tid=(parseInt($("#connected").data("id")));
           
            $.ajax({
		type: 'POST', // On spécifie la méthode
		url: 'http://localhost/marvel-universe/lib/php/traitementDonnees.php',
                cache    : false,
                method: 'post',
                data: { 'fonction': 'load_comments', 'id': tid}, 
                
		success: function (response) 
                {
                    console.log(response);
                    $(response).insertAfter("#connected");
                },
                error: function (xhr, errorType, exception) {
                    
                    console.log("Echec "+xhr+" "+errorType+" "+exception);
                    return false;
                }
		} );
     }
     $(document).on("click", "h4[data-id*='saison']", function(e){
     
        if($(this).children("i").attr("class")=="pull-right glyphicon glyphicon-chevron-down"){
            $(this).children("i").attr("class", "pull-right glyphicon glyphicon-chevron-right")
        }
        else{
            $(this).children("i").attr("class", "pull-right glyphicon glyphicon-chevron-down")
        }
        var id=$(this).data("id");
         $("#"+id).toggle(2000);
     });
     $(document).on("click", "#btn-PDF", function(e){
        window.open('http://localhost/marvel-universe/lib/php/pdf.php?id='+$(this).data("id")+"&type="+$(this).data("type"), '_blank');
                   
     });
});
</script>
                