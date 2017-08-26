//window.location = "Nouvelle url";
$(document).ready(function () {
    $(document).on("click", ".lienArticle", function (e){
        window.location = "index.php?page=article.php&id="+$(this).data("id")+"&type="+$(this).data("type");
    });
});

