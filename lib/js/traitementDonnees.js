$(document).ready(function () {

});
function connexionUser(login, mdp){
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
                       $("#labelAuthWrong").html("<li style=\"font-weight:bold;color:#ff4d4d;\">login et/ou mot de passe incorrect(s).</li>");
                       return false;
                    }
                    
                },
                error: function (xhr, errorType, exception) {
                    
                    console.log("Echec "+xhr+" "+errorType+" "+exception);
                    return false;
                }
		} );
    
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
function lireLogins(){
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
                    affecterListeLogins(tableau);
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