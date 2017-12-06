<?php

function prepareSiteOptions()
{
    $social = array(
        'facebook'  => get_field('field_59e8db03b3414', 'options'),
        'twitter'   => get_field('field_59e8db13b3415', 'options'),
        'instagram' => get_field('field_5a049895378c0', 'options'),
    );
    $defaultImageId = get_field('field_59e8db84815ec', 'options');
    if ($defaultImageId != null) {
        $defaultImage = new TimberImage($defaultImageId);
    } else {
        $defaultImage = null;
    }
    $defaults = array(
        'image'    => $defaultImage,
        'location' => get_field('field_59fe3e0520533', 'options'),
        '404'      => get_field('field_59e8dbbd815ed', 'options'),
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
    $footer = array(
        'email'        => get_field('field_5a03a31071dcc', 'options'),
        'area_1_title' => get_field('field_5a049439a795f', 'options'),
        'area_1_pages' => get_field('field_5a049447a7960', 'options'),
        'area_2_title' => get_field('field_5a049450a7961', 'options'),
        'area_2_pages' => get_field('field_5a049471a7962', 'options'),
        'privacy'      => get_field('field_5a049a134307b', 'options'),
    );
    $options = array(
        'social'  => $social,
        'default' => $defaults,
        'search'  => $search,
        'footer'  => $footer,
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

    if (have_rows('field_5a05d6f761946')) {
        $details = array();
        while (have_rows('field_5a05d6f761946')) {
            the_row();
            $details[] = array(
                'title'   => get_sub_field('field_5a05d6ff61947'),
                'content' => get_sub_field('field_5a05d70561948'),
            );
        }
    }
    $event = array(
        'start_date'  => get_field('field_59e92c5b89c00'),
        'end_date'    => get_field('field_59e92c7c89c01'),
        'description' => get_field('field_59f125e6903fa'),
        'details'     => $details,
        'cost'        => get_field('field_5a05daeaac658'),
        'location'    => get_field('field_5a05daf8ac659'),
        'hours'       => get_field('field_5a05db04ac65a'),
        'tickets'     => get_field('field_5a05daccac657'),
    );
    return $event;

}
function prepareWineryFields()
{
    if (have_rows('field_59fb890e85238')) {
        $dates = array();
        while (have_rows('field_59fb890e85238')) {
            the_row();
            $dates[] = get_sub_field('field_59fb89d58523e');
        }
    }
    if (have_rows('field_59fb891585239')) {
        $hours = array();
        while (have_rows('field_59fb891585239')) {
            the_row();
            $hours[] = get_sub_field('field_59fb89b98523d');
        }
    }
    $logoId = get_field('field_59fb8e56ffc8c');
    $logo   = null;
    if (!empty($logoId)) {
        $logo = new TimberImage($logoId);
    }
    $content = array(
        'content'     => get_field('field_59fdf72936ee3'),
        'description' => get_field('field_59fba61288e3e'),
        'events'      => get_field('field_59fdf79732e88'),
    );
    $varietals = get_field('field_5a04e5d3d6115');
    if (!empty($varietals)) {
        foreach ($varietals as $term) {
            $varietallist[] = new TimberTerm($term);
        }
    } else {
        $varietallist = null;
    }
    $amenities = get_field('field_59fe00678e7a2');
    if (!empty($amenities)) {
        foreach ($amenities as $term) {
            $amenitieslist[] = new TimberTerm($term);
        }
    } else {
        $amenitieslist = null;
    }

    if (have_rows('field_59fe148b19fce')) {
        $press = array();
        while (have_rows('field_59fe148b19fce')) {
            the_row();
            $imageId = get_sub_field('field_59fe14c019fd1');
            $image   = null;
            if (!empty($imageId)) {
                $image = new TimberImage($imageId);
            }
            $press[] = array(
                'image'       => $image,
                'publication' => get_sub_field('field_59fe149a19fcf'),
                'title'       => get_sub_field('field_59fe14ab19fd0'),
                'link'        => get_sub_field('field_59fe14f019fd2'),
            );
        }
    } else {
        $press = null;
    }
    if (have_rows('field_59fe2e286be24')) {
        $awards = array();
        while (have_rows('field_59fe2e286be24')) {
            the_row();
            $awardImageId = get_sub_field('field_59fe2e286be25');
            $awardImage   = null;
            if (!empty($awardImageId)) {
                $awardImage = new TimberImage($awardImageId);
            }
            $awards[] = array(
                'image'       => $awardImage,
                'publication' => get_sub_field('field_59fe2e286be26'),
                'title'       => get_sub_field('field_59fe2e286be27'),
                'link'        => get_sub_field('field_59fe2e286be28'),
            );
        }
    } else {
        $awards = null;
    }

    $deets = array(
        'amenities' => $amenitieslist,
        'varietals' => $varietals,
        'press'     => $press,
        'awards'    => $awards,
    );
    $sidebar = array(
        'logo'     => $logo,
        'dates'    => $dates,
        'hours'    => $hours,
        'location' => get_field('field_59fb89208523a'),
        'phone'    => get_field('field_59fb895d8523b'),
        'website'  => get_field('field_59fb89918523c'),
    );
    // print_r(get_field('field_5a04d1cb7aa7f'));
    $filter = array(
        'dates'     => get_field('field_5a04d1cb7aa7f'),
        'amenities' => $amenitieslist,
    );
    $winery = array(
        'content' => $content,
        'deets'   => $deets,
        'sidebar' => $sidebar,
        'filter'  => $filter,
    );

    return $winery;
}
