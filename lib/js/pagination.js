//Script pour calculer le nbre de pages pour articles, séries, films et effectuer la pagination
var show_per_page = 4; 
    var current_page = 0;
$(document).ready(function() {
    //nbre pages= nombre d'élt enfants (ou articles)/4 (donc 4 articles par page) le tout à larrondi
      var number_of_pages = Math.ceil($('#content-articles').children().length / show_per_page);
      
      //On stocke le tout dans nav avec une boucle
      var nav = '<ul class="pagination"><li><a href="javascript:previous();">&laquo;</a>';

      var i = -1;
      while(number_of_pages > ++i){
        nav += '<li class="page_link'
        if(!i) nav += ' active';
        nav += '" id="id' + i +'">';
        nav += '<a href="javascript:go_to_page(' + i +')">'+ (i + 1) +'</a>';
      }
      nav += '<li><a href="javascript:next();">&raquo;</a></ul>';

      $('.page_navigation').html(nav);
      //Sert à afficher les 4 articles de la page 1 avec du css
      set_display(0, show_per_page);
      
    });
    function set_display(first, last) {
      $('#content-articles').children().css('display', 'none');
      $('#content-articles').children().slice(first, last).css('display', 'block');
    }
    //qd on fait précédent
    function previous(){
        if($('.active').prev('.page_link').length) go_to_page(current_page - 1);
    }
    //qd on fait suivant
    function next(){
        if($('.active').next('.page_link').length) go_to_page(current_page + 1);
    }
    //fct appelée quand on clique dans la div de pagination sur un numéro ou suivant ou précédent
    function go_to_page(page_num){
      current_page = page_num;
      start_from = current_page * show_per_page;
      end_on = start_from + show_per_page;
      set_display(start_from, end_on);
      
        $('.active').removeClass('active');
      $('#id' + page_num).addClass('active');
      //Pr remonter en haut de la page
      window.scrollTo(0, 0);
    }  

    
