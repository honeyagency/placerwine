jQuery(document).ready(function($) {
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this,
                args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };
    var myLazyLoad = new LazyLoad({
        // example of options object -> see options section
        threshold: 500,
        throttle: 30,
        show_while_loading: false,
    });

    function toggleSearch() {
        $body = $('body');
        $search = $('.block--search-modal');
        if ($body.hasClass('search-is-open')) {} else {
            $('.search-field').focus();
        }
        $body.toggleClass('search-is-open');
        $search.toggleClass('this-is-open');
    }
    $toggle = $('.toggle-search');
    $toggle.on('click touchstart', function(event) {
        event.preventDefault();
        toggleSearch();
    });
    // $('.trigger--children').on('click touchstart', function(event) {
    //     event.preventDefault();
    //     $parent = $(this).parent();
    //     $child = $parent.find('.nav-drop');
    //     $openChild = $('.nav-drop.open');
    //     if ($parent.hasClass('children--visible')) {
    //         $parent.removeClass('children--visible');
    //         $child.removeClass('open').slideUp();
    //     } else {
    //         $('.children--visible').removeClass('children--visible');
    //         $openChild.removeClass('open').slideUp();
    //         $parent.addClass('children--visible');
    //         $child.addClass('open');
    //         $child.slideDown();
    //     }
    // });
    $('.trigger--children').on('click touchstart', function(event) {
        event.preventDefault();
        $parent = $(this).parent();
        $child = $parent.find('.nav-drop');
        $openChild = $('.nav-drop.open');
        if ($parent.hasClass('children--visible')) {
            $parent.removeClass('children--visible');
            $child.removeClass('open');
        } else {
            $('.children--visible').removeClass('children--visible');
            $openChild.removeClass('open');
            $parent.addClass('children--visible');
            $child.addClass('open');
        }
    });
    $('.menu--trigger').on('click touchstart', function(event) {
        event.preventDefault();
        $('body').toggleClass('navopen');
        $('.children--visible').removeClass('children--visible');
        $openNav = $('.nav-drop.open');
        $openNav.removeClass('open');
    });
    $('#wineryfilter').submit(function() {
        $(this).attr('action', $(this).attr('action') + $('#amenity_id').val());
        $(this).submit();
    });

    function toTop(e) {
        var body = document.body,
            html = document.documentElement;
        var height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);
        var $toTop = $('.to-top');
        var $theWin = $(document).scrollTop();
        console.log('run');
        if (height > 6000) {
            if ($theWin > 3000) {
                $toTop.addClass('showit');

            } else {
                $toTop.removeClass('showit');
            }
        }
    }
$('#wineryuitoggle').on('click touchstart', function(event) {
    event.preventDefault();
    $('.shortlist').slideToggle(400);
    $('#winerieslist').slideToggle(400);
        $('.shortlist').toggleClass('active');
    $('#winerieslist').toggleClass('active');
    var longlist = $('#wineryuitoggle').attr('data-longtext');
    var shortlist = $('#wineryuitoggle').attr('data-shorttext');
    if ($('.shortlist').hasClass('active')) {
    $('#wineryuitoggle').text(longlist);    
    }else{
        $('#wineryuitoggle').text(shortlist);
    }

});
    var toTopDebounce = debounce(function(e) {
        toTop(e);
    }, 250);
    window.addEventListener('scroll', toTopDebounce);

    jQuery(function() {
        jQuery('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = jQuery(this.hash);
                target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    jQuery('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
});