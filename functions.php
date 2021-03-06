<?php
if (!class_exists('Timber')) {
    add_action('admin_notices', function () {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
    });
    return;
}

class StarterSite extends TimberSite
{

    public function __construct()
    {
        add_theme_support('post-formats');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_filter('timber_context', array($this, 'add_to_context'));
        add_filter('get_twig', array($this, 'add_to_twig'));
        add_action('init', array($this, 'register_post_types'));
        add_action('init', array($this, 'register_taxonomies'));
        parent::__construct();
    }

    public function register_post_types()
    {

        //this is where you can register custom post types

    }

    public function register_taxonomies()
    {

        //this is where you can register custom taxonomies

    }

    public function add_to_context($context)
    {
        $context['menu']       = new TimberMenu(2);
        $context['footermenu'] = new TimberMenu(3);
        $context['site']       = $this;
        $context['assets']     = get_template_directory_uri() . '/app';
        $context['options']    = prepareSiteOptions();
        return $context;
    }

    public function add_to_twig($twig)
    {

        /* this is where you can add your own fuctions to twig */
        $twig->addExtension(new Twig_Extension_StringLoader());
        $twig->addFilter('myfoo', new Twig_Filter_Function('myfoo'));
        return $twig;
    }
}

new StarterSite();

require_once 'library/admin.php';
// admin settings & customization

require_once 'library/buscemi.php';
// lots of extra theme stuff
