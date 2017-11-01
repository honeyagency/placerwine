<?php

function prepareSiteOptions()
{
    $social = array(
        'facebook' => get_field('field_59e8db03b3414', 'options'),
        'twitter'  => get_field('field_59e8db13b3415', 'options'),
    );
    $defaultImageId = get_field('field_59e8db84815ec', 'options');
    if ($defaultImageId != null) {
        $defaultImage = new TimberImage($defaultImageId);
    } else {
        $defaultImage = null;
    }
    $defaults = array(
        'image' => $defaultImage,
        '404'   => get_field('field_59e8dbbd815ed', 'options'),
    );
    if (have_rows('field_59e8e305d478f', 'options')) {
        $links = array();
        while (have_rows('field_59e8e305d478f', 'options')) {
            the_row();
            $links[] = get_sub_field('field_59e8e31ed4790', 'options');
        }
    }
    $search = array(
        'title'    => get_field('field_59e8e2e3d478d', 'options'),
        'text'     => get_field('field_59e8e2f3d478e', 'options'),
        'form'     => get_search_form(false),
        'linktext' => get_field('field_59e8e4bfcfd7a', 'options'),
        'links'    => $links,
    );
    $options = array(
        'social'  => $social,
        'default' => $defaults,
        'search'  => $search,
    );
    return $options;
}

function prepareHomepageFields()
{
    $location     = get_field('field_59e9260cb7847');
    $visitImageId = get_field('field_59e926379bef9');
    if ($visitImageId != null) {
        $visitImage = new TimberImage($visitImageId);
    } else {
        $visitImage = null;
    }
    $visit = array(
        'image' => $visitImage,
        'title' => get_field('field_59e926449befa'),
        'link'  => get_field('field_59e9264d9befb'),
    );
    $galleryIds = get_field('field_59e926689befd');
    if (!empty($galleryIds)) {
        foreach ($galleryIds as $image) {
            $gallery[] = new TimberImage($image['id']);
        }
    } else {
        $gallery = null;
    }
    $region = array(
        'gallery' => $gallery,
        'title'   => get_field('field_59e926899befe'),
        'link'    => get_field('field_59e9268d9beff'),
    );
    $exploreImageId = get_field('field_59e926f49bf02');
    if ($exploreImageId != null) {
        $exploreImage = new TimberImage($exploreImageId);
    } else {
        $exploreImage = null;
    }
    $explore = array(
        'image' => $exploreImage,
        'title' => get_field('field_59e926ff9bf03'),
        'link'  => get_field('field_59e9270a9bf04'),
    );
    $eventDisplay = get_field('field_59e9271d9bf06');
    if ($eventDisplay == 'recent') {
        $events = getCustomPosts('event', 3, null, 'date', null, null);
    } else {
        if (have_rows('field_59e9276e9bf07')) {
            $events = array();
            while (have_rows('field_59e9276e9bf07')) {
                the_row();
                $events[] = get_sub_field('field_59e927969bf08');
            }
        }
    }
    $eventArray = array(
        'posts' => $events,
        'title' => get_field('field_59f124fe31101'),
        'link'  => get_field('field_59f1250931102'),
    );
    $home = array(
        'location' => $location,
        'visit'    => $visit,
        'region'   => $region,
        'explore'  => $explore,
        'events'   => $eventArray,
    );
    return $home;

}
function prepareEventFields()
{
    $event = array(
        'start_date'  => get_field('field_59e92c5b89c00'),
        'end_date'    => get_field('field_59e92c7c89c01'),
        'time'        => get_field('field_59e92ccd89c03'),
        'description' => get_field('field_59f125e6903fa'),
    );
    return $event;

}
