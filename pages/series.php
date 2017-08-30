<!--Pour la pagination-->
<div class="page_navigation text-center"> </div>
<?php 
//Appel à la BDD pour récupérer ttes les séries
$req = $cnx->prepare('SELECT * FROM lire_debut_series()');
    $req->execute();
    $result = $req->fetchAll();
    
    ?>
    
    <ul id="content-articles">
    <?php
    //Boucle pour afficher les articles
    foreach( $result as $row ){
            ?>
        <li class="listeArticles">
            <a href="#" class="lienArticle" data-type="series" data-id="<?php echo $row['fk_id'];?>"><h3 class="titreArticle text-center"><?php echo $row['nomserie'];?></h3></a>
            
            
            <a href="#" class="lienArticle" data-type="series" data-id="<?php echo $row['fk_id'];?>">
                <img src="<?php echo $row['imgarticle'];?>" class="img-responsive center-block" style="width:50%;">
            </a>
        </li>
            <?php
        }

    ?>
    </ul>
<script type="text/javascript" src="./lib/js/pagination.js"></script>