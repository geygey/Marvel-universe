/*Script pour tout ce qui touche au menu ou aux modals de Bootstrap (donc authentification, inscription, modification du compte*/
var tableau_logins, tableau_emails;
$(document).ready(function () {
    //Remise à zéro des apparences basiques de la bte de dialogue qd on l'ouvre ou la rouvre
    $(document).on("click", "#lienInscription", function(e){
        effacerFormulaire(".form-group"); 
    });
    //Remise à zéro des apparences basiques de la bte de dialogue qd on l'ouvre ou la rouvre
    $(document).on("click", "#lienConnexion", function(e){
        effacerFormulaire(".form-group"); 
    });
    //Remise à zéro des apparences basiques de la bte de dialogue qd on l'ouvre ou la rouvre
    $(document).on("click", "#lienCompte", function(e){
        effacerFormulaire(".form-group"); 
    });
    //Qd on clique sur l'icone de l'oeil fermé (pour les mdp)
    $(document).on("click", ".glyphicon-eye-close", function(e){
       //On met l'icone de l'oeil ouvert, on retire l'ancien et on met la couleur en bleue
        $(this).addClass("glyphicon-eye-open");
        $(this).removeClass("glyphicon-eye-close");
        $(this).css({"color":"blue"});
        //On met le password en clair aussi
        $("#"+$(this).data("id")).attr("type","text");
        
    });
    //Qd on clique sur l'icone de l'oeil ouvert (pour les mdp)
    $(document).on("click", ".glyphicon-eye-open", function(e){
        //On met l'icone de l'oeil fermé, on retire l'ancien et on met la couleur en transparent
        $(this).addClass("glyphicon-eye-close");
        $(this).removeClass("glyphicon-eye-open");
        $(this).css({"color":"#555"});
        //On remet le password en caché
        $("#"+$(this).data("id")).attr("type","password");
        
    });
    //Qd on a le focus du mail dans l'inscription, on fait un appel ajax qui va lire tous les mails de la BD afin de vérifier que
    //l'user en rentre un nouveau
    $(document).on("focusin", "#mailForm", function(e){
        lireEmails();
   });
    //Qd on perds le focus du mail dans l'inscription, on vérifie le mail (chaine vide, regex, mail déjà utilisé)
    $(document).on("focusout", "#mailForm", function(e){
        //Le dernier argument est pour dire qu'on accepte pas une chaine vide
        verificationMail("#mailForm", "#libelleMail", "#iconMail", 0);
   });
   //Qd on a le focus du mail dans la modification du compte,
   //on fait un appel ajax qui va lire tous les mails de la BD afin de vérifier que
    //l'user en rentre un nouveau
    $(document).on("focusin", "#newMail", function(e){
        lireEmails();
   });
   //Qd on perds le focus du mail dans la modification du compte, on vérifie le mail (chaine vide, regex, mail déjà utilisé)
   $(document).on("focusout", "#newMail", function(e){
       //Le dernier argument est pour dire qu'on accepte une chaine vide
      verificationMail("#newMail", "#libelleNewMail", "#iconNewMail", 1);
   });
   //Qd on a le focus du login dans l'inscription, appel ajax pour récupérer les logins dans la BD
   //et pour comparer à celui que l'user rentre
    $(document).on("focusin", "#loginForm", function(e){
        lireLogins(0);
        
   });
   //Qd on perds le focus du login, on vérifie le login (chaine vide)
    $(document).on("focusout", "#loginForm", function(e){
       verificationLogin();
       
   });
   //Qd on perds le focus du mdp1 (inscription)
    $(document).on("focusout", "#mdpForm", function(e){
        //Si, qd on quitte le champs du mot de passe, on a confirmé déjà le mdp, alors on vérifie
        if($("#mdpValidationForm").val().length>0 && $("#mdpValidationForm").val()!=="")
            verificationMdps("#labelMdpWrong", "#mdpForm", "#mdpValidationForm", "#iconMdp1", "#iconMdp2", "#libelleMdp1", "#libelleMdp2", false);
   });
   
   //Qd on perds le focus du mdp2 (inscription)
    $(document).on("focusout", "#mdpValidationForm", function(e){
       //on vérifie les mdps
        verificationMdps("#labelMdpWrong", "#mdpForm", "#mdpValidationForm", "#iconMdp1", "#iconMdp2", "#libelleMdp1", "#libelleMdp2", false);
   });
   //Qd on perds le focus du mdp2 (inscription)
    $(document).on("keydown", "#mdpValidationForm", function(e){
        if(e.which == 13){
          verificationTotaleInscription();
       }
   });
   //Qd on perds le focus du mdp1 (modification)
    $(document).on("focusout", "#newMdp", function(e){
        //Si, qd on quitte le champs du mot de passe, on a confirmé déjà le mdp, alors on vérifie
       if($("#renewMdp").val().length>0 && $("#renewMdp").val()!=="")
        verificationMdps("#labelModifWrong", "#newMdp", "#renewMdp", "#iconNewMdp1", "#iconNewMdp2", "#libelleNewMdp1", "#libelleNewMdp2", true);
   });
   //Qd on perds le focus du mdp2 (modification)
    $(document).on("focusout", "#renewMdp", function(e){
       verificationMdps("#labelModifWrong", "#newMdp", "#renewMdp", "#iconNewMdp1", "#iconNewMdp2", "#libelleNewMdp1", "#libelleNewMdp2", true);
   });
    //Fct qui vérifie le formulaire d'inscription avant un quelconque envoi à la BD
   $(document).on("click", "#register_create", function (e) {
        verificationTotaleInscription();
   });
   //Qd on authentifie l'user
   $(document).on("click", "#authentifier", function (e) {
       connexionUser($("#loginAuth").val(), $("#mdpAuth").val()); 
   });//Qd on authentifie l'user
   $(document).on("keydown", "#mdpAuth", function (e) {
       if(e.which == 13){
          connexionUser($("#loginAuth").val(), $("#mdpAuth").val()); 
       }
   });//Qd on modifie son compte
   $(document).on("keydown", "#renewMdp", function (e) {
       if(e.which == 13){
            verificationTotaleModification();
        }
   });//Qd on modifie son compte
    $(document).on("click", "#modifierCompte", function (e) {
       verificationTotaleModification();
   });
    
});
function verificationTotaleInscription(){
    //Verification du mail
        verificationMail("#mailForm", "#libelleMail", "#iconMail", 0);
        //Verification du login
        verificationLogin();
        verificationMdps("#labelMdpWrong", "#mdpForm", "#mdpValidationForm", "#iconMdp1", "#iconMdp2", "#libelleMdp1", "#libelleMdp2");
       //S'il n'y a pas d'erreur dans le formulaire
        if($('.glyphicon-remove').length===0){
           //appel ajax
               ajouterUtilisateur($("#loginForm").val(), $("#mdpForm").val(),$("#mailForm").val());
               
            
        }
}
function verificationTotaleModification(){
    $("#labelModifWrong").html("");
    //Si aucun champ n'est rempli, on ferme simplement la boite 
        if($("#newMail").val()=="" && $("#newMdp").val()=="" && $("#renewMdp").val()=="")
        {
            $("#modifyModal").fadeOut('slow', function () { 
                $("#modifyModal .close").click();
            }); 
        }
        else{//Sinon, on vérifie les mot des passes et les mails
            ////Tout en acceptant que les inputs soient vides
            //alert("y a un truc rempli au moins")
                verificationMdps("#labelModifWrong", "#newMdp", "#renewMdp", "#iconNewMdp1", "#iconNewMdp2", "#libelleNewMdp1", "#libelleNewMdp2", true);
                verificationMail("#newMail", "#libelleNewMail", "#iconNewMail", 1);
                if($('.glyphicon-remove').length===0){
                    //Appel ajax
                    modificationCompte($("#newMail").val(), $("#newMdp").val());
                }
                
            
           
        }
}
//Fonction appelée qd on ouvre une modal
//Efface toutes les couleurs et icones, valuers input etc
function effacerFormulaire (classe) {

  $(classe+" input").each(function (e){
      switch($(this).attr("type")){
          case "button":
                  break;
          case "submit":
              break;
          case "reset":
              break;
          case "hidden":
              break;
          default:
              $(this).val("").css({"background-color":"transparent"}).removeAttr('checked').removeAttr('selected');
      }
  });
    
   $(".glyphicon-ok").each(function (e) 
   {
        $(this).removeClass("glyphicon-ok");
   });
   $(".glyphicon-remove").each(function (e) 
   {
        $(this).removeClass("glyphicon-remove");
   });
   $(".libelleError").each(function (e){
       $(this).html("");
   });
   $("#labelMdpWrong").html("");$("#labelAuthWrong").html("");$("#labelModifWrong").html("");
     
}
//vérifie l'email
function verificationMail(input, libelle, icon, verificationVide){
    var vide=false;
    //Si on accepte pas une chaine vide
    if(verificationVide==0){
        //On vérifie si le mail est vide
        vide=verificationInputVide(input,"L'adresse email",libelle)
        //S'il n'est pas vide, on fait la regex
        if(vide)
        {
            regexEmail(icon, input, libelle);
        }//Si le mail est vide, on change l'apparence de l'input, ajoute une icone, etc.
        else{
            changementApparenceInput(false, icon, input, libelle, "L'adresse email est vide");
        }
    
    }
    else{//Si on accepte qu'il soit vide, on vérifie qu'il est quand même rempli avant de faire la regex
        if($(input).val()!="" && $(input).val().length>0)
            regexEmail(icon, input, libelle);
    }
}
function regexEmail(icon, input, libelle){
    //alert($(input).val());
            var regexEmail =/^[A-Za-z0-9._-]+@[A-Za-z0-9._-]+\.[A-Za-z]{2,6}$/;
           //On teste l'email
            var ok=regexEmail.test($(input).val());
            //On envoie le résultat du regex et ça changera l'apparence ou pas de l'input
            changementApparenceInput(ok, icon, input, libelle, "L'adresse email ne respecte pas le format standard");
            if(ok){
                        //Si la regex est ok, on vérifie que le mail est nouveau dans la BD
                        var nouveau=verificationNouveauEmail($(input).val());
                        if(nouveau===0){
                            changementApparenceInput(true, icon, input, libelle, "");
                        }
                        else{//Mail déjà utilisé
                            changementApparenceInput(false, icon, input, libelle, "Cette adresse email existe déjà dans notre base de données.");
                        }


            }
}
//Fonction appelé par ajax success
function affecterListeEmails(tab){
    tableau_emails=tab;
}
function verificationNouveauEmail(nouveauEmail){
    var stop=0;
    
    for(var i=0;i<tableau_emails.length;i++){
        if(tableau_emails[i]===nouveauEmail.toUpperCase())
            stop=1;
    }
    return stop;
}
function verificationLogin(){
           //Si le login n'est pas vide, on change l'apparence
       if(verificationInputVide("#loginForm","Le login","#libelleLogin")){
           //On s'assure que le login ne contient pas 3 ***
           var etoile=verificationMdp("*", $("#loginForm").val(), 3);
                if(etoile==3){
                    changementApparenceInput(false, "#iconLogin", "#loginForm", "#libelleLogin", "Le login ne peut contenir trois * à la suite");
                }
                else{//On vérifie que c'est un nouveau login
                    var nouveau=verificationNouveauLogin($("#loginForm").val());
                    if(nouveau===0){
                        changementApparenceInput(true, "#iconLogin", "#loginForm", "#libelleLogin", "");
                    }
                    else{
                        changementApparenceInput(false, "#iconLogin", "#loginForm", "#libelleLogin", "Ce login est déjà pris");
                    }
                    
                }
            
       }
       else{//Sinon, on change aussi l'apparence
           changementApparenceInput(false, "#iconLogin", "#loginForm", "#libelleLogin1", "Le login");
       }
}
//Fonction appelé par ajax success
function affecterListeLogins(tab){
    tableau_logins=tab;
}
function verificationNouveauLogin(nouveauLogin){
    var stop=0;
    for(var i=0;i<tableau_logins.length;i++){
        //console.log(tableau_logins[i]+"==="+nouveauLogin)
        if(tableau_logins[i]===nouveauLogin)
            stop=1;
    }
    return stop;
}

function verificationMdps(label, inputMdp1, inputMdp2, iconMdp1, iconMdp2, libelleMdp1, libelleMdp2, verificationVide){
    $(label).html("");
    //Si les mdp concordent pas
        if($(inputMdp1).val()!==$(inputMdp2).val()){
            //console.log("concord epas");
           $(label).append("<li class=\"corrMdp\" style=\"font-weight:bold;color:#ff4d4d;\">Les mots de passe ne correspondent pas </li>");
           
           changementApparenceInput(false, iconMdp1, inputMdp1, libelleMdp1, "");
           changementApparenceInput(false, iconMdp2, inputMdp2, libelleMdp2, "");
        }
        else{//Les mdps concordent
            //console.log("else")
            var flagCasseMdp=0;
           $(".corrMdp").remove();
           $(".corrMdpCarr").remove();
           $(".corrMdpNbCarr").remove();
           //on vérifie que le mdp n'est pas vide
           var verification=verificationInputVide(inputMdp1, "", libelleMdp1)
           //Si on accepte qu'il soit vide, on met la valeur à true
           if(verificationVide)
            verification=verificationVide;
           //Si le mdp n'est pas vide ou qu'on accepte qu'il le doit
           if(verification){//Si on accepte pas qu'il soit vide, on vérifie qu'il possède les caractères demandés
               if(!verificationVide){
                    //Maintenant on vérifie le contenu du mdp
                   var trouve=verificationMdp("ABCDEFGHIJKLMNOPQRSTUVWXYZ", $(inputMdp1).val(), 1);
                    if(trouve==0 && flagCasseMdp==0)
                    {
                        flagCasseMdp++;
                    }
                    trouve=verificationMdp("abcdefghijklmnopqrstuvwxyz", $(inputMdp1).val(), 1);
                    if(trouve==0 && flagCasseMdp==0){
                        flagCasseMdp++;
                    }
                    trouve=verificationMdp("1234567890", $(inputMdp1).val(), 1);
                    if(trouve==0 && flagCasseMdp==0){
                        flagCasseMdp++;
                    }

                    //S'il manque un ou plusieurs caractères dans le mdp
                    if(flagCasseMdp>0){
                        $(label).append("<li class=\"corrMdpCarr\" style=\"font-weight:bold;color:#ff4d4d;\">Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre</li>");

                    }
                    //Si le mdp contient les caractères adéquats
                    if(flagCasseMdp==0){
                        //S'il na pas assez de caractères
                        if($(inputMdp1).val().length<6){
                           $(label).append("<li class=\"corrMdpNbCarr\" style=\"color:#ff4d4d;\">Le mot de passe doit être long de 6 caractères minimum</li>");


                        }
                        else{
                            changementApparenceInput(true, iconMdp1, inputMdp1, libelleMdp1, "");
                            changementApparenceInput(true, iconMdp2, inputMdp2, libelleMdp2, "");
                        }
                    }
                }
           }//Si le mdp est vide
           else{
                changementApparenceInput(false, iconMdp1, inputMdp1, libelleMdp1, "Le mot de passe est vide");
                changementApparenceInput(false, iconMdp2, inputMdp2, libelleMdp2, "Le mot de passe est vide");
           }
           
        }
}
function verificationMdp(caracteres,mdp, nbre_a_trouver){
    var i=0, ok=0;
    while(i<caracteres.length && ok==0){
        
        var mdp2 = mdp.split(caracteres[i]);
        var nbre_de_fois_trouve = mdp2.length-1;
        if(nbre_de_fois_trouve>=nbre_a_trouver){
            ok=1;
        }
        i++;
    }    
    return nbre_de_fois_trouve;

}
//verificationInputVide("#loginForm","Le login","#libelleLogin");
function verificationInputVide(chaine, message, idLibelle){
    var valeurChaine=$.trim($(chaine).val());
    //console.log(chaine+" valeur input="+$(chaine).val());
    
    if($(chaine).length>0 && valeurChaine!=""){
            
             $(idLibelle).html("");
             $(chaine).val(valeurChaine);
             return true;
        }
    if($(chaine).length==0 || valeurChaine==""){
            
            $(idLibelle).html(message+" est vide");
            return false;
        }
        
}
function changementApparenceInput(correct, icon, input, libelleInput, message){
    //console.log("test")
    //console.log("if "+correct);
    if(!correct)
    {
        //console.log("if "+$(icon).hasClass("glyphicon-ok"))
        if($(icon).hasClass("glyphicon-ok"))
            $(icon).removeClass("glyphicon-ok");
        //console.log("if "+$(icon).hasClass("glyphicon-remove"))
        if(!$(icon).hasClass("glyphicon-remove"))
            {
                $(icon).addClass("glyphicon-remove");
                $(input).css({"background-color":"#ff4d4d"});
                
            }
            $(libelleInput).html(message);
    }
    else
    {
        if($(icon).hasClass("glyphicon-remove"))
            {
                $(icon).removeClass("glyphicon-remove");
                $(libelleInput).html("");
                
            }
            $(input).css({"background-color":"#5cd65c"});
            $(icon).addClass("glyphicon-ok");
    }
}


