<?php

     /*
    
            OUTPUTS A COPYRIGHT NOTICE WHEN CALLED FROM A TEMPLATE FILE
    
    */

    if( !function_exists( 'wddm_copyright' ) ):
    function wddm_copyright(){
        
        echo date('Y') . ' Mike Batruch.';
        }
    endif;

	if( !function_exists( 'custom_credits' ) ):
    function custom_credits(){
        
        echo 'Website Designed and Developed by' . ' <a href="http://mike-batruch.ca">Mike B.</a>';
        }
    endif;

	if( !function_exists( 'custom_social_fb' ) ):
    function custom_social_fb(){
        
        echo '<a href="http://gigpress.com/faq/" target="blank_"><img src="http://wordpress-custom.mike-batruch.ca/wp-content/uploads/2017/07/facebook.png" alt="facebook" /></a>';
        }
    endif;

	if( !function_exists( 'custom_social_tw' ) ):
    function custom_social_tw(){
        
        echo '<a href="http://gigpress.com/faq/" target="blank_"><img src="http://wordpress-custom.mike-batruch.ca/wp-content/uploads/2017/07/twitter.png" alt="twitter" /></a>';
        }
    endif;

	if( !function_exists( 'custom_clearfix' ) ):
    function custom_clearfix(){
        
        echo '<div class="clearfix"></div>';
        }
    endif;


    /*
    
            REMOVES UNNECESSARY PARENT THEME STYLES AND SCRIPTS AND ADDS THE CHILD THEME ONES INSTEAD
    
    */
    
    if( !function_exists( 'wddm_scripts_and_styles' ) ):
    function wddm_scripts_and_styles(){
        
        //remove stylesheet
        wp_dequeue_style( 'twentyseventeen-fonts' );
        
        //add stylesheet link for the fonts we need
        wp_enqueue_style( 'wddm-fonts',
                            'https://fonts.googleapis.com/css?family=Roboto:400,500,700' );
        
        //removes the script that generates buttons and icons for dropdown menus
        wp_dequeue_script( 'twentyseventeen-navigation' );
        
        wp_enqueue_script( 'lightbox-js', get_stylesheet_directory_uri() . '/js/lightbox.js' );
        wp_enqueue_style( 'lightbox-css', get_stylesheet_directory_uri() . '/css/lightbox.min.css' );
    }
    add_action( 'wp_enqueue_scripts', 'wddm_scripts_and_styles', 11 );
    endif;


 /**
     * REMOVE & ADD SOME TWENTYSEVENTEEN FEATURES
*/


    if( !function_exists( 'wddm_setup_theme' ) ):
    function wddm_setup_theme(){
        
        // stop twentyseventeen's svg icons from preloading
        // at the bottom of the page
        remove_action( 'wp_footer', 
                       'twentyseventeen_include_svg_icons',
                       9999 );
        // stop twentyseventeen from inserting svg tags
        // within menu items (the svgs are no longer loaded)
        remove_filter( 'nav_menu_item_title',
                       'twentyseventeen_dropdown_icon_to_menu_link',
                       11 );
        
        // remove the custom header option
        remove_theme_support( 'custom-header' );
        
        // remove the custom color scheme option
        remove_theme_support( 'custom-color-scheme' );
        
        // remove the post formats feature option
        remove_theme_support( 'post-formats' );
        
		// remove the post formats feature option
        remove_theme_support( 'entry-header' );

        // get rid of the social nav
        unregister_nav_menu( 'social' );
        
        //  THUMBNAIL FOR POSTS PAGE - AUTO-RESIZE
        
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 150, 150, true );
    }
    add_action( 'after_setup_theme', 'wddm_setup_theme', 11 );
    endif;


// REMOVE WIDGET AREA FEATURES

if( !function_exists( 'unregister_default_widgets' ) ):

	 function unregister_default_widgets() {
     unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Calendar');
     unregister_widget('WP_Widget_Archives');
     unregister_widget('WP_Widget_Links');
     unregister_widget('WP_Widget_Meta');
     unregister_widget('WP_Widget_Search');
     unregister_widget('WP_Widget_Text');
     unregister_widget('WP_Widget_Categories');
     unregister_widget('WP_Widget_Recent_Posts');
     unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_RSS');
     unregister_widget('WP_Widget_Tag_Cloud');
     unregister_widget('WP_Nav_Menu_Widget');
     unregister_widget('Twenty_Eleven_Ephemera_Widget');
 }
 add_action('widgets_init', 'unregister_default_widgets', 11);
endif;

// ADD EXTRA TAB

if( !function_exists( 'wddm_register_menu_item' ) ):

    function wddm_register_menu_item(){
        
        add_menu_page( 'WDDM Custom Theme Settings', 
                       'Custom Tab Over Here!',
                       'switch_themes', 
                       'custom-menu-page',
                       'custom_menu_page');
    }

add_action( 'admin_menu', 'wddm_register_menu_item');

endif;

if( !function_exists( 'custom_menu_page' ) ):


    function custom_menu_page(){
        
        add_option( 'enter-time' );
        add_option( 'enter-price' );
        add_option( 'enter-ticket-link' ); ?>
        <div class="wrap">
    
    <h1>Event Listings Settings</h1>
    
        <form action="<?php echo $_SERVER[ 'REQUST_URI' ]?>" method="post">
            <ul class="event-listings">
                <li>
                    <input type="text"
                           name="time">
                </li>
                <li>
                    <input type="text"
                           name="price">
                </li>
                <li>
                    <input type="text"
                           name="ticket-link">
                </li>
            </ul>
        </form>
</div>
   <?php
    }
endif;



