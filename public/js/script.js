$("document").ready(function(){
    $(".dropdown-menu li a").on('click',function(){
        $(this).parents(".dropdown").find('button').text($(this).text());
        $(this).parents(".dropdown").find('button').val($(this).text());
    });

});