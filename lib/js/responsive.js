/*Script servant à redimensionner les différents éléments d'affichage en cas d'extrèmes zooms*/
$(document).ready(function () {
    //Si la largeur de la page est en dessous des 600 pixels (si on a fait un gros zoom)
    if ($(window).width()<=600) {
        //On redimensionne le menu
        redimensionnerMenu($(window).width());
    }
});
//Fonction qui s'exécute dès que la page se redimensionne
$(window).on({
        resize: function (e) {
            var YourFunction = (function () {
            //On récupère la largeur de la page
                var screenWidth = $(window).width();
               //Si la largeur de la page est en dessous des 600 pixels (si on a fait un gros zoom)
                if (screenWidth<=600) {
                    //On redimensionne le menu
                    redimensionnerMenu(screenWidth);
                }
                //Si, au contraire, on est dans un zoom moins grand
                else{
                    //On regarde si a déjà bougé les éléments auparavant via l'existance de la classe ici
                    if(!$("#rowMenu").hasClass("vertical-align")){
              
                        //On rajoute l'ancienne classe et on modifie le css nécessaire
                        $("#rowMenu").addClass("vertical-align");
                        $("a.lienMenu").css({"display":"flex", "margin-bottom":"0%"});
                        $("#logo").css({"width":"100%", "margin-left":"0%"});
                    }
                    
                }

            })();

        }
    });
function redimensionnerMenu(taille){
    
    //On retire la classe vertical align afin que bootsrap gère le zoom avec son système de grille
    $("#rowMenu").removeClass("vertical-align");
    $("a.lienMenu").css({"display":"block", "margin-bottom":"0.5%"});
    $("#logo").css({"width":"50%", "margin-left":"25%"});
}
