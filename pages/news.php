<div class="page_navigation text-center"> </div>
<?php 
$req = $cnx->prepare('SELECT * FROM lire_debut_articles()');
    $req->execute();
    $result = $req->fetchAll();
    ?>
    
    <ul id="content-articles">
    <?php
    foreach( $result as $row ){
            ?>
        <li class="listeArticles">
            <a href="#"><h3 class="titreArticle"><?php echo $row['titre'];?></h3></a>
            <?php
            $pos1 = stripos($row['texte'], '<p>');
            $chaine=substr($row['texte'], $pos1);
            ?>
            <a href="#">
            <span class="firstParaphArticle">
            <?php
            echo $chaine.'...'; //img et texte
            ?>
                </p></span></a>
            <a href="#" class="lienArticle" data-id="<?php echo $row['id'];?>">
                <img src="<?php echo $row['img'];?>" class="img-responsive center-block" style="width:50%;">
            </a>
        </li>
            <?php
        }

    ?>
    </ul>
<div class="page_navigation text-center"> </div>
<script type="text/javascript" src="./lib/js/pagination.js"></script>