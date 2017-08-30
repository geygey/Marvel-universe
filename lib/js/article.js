
$(document).ready(function () {
    //Qd on clique sur un article (news, série ou film), on dirige l'user sur la page article.php
    $(document).on("click", ".lienArticle", function (e){
        window.location = "index.php?page=article.php&id="+$(this).data("id")+"&type="+$(this).data("type");
    });
});

