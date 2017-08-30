<div class="container ">
    <div id="rowMenu" class="row vertical-align">
        <div class="col-lg-2 ">
            <a href="index.php"><img src="./images/logo.jpg" id="logo"/></a>
        </div>
        <!--Pas besoin de mettre des col-xs ou col-md car grâce au script responsive.js
        le positionnement des éléments est calculé via javascript et le rendu donne bien-->
        <a href="index.php?page=news.php" class="lienMenu col-lg-2 ">News</a>
        <a href="index.php?page=timeline.php" class="lienMenu col-lg-2 ">Ligne du temps</a>
        <a href="index.php?page=films.php" class="lienMenu col-lg-2">Films</a>
        <a href="index.php?page=series.php" class="lienMenu col-lg-2">Séries</a>
        <div class="lienMenu col-lg-2" id="lienLog">
            <ul id="menu-log_in_out">
                <?php
                //Utilisation d'un flag
                    $flag=0;
                    //Si on est connecté, flag =1 sinon flag =0
                    if(isset($_SESSION['logged'])){
                        if($_SESSION['logged']==true){
                            $flag=1;
                        }
                    }
                    //Si on est pas encore connecté
                    if($flag==0){
                        ?>
                        <li class="liNotLogged">
                            <a href="#" class="log_in_out" id="lienConnexion" data-toggle="modal" data-target="#signUpModal">Se connecter</a>
                        </li>
                        <li class="liNotLogged">
                            <a href="#" class="log_in_out" id="lienInscription" data-toggle="modal" data-target="#subscriptionModal">S'inscrire</a>
                        </li>
                        <li class="liLogged liInvisible">
                            <a href="#" id="lienCompte" data-toggle="modal" data-target="#modifyModal">Gérer le compte</a>
                        </li>
                        <li class="liLogged liInvisible">
                            <a href="index.php?page=news.php&deconnexion=true" id="lienDeconnexion">Se déconnecter</a>
                        </li>
                <?php
                    }//Si on est connecté
                    else{
                        ?>
                        <li class="liNotLogged liInvisible">
                            <a href="#" class="log_in_out" id="lienConnexion" data-toggle="modal" data-target="#signUpModal">Se connecter</a>
                        </li>
                        <li class="liNotLogged liInvisible">
                            <a href="#" class="log_in_out" id="lienInscription" data-toggle="modal" data-target="#subscriptionModal">S'inscrire</a>
                        </li>
                        <li class="liLogged">
                            <a href="#" id="lienCompte" data-toggle="modal" data-target="#modifyModal">Gérer le compte</a>
                        </li>
                        <li class="liLogged">
                                <a href="index.php?page=news.php&deconnexion=true" id="lienDeconnexion">Se déconnecter</a>
                        </li>
                <?php
                    }
                    ?>
                
                
            </ul>
        </div>
    </div>
</div>