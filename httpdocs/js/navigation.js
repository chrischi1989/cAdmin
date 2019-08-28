var $history   = [];
var $backTexts = [];
var $current   = null;
var $previous  = null;

$(document).ready(function() {
    $('body').on('click', 'nav ul li', function($event) {
        if($(this).find('ul').length > 0) {
            $history.push($(this).parent().clone(true));
            $backTexts.push($($event.target).text());
            $current = $(this).children('ul');
            $(this).parent().remove();
            $('.nav nav').append($current);

            if($history.length > 0) {
                $('#back').html('<span class="fas fa-angle-double-left"></span> ' + $($event.target).text());
                document.querySelector('#back').classList.remove('hide');
            } else {
                document.querySelector('#back').classList.add('hide');
            }
        }
    });

    $('body').on('click', '#back', function() {
        $backTexts.pop();
        $previous = $history.pop();
        $current.remove();
        $current = $previous;
        $('.nav nav').append($previous);

        if($history.length > 0) {
            $('#back').html($backTexts.pop());
            document.querySelector('#back').classList.remove('hide');
        } else {
            document.querySelector('#back').classList.add('hide');
        }
    });
});
