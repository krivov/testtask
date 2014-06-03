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
                    if (data.votes != 0) {
                        $('.td-total').html('');
                    }
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

    $(".totalLink").click(function () {
        $td = $(this).parent().next('td');
        $td.html('');

        var sum = 0;
        $('.votesTable tr td.td-votes').each(function( index ) {
            console.log( sum );
            console.log( parseInt($(this).html()) );
            if (parseInt($(this).html()) > 0) {
                sum = sum + parseInt($(this).html());
            }
            console.log( sum );
            console.log( index + ": " + $( this ).text() );
            console.log( sum );
        });
        $td.html(sum);

        return false;
    });
});