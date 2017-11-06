jQuery(document).ready(function($) {
    var myLazyLoad = new LazyLoad({
        // example of options object -> see options section
        threshold: 500,
        throttle: 30,
        show_while_loading: false,
    });

    function toggleSearch() {
        $body = $('body');
        $search = $('.block--search-modal');
        $body.toggleClass('search-is-open');
        $search.toggleClass('this-is-open');
    }
    $toggle = $('.toggle-search');
    $toggle.on('click touchstart', function(event) {
        event.preventDefault();
        toggleSearch();
    });
    $('.trigger--children').on('click touchstart', function(event) {
        event.preventDefault();
        $parent = $(this).parent();
        $child = $parent.find('.nav-drop');
        $openChild = $('.nav-drop.open');
        if ($parent.hasClass('children--visible')) {
            $parent.removeClass('children--visible');
            $child.removeClass('open').slideUp();
        } else {
            $('.children--visible').removeClass('children--visible');
            $openChild.removeClass('open').slideUp();
            $parent.addClass('children--visible');
            $child.addClass('open');
            $child.slideDown();
        }
    });
    $('.menu--trigger').on('click touchstart', function(event) {
        event.preventDefault();
        $('body').toggleClass('navopen');
    });
});