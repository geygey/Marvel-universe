/**/
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
    
    $(document).on("click", ".glyphicon-eye-close", function(e){
       
        $(".glyphicon-eye-close").addClass("glyphicon-eye-open");
        $(".glyphicon-eye-close").removeClass("glyphicon-eye-close");
        $(".glyphicon-eye-open").css({"color":"blue"});
        $("#mdpAuth").attr("type","text");
        
    });
    $(document).on("click", ".glyphicon-eye-open", function(e){
        
        $(".glyphicon-eye-open").addClass("glyphicon-eye-close");
        $(".glyphicon-eye-open").removeClass("glyphicon-eye-open");
        $(".glyphicon-eye-close").css({"color":"#555"});
        $("#mdpAuth").attr("type","password");
        
    });
    //Qd on a le focus du mail
    $(document).on("focusin", "#mailForm", function(e){
        
        lireEmails();
        
   });
    //Qd on perds le focus du mail
    $(document).on("focusout", "#mailForm", function(e){
       verificationMail();
   });
   //Qd on a le focus du login
    $(document).on("focusin", "#loginForm", function(e){
        
        lireLogins();
        
   });
   //Qd on perds le focus du login
    $(document).on("focusout", "#loginForm", function(e){
       verificationLogin();
       
   });
   //Qd on perds le focus du mdp1
    $(document).on("focusout", "#mdpForm", function(e){
       if($("#mdpValidationForm").val().length>0 && $("#mdpValidationForm").val()!=="")
        verificationMdps();
   });
   //Qd on perds le focus du mdp2
    $(document).on("focusout", "#mdpValidationForm", function(e){
       verificationMdps();
   });
   
    //Fct qui vérifie le formulaire d'inscription avant un quelconque envoi à la BD
   $(document).on("click", "#register_create", function (e) {
        
        //Verification du mail
        verificationMail();
        //Verification du login
        verificationLogin();
        verificationMdps();
       //S'il n'y a pas d'erreur dans le formulaire
        if($('.glyphicon-remove').length===0){
           
               ajouterUtilisateur($("#loginForm").val(), $("#mdpForm").val(),$("#mailForm").val());
               
            
        }
        
       
   });
   $(document).on("click", "#authentifier", function (e) {
       connexionUser($("#loginAuth").val(), $("#mdpAuth").val()); 
   });
  
    
});
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
}
function verificationMail(){
    if(verificationInputVide("#mailForm","L'adresse email","#libelleMail"))
    {
        var regexEmail =/^[A-Za-z0-9._-]+@[A-Za-z0-9._-]+\.[A-Za-z]{2,6}$/;
       //On teste l'email
        var ok=regexEmail.test($("#mailForm").val());
        changementApparenceInput(ok, "#iconMail", "#mailForm", "#libelleMail", "L'adresse email ne respecte pas le format standard");
        if(ok){
            
                    var nouveau=verificationNouveauEmail($("#mailForm").val());
                    if(nouveau===0){
                        changementApparenceInput(true, "#iconMail", "#mailForm", "#libelleMail", "");
                    }
                    else{
                        changementApparenceInput(false, "#iconMail", "#mailForm", "#libelleMail", "Cette adresse email existe déjà dans notre base de données.");
                    }
                    
                
        }
    }
    else{
        changementApparenceInput(false, "#iconMail", "#mailForm", "#libelleMail", "L'adresse email est vide");
    }
    
    
}
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
           var etoile=verificationMdp("*", $("#loginForm").val(), 3);
                if(etoile==3){
                    changementApparenceInput(false, "#iconLogin", "#loginForm", "#libelleLogin", "Le login ne peut contenir trois * à la suite");
                }
                else{
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

function affecterListeLogins(tab){
    tableau_logins=tab;
}
function verificationNouveauLogin(nouveauLogin){
    var stop=0;
    for(var i=0;i<tableau_logins.length;i++){
        console.log(tableau_logins[i]+"==="+nouveauLogin)
        if(tableau_logins[i]===nouveauLogin)
            stop=1;
    }
    return stop;
}
function verificationMdps(){
    $("#labelMdpWrong").html("");
    //Si les mdp concordent pas
        if($("#mdpForm").val()!==$("#mdpValidationForm").val()){
            console.log("concord epas");
           $("#labelMdpWrong").append("<li id=\"corrMdp\" style=\"font-weight:bold;color:#ff4d4d;\">Les mots de passe ne correspondent pas </li>");
           
           changementApparenceInput(false, "#iconMdp1", "#mdpForm", "#libelleMdp1", "");
           changementApparenceInput(false, "#iconMdp2", "#mdpValidationForm", "#libelleMdp2", "");
        }
        else{
            console.log("else")
            var flagCasseMdp=0;
           $("#corrMdp").remove();
           $("#corrMdpCarr").remove();
           $("#corrMdpNbCarr").remove();
           //Si le mdp n'est pas vide
           if(verificationInputVide("#mdpForm", "", "#libelleMdp1")){
               //Maintenant on vérifie le contenu du mdp
               var trouve=verificationMdp("ABCDEFGHIJKLMNOPQRSTUVWXYZ", $("#mdpForm").val(), 1);
                if(trouve==0 && flagCasseMdp==0)
                {
                    flagCasseMdp++;
                }
                trouve=verificationMdp("abcdefghijklmnopqrstuvwxyz", $("#mdpForm").val(), 1);
                if(trouve==0 && flagCasseMdp==0){
                    flagCasseMdp++;
                }
                trouve=verificationMdp("1234567890", $("#mdpForm").val(), 1);
                if(trouve==0 && flagCasseMdp==0){
                    flagCasseMdp++;
                }
                
                //S'il manque un ou plusieurs caractères dans le mdp
                if(flagCasseMdp>0){
                    $("#labelMdpWrong").append("<li id=\"corrMdpCarr\" style=\"font-weight:bold;color:#ff4d4d;\">Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre</li>");

                }
                //Si le mdp contient les caractères adéquats
                if(flagCasseMdp==0){
                    //S'il na pas assez de caractères
                    if($("#mdpForm").val().length<6){
                       $("#labelMdpWrong").append("<li id=\"corrMdpNbCarr\" style=\"color:#ff4d4d;\">Le mot de passe doit être long de 6 caractères minimum</li>");


                    }
                    else{
                        changementApparenceInput(true, "#iconMdp1", "#mdpForm", "#libelleMdp1", "");
                        changementApparenceInput(true, "#iconMdp2", "#mdpValidationForm", "#libelleMdp2", "");
                    }
                }
               
           }//Si le mdp est vide
           else{
                changementApparenceInput(false, "#iconMdp1", "#mdpForm", "#libelleMdp1", "Le mot de passe est vide");
                changementApparenceInput(false, "#iconMdp2", "#mdpValidationForm", "#libelleMdp2", "Le mot de passe est vide");
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
    console.log(chaine+" valeur input="+$(chaine).val());
    
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


