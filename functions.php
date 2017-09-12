<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

    // Get the theme data
    $the_theme = wp_get_theme();

    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'extra-script', get_stylesheet_directory_uri() . '/js/extras.js', array(), $the_theme->get( 'Version' ), true );

}

function userName(){
    $user = wp_get_current_user();
    $name = $user->display_name;
    return $name;
}

function userEmail(){
    $user = wp_get_current_user(); 
    $userEmail = $user->user_email; 
    return $userEmail; 
}

//what's the metafield value
function theHours($id){
     $hrs = get_post_custom_values('hours');
     return $hrs[0];
}


//add author meta value
function updateHrs($id, $post){
    $author = $author_id=$post->post_author;
    if(theHours($id) > 0){
        update_user_meta( $author, 'totalHrs', theHours($id));
    }
}

add_action( 'save_post', 'updateHrs', 10, 2);

function create_posttype(){
    register_post_type('profile', 
        array(
            'labels' => array(
                    'name' => __('Profiles'), 
                    'singular_name' => __('Profile'),
                ), 
                'supports' => array('title', 'editor','thumbnail', 'comments', 'revisions', 'custom-fields'), 
                'public' => true, 
                'has_archive' => true, 
                'rewrite' => array('slug' => 'profile'), 
                'hierarchical' => true, 
                'menu_icon' => 'dashicons-groups'
            )
        ); 

        register_post_type('check-in', 
        array(
            'labels' => array(
                    'name' => __('Check-ins'), 
                    'singular_name' => __('Check-in'),
                ), 
                'supports' => array('title', 'editor','thumbnail', 'comments', 'revisions', 'custom-fields'), 
                'public' => true, 
                'has_archive' => true, 
                'rewrite' => array('slug' => 'check-in'), 
                'hierarchical' => true, 
                'menu_icon' => 'dashicons-yes'
            )
        ); 

}



add_action('init', 'create_posttype'); 