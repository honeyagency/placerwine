<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context         = Timber::get_context();
$post            = new TimberPost();
$context['post'] = $post;

if (is_page('home')) {
    $context['home'] = prepareHomepageFields();
} elseif (is_page(10)) {
    if (!empty($_GET["varietal_id"])) {
        $cat                      = $_GET["varietal_id"];
        $context['currentFilter'] = new TimberTerm($cat);
    } elseif (!empty($_GET["date_id"])) {

        $cat                      = null;
        $customfilter             = $_GET["date_id"];

        $context['dateFilter'] = $customfilter;

    } else {
        $cat = null;
    }

    $context['wineries'] = getCustomPosts('winery', -1, null, 'title', null, $cat, $customfilter);

    $context['varietals'] = get_terms(array(
        'taxonomy'   => 'varietals',
        'hide_empty' => false,
    ));
} elseif (is_page('events')) {
    $context['events'] = getCustomPosts('event', -1, null, 'date', null, null);

}elseif (is_page('varietals')) {
    $context['varietals'] = prepareVarietalsPage();

}

Timber::render(array('page-' . $post->post_name . '.twig', 'page.twig'), $context);
