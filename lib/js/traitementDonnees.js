var loginAuth;
function connexionUser(login, mdp){
    loginAuth=login;
    $.ajax({
		type: 'POST', // On spécifie la méthode
		url: 'http://localhost/marvel-universe/lib/php/traitementDonnees.php',
                cache    : false,
                method: 'post',
                data: { 'fonction': 'authentification', 'login': login, 'mdp': mdp }, 
                
		success: function (response) 
                {
                    //Si la connexion s'est bien passée, on ferme la fenetre et on affiche "se déconnecter gérer le compte"
                   if(response==1){
                        $("#labelAuthWrong").html("");
                        $("#signUpModal").fadeOut('slow', function () { 
                            $("#signUpModal .close").click();
                        });  
                        $(".liNotLogged").addClass("liInvisible");
                        $(".liLogged").removeClass("liInvisible");
                    
                   }
                   else{//Sinon, on lit les logins en ajax
                       lireLogins(1);
                       
                       
                    }
                    
                },
                error: function (xhr, errorType, exception) {
                    
                    console.log("Echec "+xhr+" "+errorType+" "+exception);
                    return false;
                }
		} );
    
}
function modificationCompte(mail, mdp){
    var update=0;
    //Si le mail est pas vide, update =1
    if(mail!="" && mail.length>0){
        update++;
    }//Si le mdp est pas vide, update =2 (ou 3 si le mail est pas vide aussi)
    if(mdp!="" && mdp.length>0){
        update+=2;;
    }
    $.ajax({
		type: 'POST', // On spécifie la méthode
		url: 'http://localhost/marvel-universe/lib/php/traitementDonnees.php',
                cache    : false,
                method: 'post',
                data: { 'fonction': 'modification_compte', 'update' : update, 'mail': mail, 'mdp': mdp }, 
                
		success: function (response) 
                {
                   console.log(response);
                   //Si la modification a réussi, on ferme la fenetre
                   if(response==1){
                        $("#labelModifWrong").html("");
                        $("#modifyModal").fadeOut('slow', function () { 
                            $("#modifyModal .close").click();
                        });
                        
                   }
                   else{
                       $("#labelModifWrong")
                               .html("<li class=\"corrMdp\" style=\"font-weight:bold;color:#ff4d4d;\">Impossible de modifier votre compte. Contactez l'administrateur web du site.</li>");
                    }
                    
                },
                error: function (xhr, errorType, exception) {
                    
                    console.log("Echec "+xhr+" "+errorType+" "+exception);
                    return false;
                }
		} );
}
//Fonction appelée par lireLogins() en success
function erreurAuth(tableau){
    var ok=0;
    var i=0;
    //On parcourt le tableau à la recherche du login de l'user
    while(i<tableau.length && ok==0){
        if(tableau[i]==loginAuth)
            ok=1;
        i++;
    }//Si on a trouvé le login, c'est le mdp qui est incorrect
    if(ok==1){
        $("#labelAuthWrong").html("<li style=\"font-weight:bold;color:#ff4d4d;\">Mot de passe incorrect.</li>");
    }//Sinon c'est le login qui est incorrect (et peut être aussi le mot de passe)
    else{
        $("#labelAuthWrong").html("<li style=\"font-weight:bold;color:#ff4d4d;\">Login incorrect.</li>");
    }
    
}
function lireEmails(){
    $.ajax({
		type: 'POST', // On spécifie la méthode
		url: 'http://localhost/marvel-universe/lib/php/traitementDonnees.php',
                cache    : false,
                method: 'post',
                data: { 'fonction': 'recup_emails' }, 
                
		success: function (response) 
                {
                    //on transforme en tableau la réponse
                    var tableau = response.split("***");
                    tableau = tableau.slice(0, tableau.length);
                    affecterListeEmails(tableau);
                },
                error: function (xhr, errorType, exception) {
                    
                    console.log("Echec "+xhr+" "+errorType+" "+exception);
                },
                //S'éxécute une fois tout fini
                complete : function(resultat, statut){

                }
		} );
}
function lireLogins(option){
    $.ajax({
		type: 'POST', // On spécifie la méthode
		url: 'http://localhost/marvel-universe/lib/php/traitementDonnees.php',
                cache    : false,
                method: 'post',
                data: { 'fonction': 'recup_logins' }, 
                
		success: function (response) 
                {
                    //On transforme en tableau la réponse
                    var tableau = response.split("***");
                    tableau = tableau.slice(0, tableau.length);
                    //Si on lit les logins pour une inscription
                    if(option==0)
                        affecterListeLogins(tableau);
                    //Si on lit les logins pour voir l'erreur dans l'authentification
                    else
                        erreurAuth(tableau);
                },
                error: function (xhr, errorType, exception) {
                    
                    console.log("Echec "+xhr+" "+errorType+" "+exception);
                },
                //S'éxécute une fois tout fini
                complete : function(resultat, statut){

                }
		} );
}

function ajouterUtilisateur(login, mdp, email){
   
    $.ajax({
		type: 'POST', // On spécifie la méthode
		url: 'http://localhost/marvel-universe/lib/php/traitementDonnees.php',
                cache    : false,
                method: 'post',
                data: { 'fonction': 'ajout_compte', 'login': login, 'mdp': mdp, 'email': email }, 
                // 'sujet' est la clé accéssible dans ta variable $_POST, donc dans ton script php ==> $_POST['sujet'] et contiendra la valeur de ta variable 'ton_sujet' javascript
		success: function (response) 
                {
                 
                    //Si l'insert s'est bien déroulé, on ferme la boite et affiche "se déconnecter gérer le copte"
                    if(response==1){
                        $("#subscriptionModal").fadeOut('slow', function () { 
                            $("#subscriptionModal .close").click();
                        });
                        $(".liNotLogged").addClass("liInvisible");
                        $(".liLogged").removeClass("liInvisible");
                    }//si non
                    else{
                        $("#labelMdpWrong").append("<li id=\"probBd\" style=\"font-weight:bold;color:#ff4d4d;\">Erreur. Impossible de vous enregistrer. Veuillez contacter l'administrateur du site web.</li>");
                    }
                },
                error: function (xhr, errorType, exception) {
                    
                    //console.log("Echec "+xhr+" "+errorType+" "+exception);
                },
                //S'éxécute une fois tout fini
                complete : function(resultat, statut){

                }
		} );
    }