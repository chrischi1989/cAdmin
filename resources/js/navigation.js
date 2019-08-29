var $history   = [];
var $backTexts = [];
var $current   = null;
var $previous  = null;

/** Aktivmarkierung (+ Merkfunktion + Wiederherstellung) */
$('.navigation nav ul').each(function($index, $element) {
    var $e = $($element).clone(true);
    $history.push($e);
});

$history.forEach(function($item, $index) {
    if($item.find('span[data-backhtml]').length > 0) {
        $backTexts.push($item.find('span[data-backhtml]').data('backhtml'));
    }
    var $activeLength = $item.children('ul > li.active').length;
    if($index === 0 && $activeLength > 0) {
        $history = [];
    } else if($index > 0 && $activeLength > 0) {
        $current = $item;
        $history.splice($index, $history.length - 1);
        $backTexts.splice($index, 1);
    }
});

if($history.length > 0) {
    $('.navigation nav').find('ul').remove();
    $('.navigation nav').append($current);
    $('#back').html($backTexts[$backTexts.length - 1]).removeClass('empty');
}

/** Vorwaerts Navigation (+ Merkfunktion) */
$('body').on('click', '.navigation nav ul li', function($event) {
    if($(this).find('ul').length > 0) {
        $current      = $(this).children('ul');
        var $parent   = $(this).parent();
        var $backHtml = $(this).find('span[data-backhtml]').data('backhtml');

        $history.push($parent.clone(true));
        $backTexts.push($backHtml);
        $('.navigation nav').append($current);

        $parent.remove();

        if($history.length > 0) {
            $('#back').html($backHtml).removeClass('empty');
        }
    }
});

/** Zurueck Navigation (+ Wiederherstellung) */
$('body').on('click', '#back', function() {
    if($history.length === 0) return true;

    $backTexts.pop();
    $previous = $history.pop();
    $current.remove();
    $current = $previous;
    $('.navigation nav').append($previous);
    $('#back').html($backTexts.pop());

    if($history.length === 0) {
        $('#back').html('<span class="fas fa-bars fa-fw mr-0"></span> Menü').addClass('empty');
    }
});
