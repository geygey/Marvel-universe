var loginAuth;
$(document).ready(function () {

});
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
                    
                   if(response==1){
                        $("#labelAuthWrong").html("");
                        $("#signUpModal").fadeOut('slow', function () { 
                            $("#signUpModal .close").click();
                        });  
                        $(".liNotLogged").addClass("liInvisible");
                        $(".liLogged").removeClass("liInvisible");
                    
                   }
                   else{
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
    if(mail!="" && mail.length>0){
        update++;
    }
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
function erreurAuth(tableau){
    var ok=0;
    var i=0;
    while(i<tableau.length && ok==0){
        if(tableau[i]==loginAuth)
            ok=1;
        i++;
    }
    if(ok==1){
        $("#labelAuthWrong").html("<li style=\"font-weight:bold;color:#ff4d4d;\">Mot de passe incorrect.</li>");
    }
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
                    
                    var tableau = response.split("***");
                    tableau = tableau.slice(0, tableau.length);
                    if(option==0)
                        affecterListeLogins(tableau);
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
                 
                    //Si l'insert s'est bien déroulé
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