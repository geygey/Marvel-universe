<?php
// démarrage des variables de session
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Marvel Cinematic Universe - Official Website</title>
		<meta charset="utf-8"/>
		<meta name="description" content="Marvel Cinematic Universe" />
		<meta name="Keywords" content="marvel, mcu, comics, comics movie" />
		
		<meta name="author" content="Gobbe Guillaume" />
		<meta name="copyright" content="©Gobbe Guillaume" />
		<meta name="robots" content="index, follow, all" />
		<meta http-equiv="content-language" content="fr" />
		<meta name="revisit-after" content="1 days" />
		<meta name="classification" content="comics" />
		
		<meta property="og:title" content="MCU"/>
		<meta property="og:type" content="website"/>
		<meta property="og:url" content="http://www.marvel-universe.com"/>
	<!--	<meta property="og:image" content="http://www.marvel-universe.com/images/Style/image3.jpg"/>-->
		<meta property="og:image:type" content="image/jpg"/>
		<meta property="og:site_name" content="Marvel Cinematic Universe - Official Website"/>
		<!--<link rel="image_src" type="image/jpeg" href="http://www.nofatality.com/images/Style/image3.jpg" />-->
		
		<!--<link rel="shortcut icon" href="./images/Style/favicon.ico">-->
                <!--Pour fixer le zoom -->
                <meta name="viewport" content="width=device-width, initial-scale=1">
                
               
               <!-- <link rel="stylesheet" href="./lib/bootstrap/dist/css/bootstrap.css"/>
                
                <script src="./lib/jQuery/jquery-3.2.1.min.js"></script>
                <script src=./lib/bootstrap/dist/js/bootstrap.min.js"></script>
                <script src="bootstrap.min.js"></script>-->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <link rel="stylesheet" href="./lib/css/style.css"/>
	</head>
	<body>
            <!--UTILISER DES CDN PAR LA SUITE-->
            
		<header>
                
                        <div class="container ">
                            <div id="rowMenu" class="row vertical-align">
                                <div class="col-lg-2 ">
                                    <a href="index.php"><img src="./images/logo.jpg" id="logo"/></a>
                                </div>
                                <!--Pas besoin de mettre des col-xs ou col-md car grâce au script responsive.js
                                le positionnement des éléments est calculé via javascript et le rendu donne bien-->
                                <a href="index.php" class="lienMenu col-lg-2 ">News</a>
                                <a href="index.php" class="lienMenu col-lg-2 ">Ligne du temps</a>
                                <a href="index.php" class="lienMenu col-lg-2">Films</a>
                                <a href="index.php" class="lienMenu col-lg-2">Séries</a>
                                <div class="lienMenu col-lg-2">
                                    <ul id="menu-log_in_out"><li><a class="log_in_out">Se connecter</a></li><li><a class="log_in_out" data-toggle="modal" data-target="#subscriptionModal">S'inscrire</a></li></ul>
                                </div>
                            </div>
                        </div>
         
		</header>
                <div class="container">
                    <div class="row">
                        <section class="col-lg-12" id="sectionPrincipal">
                            <article>
                                
                           
                                
                            </article>
                            
                        </section>
                        <!-- Modal -->
                        <div class="modal fade" id="subscriptionModal" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Modal Header</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Some text in the modal.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                         </div>
                    </div>
                </div>
		<footer>
		
		</footer>
            <script type="text/javascript" src="./lib/js/responsive.js"></script>
	</body>
</html>