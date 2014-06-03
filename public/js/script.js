$(document).ready(function(){
    $(".colorLink").click(function () {
        $td = $(this).parent().next('td');
        $.ajax({
            type: "POST",
            url:'/index/votes',
            dataType: "json",
            data: 'color='+$(this).html(),
            success:    function(data) {
                if (data.votes || data.votes == 0) {
                    $td.html(data.votes);
                }else {
                    alert('Something went wrong');
                }
            },
            error: function() {
                alert('Something went wrong');
            }
        });
        return false;
    });
});