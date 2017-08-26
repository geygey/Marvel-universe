<?php
function connexion(&$cnx)
{
    try
    {
        $cnx=new PDO('pgsql:host=localhost;port=5432;dbname=marvel-universe;user=postgres;password=mdp');
        
    } catch (Exception $ex) {
        echo "<h1>Echec de la connexion à la base de données</h1> "+ex;
    }
    
}/*
}
function nav()
{
	   if (preg_match_all("#Opera (.*)(\[[a-z]{2}\];)?$#isU", $_SERVER["HTTP_USER_AGENT"], $version))
		{
			$navigateur = 'Opéra ' . $version[1][0];
		}
		elseif (preg_match_all("#MSIE (.*);#isU", $_SERVER["HTTP_USER_AGENT"], $version))
		{
			$navigateur = 'Internet Explorer ' . $version[1][0];
		}
		elseif (preg_match_all("#Firefox(.*)$#isU", $_SERVER["HTTP_USER_AGENT"], $version))
		{
			$version = str_replace('/', '', $version[1][0]);
			$navigateur = 'Firefox ' . $version;
		}
		elseif (preg_match_all("#Chrome(.*) Safari#isU", $_SERVER["HTTP_USER_AGENT"], $version))
		{
			$version = str_replace('/', '', $version[1][0]);
			$navigateur = 'Chrome ' . $version;
		}
		elseif (preg_match_all("#Opera(.*) \(#isU", $_SERVER["HTTP_USER_AGENT"], $version))
		{
			$version = str_replace('/', '', $version[1][0]);
			$navigateur = 'Opéra ' . $version;
		}
		elseif (preg_match("#Nokia#", $_SERVER["HTTP_USER_AGENT"]))
		{
			$navigateur = 'Nokia';
		}
		elseif (preg_match("#Safari#", $_SERVER["HTTP_USER_AGENT"]))
		{
			$navigateur = 'Safari';
		}
		elseif (preg_match("#SeaMonkey#", $_SERVER["HTTP_USER_AGENT"]))
		{
			$navigateur = 'SeaMonkey';
		}
		elseif (preg_match("#PSP#", $_SERVER["HTTP_USER_AGENT"]))
		{
			$navigateur = 'PSP';
		}
		elseif (preg_match("#Netscape#", $_SERVER["HTTP_USER_AGENT"]))
		{
			$navigateur = 'Netscape';
		}
		else
		{
			$navigateur = 'Inconnu';
		}
		if($navigateur=='Chrome ' . $version)
		$_SESSION['form']=0;
		else
		$_SESSION['form']=1;
}
/*Pour récupérer le résultat d'un select*//*
function sendQuery($query,$cnx,&$result, $var1=NULL, $var2=NULL, $var3=NULL, $var4=NULL, $var5=NULL, $var6=NULL, $var7=NULL)
{
		if(!isset($var1))
		{
			$result = pg_query_params($cnx, $query, array());
		}
		if(isset($var1) AND !isset($var2))
		{
			$var1=htmlentities($var1, ENT_QUOTES, "UTF-8");
			$result = pg_query_params($cnx, $query, array($var1));
		}
		if(isset($var1) AND isset($var2) AND !isset($var3))
		{
			$var1=htmlentities($var1, ENT_QUOTES, "UTF-8");
			$var2=htmlentities($var2, ENT_QUOTES, "UTF-8");
			$result = pg_query_params($cnx, $query, array($var1, $var2));
		}
		if(isset($var1) AND isset($var2) AND isset($var3) AND !isset($var4))
		{
			$var1=htmlentities($var1, ENT_QUOTES, "UTF-8");
			$var2=htmlentities($var2, ENT_QUOTES, "UTF-8");
			$var3=htmlentities($var3, ENT_QUOTES, "UTF-8");
			$result = pg_query_params($cnx, $query, array($var1, $var2, $var3));
		}
		if(isset($var1) AND isset($var2) AND isset($var3) AND isset($var4) AND !isset($var5))
		{
			$var1=htmlentities($var1, ENT_QUOTES, "UTF-8");
			$var2=htmlentities($var2, ENT_QUOTES, "UTF-8");
			$var3=htmlentities($var3, ENT_QUOTES, "UTF-8");
			$var4=htmlentities($var4, ENT_QUOTES, "UTF-8");
			$result = pg_query_params($cnx, $query, array($var1, $var2, $var3, $var4));
		}
		if(isset($var1) AND isset($var2) AND isset($var3) AND isset($var4) AND isset($var5) AND !isset($var6))
		{
			$var1=htmlentities($var1, ENT_QUOTES, "UTF-8");
			$var2=htmlentities($var2, ENT_QUOTES, "UTF-8");
			$var3=htmlentities($var3, ENT_QUOTES, "UTF-8");
			$var4=htmlentities($var4, ENT_QUOTES, "UTF-8");
			$var5=htmlentities($var5, ENT_QUOTES, "UTF-8");
			$result = pg_query_params($cnx, $query, array($var1, $var2, $var3, $var4, $var5));
		}
		if(isset($var1) AND isset($var2) AND isset($var3) AND isset($var4) AND isset($var5) AND isset($var6) AND !isset($var7))
		{
			$var1=htmlentities($var1, ENT_QUOTES, "UTF-8");
			$var2=htmlentities($var2, ENT_QUOTES, "UTF-8");
			$var3=htmlentities($var3, ENT_QUOTES, "UTF-8");
			$var4=htmlentities($var4, ENT_QUOTES, "UTF-8");
			$var5=htmlentities($var5, ENT_QUOTES, "UTF-8");
			$var6=htmlentities($var6, ENT_QUOTES, "UTF-8");
			$result = pg_query_params($cnx, $query, array($var1, $var2, $var3, $var4, $var5, $var6));
		}
		if(isset($var1) AND isset($var2) AND isset($var3) AND isset($var4) AND isset($var5) AND isset($var6) AND isset($var7))
		{
			$var1=htmlentities($var1, ENT_QUOTES, "UTF-8");
			$var2=htmlentities($var2, ENT_QUOTES, "UTF-8");
			$var3=htmlentities($var3, ENT_QUOTES, "UTF-8");
			$var4=htmlentities($var4, ENT_QUOTES, "UTF-8");
			$var5=htmlentities($var5, ENT_QUOTES, "UTF-8");
			$var6=htmlentities($var6, ENT_QUOTES, "UTF-8");
			$var7=htmlentities($var7, ENT_QUOTES, "UTF-8");
			$result = pg_query_params($cnx, $query, array($var1, $var2, $var3, $var4, $var5, $var6, $var7));
		}
		if($result)
		{			
			return $result;
			
		}
		else 
		{ 
			return false;
       } 
}
//Fonction pour l'ajout d'image dans les formulaires
function uploadFile_verification()
{
		$erreur=NULL;
		//s'il y a eu erreur lors du transfert
		if($_FILES['image']['error'] > 0) 
		{
			echo "Erreur lors du transfert";
			if( $_FILES['image']['error']!= "UPLOAD_ERR_NO_FILE")
			$erreur= "fichier manquant.";
			elseif( $_FILES['image']['error']!="UPLOAD_ERR_INI_SIZE")
			$erreur= "fichier dépassant la taille maximale autorisée par PHP..";
			elseif( $_FILES['image']['error']!="UPLOAD_ERR_FORM_SIZE")
			$erreur= "fichier dépassant la taille maximale autorisée par le formulaire";
			elseif( $_FILES['image']['error']!="UPLOAD_ERR_PARTIAL")
			$erreur= "fichier transféré partiellement.";
		}
		if($_FILES['image']['size'] > $_POST['maxsize']) $erreur = "Le fichier est trop gros";
		// on utilise cette fonction pour bouger le fichier.
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
		//1. strrchr renvoie l'extension avec le point (« . »).
		//2. substr(chaine,1) ignore le premier caractère de chaine.
		//3. strtolower met l'extension en minuscules.
		$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
		if( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";
		echo $erreur;
		if($erreur==NULL)
		return true;
		else
		return false;
}

function uploadFile_verification_multiple($i)
{
		$erreur=NULL;
		//s'il y a eu erreur lors du transfert
		if($_FILES['image'.$i.'']['error'] > 0) 
		{
			echo "Erreur lors du transfert";
			if( $_FILES['image'.$i.'']['error']!= "UPLOAD_ERR_NO_FILE")
			$erreur= "fichier manquant.";
			elseif( $_FILES['image'.$i.'']['error']!="UPLOAD_ERR_INI_SIZE")
			$erreur= "fichier dépassant la taille maximale autorisée par PHP..";
			elseif( $_FILES['image'.$i.'']['error']!="UPLOAD_ERR_FORM_SIZE")
			$erreur= "fichier dépassant la taille maximale autorisée par le formulaire";
			elseif( $_FILES['image'.$i.'']['error']!="UPLOAD_ERR_PARTIAL")
			$erreur= "fichier transféré partiellement.";
		}
		if($_FILES['image'.$i.'']['size'] > $_POST['maxsize'.$i.'']) $erreur = "Le fichier est trop gros";
		// on utilise cette fonction pour bouger le fichier.
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
		//1. strrchr renvoie l'extension avec le point (« . »).
		//2. substr(chaine,1) ignore le premier caractère de chaine.
		//3. strtolower met l'extension en minuscules.
		$extension_upload = strtolower(  substr(  strrchr($_FILES['image'.$i.'']['name'], '.')  ,1)  );
		if( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";
		echo $erreur;
		if($erreur==NULL)
		return true;
		else
		return false;
}

function uploadFile($flag2, &$nom, $flag, $dossier, $id=NULL)
{
	$path = $_FILES['image']['name'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	if($flag2==1)
	$nom = "./images/".$dossier."/Groupe.{$ext}";
	elseif($flag2==0)
	$nom = "./images/".$dossier."/{$id}.{$ext}";
	else
	$nom = "./images/".$dossier."/Fond01.{$ext}";
	if($flag==1)
	{
		$resultat = move_uploaded_file($_FILES['image']['tmp_name'],$nom);
		return $resultat;
	}
}

function uploadFile_multiple($flag2, &$nom, $flag, $dossier, $i, $id=NULL)
{
	$path = $_FILES['image'.$i.'']['name'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	if($flag2==1)
	$nom = "./images/".$dossier."/Groupe.{$ext}";
	else
	$nom = "./images/".$dossier."/{$id}.{$ext}";
	if($flag==1)
	{
		$resultat = move_uploaded_file($_FILES['image'.$i.'']['tmp_name'],$nom);
		return $resultat;
	}
}

function suppressionFile($dossier, $cherche)
{
	$dossier_traite="images/".$dossier."";// On définit le répertoire dans lequel on souhaite travailler.
	
	$repertoire = opendir($dossier_traite); //on ouvre ce répertoire
	$cherche1=$cherche;// le premier fichier à rechercher avait son chemin en hidden dans le formulaire

	while (false !== ($fichier = readdir($repertoire))) // On lit chaque fichier du répertoire dans la boucle.
	{
		$chemin = './'.$dossier_traite.'/'.$fichier.''; // On définit le chemin du fichier à effacer.
		// Si le fichier est celui qu'on cherche
		if ($chemin == $cherche1)
		{
		   unlink($chemin); // On efface.
		}
	}
	closedir ($repertoire); // On ferme le dossier.
}*/
?>