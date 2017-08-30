<div class="page_navigation text-center"> </div>
<?php 
$req = $cnx->prepare('SELECT * FROM lire_debut_films()');
    $req->execute();
    $result = $req->fetchAll();
    
    ?>
    
    <ul id="content-articles">
    <?php
    foreach( $result as $row ){
            ?>
        <li class="listeArticles">
            <a href="#" class="lienArticle" data-type="films" data-id="<?php echo $row['fk_id'];?>"><h3 class="titreArticle text-center"><?php echo $row['nomfilm'];?></h3></a>
            
            
            <a href="#" class="lienArticle" data-type="films" data-id="<?php echo $row['fk_id'];?>">
                <img src="<?php echo $row['imgarticle'];?>" class="img-responsive center-block" style="width:50%;">
            </a>
        </li>
            <?php
        }

    ?>
    </ul>
<div class="page_navigation text-center"> </div>
<script type="text/javascript" src="./lib/js/pagination.js"></script>