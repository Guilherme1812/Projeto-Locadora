$(document).ready(function() {
 var botao = $('#bt');
 var dropDown = $('.ul_sub');
 
    

    botao.on('click', function(event){
        dropDown.stop(true,true).slideToggle();
        event.stopPropagation();
    });
});

$(document).ready(function() {
 var botao = $('#bt_cad');
 var dropDown = $('.ul_sub_cad');
 
    

    botao.on('click', function(event){
        dropDown.stop(true,true).slideToggle();
        event.stopPropagation();
    });
});


$(document).ready(function() {
 var botaoCad = $('#bt_con');
 var dropDownCad = $('.ul_sub_con');
 
    

    botaoCad.on('click', function(event){
        dropDownCad.stop(true,true).slideToggle();
        event.stopPropagation();
    });
});


$(document).ready(function() {
 var botaoCad = $('#bt_loc');
 var dropDownCad = $('.ul_sub_loc');
 
    

    botaoCad.on('click', function(event){
        dropDownCad.stop(false,false).slideUp();
        event.stopPropagation();
    });
});

