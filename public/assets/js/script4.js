
$(document).ready(function()
    {
  $(document).on('click','.pagination a',function(e){
    e.preventDefault();


        var url = $(this).attr("href");

        $.ajax({
            type:'get',
            url:url,
            success: function(data){
                $('.pers1').empty().html(data);

        
            }
        });
});

});

