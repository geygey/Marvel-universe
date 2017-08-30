<?php
// démarrage des variables de session
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Marvel Cinematic Universe - Official Website</title>
		<meta charset="utf-8"/>
                <meta http-equiv="content-language" content="fr" />
		<meta name="description" content="Marvel Cinematic Universe" />
		<meta name="Keywords" content="marvel, mcu, comics, comics movie" />
		<meta name="author" content="Gobbe Guillaume" />
		<meta name="copyright" content="©Gobbe Guillaume" />
		<meta name="robots" content="index, follow, all" />
		<meta name="revisit-after" content="1 days" />
		<meta name="classification" content="comics" />
		<meta property="og:title" content="MCU"/>
		<meta property="og:type" content="website"/>
		<meta property="og:url" content="http://www.marvel-universe.com"/>
		<meta property="og:site_name" content="Marvel Cinematic Universe - Official Website"/>
		<link rel="shortcut icon" href="./images/favicon.png">
                <!--Pour fixer le zoom -->
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <!--Utilisations de CDN pour rapidité-->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <link rel="stylesheet" href="./lib/css/style.css"/>
	</head>
	<body>
		<header>
                
                    <?php
			//on inclut les fonctions pour se connecter à la BD et crypter les mdp
			include("./lib/php/fonctions_serveur.php");
                        //Connexion à la base de données
			connexion($cnx);
			//inclusion du menu
			include("./pages/menu.php"); 	
                    ?>
                        
         
		</header>
                <div class="container eltParentHauteur">
                    <div class="row eltParentHauteur">
                        <section class="col-lg-12" id="sectionPrincipal">
                            <article>
                <?php
		//si la page dans le lien du menu a été envoyée
		if(isset($_GET['page']))
                {
                    //Si l'utilisateur vient de cliquer sur "se déconnecter"
                    if(isset($_GET['deconnexion']))
                    {
                        //Si l'utilisateur vient de cliquer sur "se déconnecter"
                        if($_GET['deconnexion']==true)
                        {
                            //Suppression des variables globales session et on redirige sur l'index
                            session_destroy();
                            header('Location: index.php');
                        }
                        
                    }
                    //on affecte à la variable page le chemin d'accès et le nom de la page
                    $page="./pages/".$_GET['page'] ;
                    // si cette page existe bien
                    if(file_exists($page))
                    {
                        //On garde trace de la page
                        $_SESSION['page']=$_GET['page'];
                ?>
            
            
                
                                <?php 
                                //On inclut la page
                                    include $page;
                    }
                    else{
                        ?>
                                <br><p style="font-size:2em;color:gold; font-weight: bold;">Désolé, cette page n'existe pas...</p>
                         <?php
                    }
                }
                else{
                    //Si il n'existe pas de page envoyée dans l'url, on inclut news
                    include("./pages/news.php");
                }
                        ?>
                            </article>
                            
                        </section>
                        <?php
                            //inclusion des boites de dialogues de Bootstrap
                            include("./pages/modals.php"); 	
                        ?>
                    </div>
                </div>
            
            
            <script type="text/javascript" src="./lib/js/responsive.js"></script>
            <script type="text/javascript" src="./lib/js/menu.js"></script>
            <script type="text/javascript" src="./lib/js/traitementDonnees.js"></script>
            <script type="text/javascript" src="./lib/js/article.js"></script>
	</body>
</html>