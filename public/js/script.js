$("document").ready(function(){
    $(".dropdown-menu li a").on('click',function(){
        $(this).parents(".dropdown").find('button').text($(this).text());
        $(this).parents(".dropdown").find('button').val($(this).text());
    });

    $("button[type='submit']").on('click',function(){
        var year = $.trim($("#YearButton").text());
        var month = $.trim($("#MonthButton").text());
        var day = $.trim($("#DayButton").text());
        if(day.length == 1){
            day = "0" + day;
        }
        var date = year +"-"+month+"-"+ day;
        $("input[name='date_of_birth']").val(date);
        if($("#SexButton").text() == "Female"){
            $("input[name='sex']").val("1");
        }
        else{
            $("input[name='sex']").val("0");
        }
        return true;


    });
    $("#tag_list").select2({
        placeholder: "Choose tags for your post"
    });


});