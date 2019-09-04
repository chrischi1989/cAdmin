$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

bootbox.addLocale('psn', {
    OK : 'OK',
    CANCEL : 'Abbrechen',
    CONFIRM : 'Bestätigen'
});
bootbox.setLocale('psn');

var $currentUser = null;
$.ajax({
    'url': '/admin/user/xhr/current',
    'async': false,
    'datatype': 'json',
    'success': function($response) {
        $currentUser = $response;
    }
});

$('body').on('click', 'button.delete', function($event) {
    var $this = $(this);
    $event.preventDefault();

    bootbox.confirm({
        message: $this.data('message'),
        callback: function ($result) {
            if($this.attr('type') === 'button') return true;

            var $action = $this.attr('formaction');
            if($action) $this.parents('form').attr('action', $action);

            $result ? $this.parents('form').submit() : null;
        },
        buttons: {
            confirm: {
                className: 'btn-success'
            },
            cancel: {
                className: 'btn-danger'
            }
        }
    });
});

var $history   = [];
var $backTexts = [];
var $current   = null;
var $previous  = null;

$('.navigation nav ul > li.active').parents('ul').each(function($index, $element) {
    if($($element).parent().is('li')) {
        $backTexts.push($($element).parent().find('span[data-backhtml]').data('backhtml'));
    }

    $e = $($element).clone(true);
    if($index == 0) {
        $current = $e;
    } else if($index > 0) {
        $history.push($e);
    }
});

if($history.length > 0) {
    $('.navigation nav').find('ul').remove();
    $('.navigation nav').append($current);
    $('#back').html($backTexts[0]).removeClass('empty');
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

    $backTexts.shift();
    $previous = $history.shift();
    $current.remove();
    $current = $previous;
    $('.navigation nav').append($previous);
    $('#back').html($backTexts[0]);

    if($history.length === 0) {
        $('#back').html('<span class="fas fa-bars fa-fw mr-0"></span> Menü').addClass('empty');
    }
});

$('.js-select-all').on('click', function() {
    $('.card-table').find(':checkbox').prop('checked', $(this).prop('checked'));
    $('.js-bulk-actions').toggleClass('disabled');
});

$('input.js-select-item').on('click', function() {
    var $checkedItems = $('.card-table').find('.card-body').find(':checkbox:checked');
    if($checkedItems.length === 0) {
        $('.js-bulk-actions').addClass('disabled');
        $('.js-select-all').prop('checked', '');
    } else {
        $('.js-bulk-actions').removeClass('disabled');
    }
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
