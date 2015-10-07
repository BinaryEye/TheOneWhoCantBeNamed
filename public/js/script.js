$("document").ready(function(){
    $(".dropdown-menu li a").on('click',function(){
        $(this).parents(".dropdown").find('button').text($(this).text());
        $(this).parents(".dropdown").find('button').val($(this).text());
    });

    $("button[type='submit']").on('click',function(){
        var year = $("#YearButton").text();
        var month = $("#MonthButton").text();
        var day = $("#DayButton").text();
        var date = year +"-"+month+"-"+ day;
        $("input[name='date_of_birth']").val(date);
        if($("#SexButton").text() == "Male"){
            $("input[name='sex']").val("true");
        }
        else{
            $("input[name='sex']").val("false");
        }
        return true;


    });

});