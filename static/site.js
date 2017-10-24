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
});