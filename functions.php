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
    wp_enqueue_script( 'd3', 'https://d3js.org/d3.v4.min.js', array(), $the_theme->get( 'Version' ), false );
    wp_enqueue_script( 'amcharts', get_stylesheet_directory_uri() . '/js/amcharts/amcharts/amcharts.js', array(), $the_theme->get( 'Version' ), false );
    wp_enqueue_script( 'amcharts-serial', get_stylesheet_directory_uri() . '/js/amcharts/amcharts/serial.js', array(), $the_theme->get( 'Version' ), false );
    wp_enqueue_script( 'amcharts-pie', get_stylesheet_directory_uri() . '/js/amcharts/amcharts/pie.js', array(), $the_theme->get( 'Version' ), false );
    wp_enqueue_script( 'amcharts-theme', get_stylesheet_directory_uri() . '/js/amcharts/amcharts/themes/light.js', array(), $the_theme->get( 'Version' ), false );
    wp_enqueue_script( 'vue', 'https://unpkg.com/vue', array(), $the_theme->get( 'Version' ), false );
    wp_enqueue_script( 'vue-resource', 'https://cdn.jsdelivr.net/npm/vue-resource@1.3.4', array(), $the_theme->get( 'Version' ), false );

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

function printFormData(){
    var_dump(run_custom_sql_query());
}

add_action('init', 'create_posttype');

function run_custom_sql_query(){
    $sql_interface = new SqlInterface;
    $results = $sql_interface->getOptions();


    foreach($results as &$result){

        $subject = $result->reflectionContent;

        $q1Pattern = '/<div id=\"event-rating-1\">([a-zA-Z0-9 ’\'.;:_]+)<\/div>/';
        preg_match($q1Pattern, $subject, $q1Match);

        $q2Pattern = '/<div id=\"event-rating-2\">([a-zA-Z0-9 ’\'.;:_]+)<\/div>/';
        preg_match($q2Pattern, $subject, $q2Match);

        $q3Pattern = '/<div id=\"event-rating-3\">([a-zA-Z0-9 ’\'.;:_]+)<\/div>/';
        preg_match($q3Pattern, $subject, $q3Match);

        $q4Pattern = '/<div id=\"event-rating-4\">([a-zA-Z0-9 ’\'.;:_]+)<\/div>/';
        preg_match($q4Pattern, $subject, $q4Match);

        $q5Pattern = '/<div id=\"event-rating-5\">([a-zA-Z0-9 ’\'.;:_]+)<\/div>/';
        preg_match($q5Pattern, $subject, $q5Match);

        $result->question1 = trim(preg_split('/:/', $q1Match[1])[1]);
        $result->question2 = trim(preg_split('/:/', $q2Match[1])[1]);
        $result->question3 = trim(preg_split('/:/', $q3Match[1])[1]);
        $result->question4 = trim(preg_split('/:/', $q4Match[1])[1]);
        $result->question5 = trim(preg_split('/:/', $q5Match[1])[1]);


    }


    return $results;
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'davinci/v1', '/data', array(
        'methods' => 'GET',
        'callback' => 'run_custom_sql_query',
    ) );
} );


// class SqlInterface {
//     function __construct(){
//         global $wpdb;
//         $this->db = $wpdb;
//     }

//     function getOptions(){
//         $results = $this->db->get_results(
//     'SELECT reflectionID, reflectionContent, postDate, EmailTable.userEmail, eventID, eventTitle, eventHours, profileID, userCohort, userMajor
// FROM
//     (SELECT ID as reflectionID, post_content as reflectionContent, post_date as postDate FROM wp_posts WHERE post_type= "post" AND post_status="publish") AS PostsTable
// INNER JOIN
//     (SELECT post_id, meta_value as userEmail FROM wp_postmeta WHERE meta_key= "userEmail") AS EmailTable
// ON PostsTable.reflectionID = EmailTable.post_id
// -- Do a LEFT JOIN here because we are going to have fewer
// LEFT JOIN
// (
//     SELECT profileID , userEmail FROM wp_posts
//     INNER JOIN
//         ( SELECT meta_value as userEmail, post_id as profileID FROM wp_postmeta WHERE meta_key = "userEmail") AS metaTable1
//         ON wp_posts.ID =  metaTable1.profileID WHERE post_type = "profile"
// ) As MetaTable ON  EmailTable.userEmail = MetaTable.userEmail

// LEFT JOIN
// ( SELECT meta_value as userCohort, post_id FROM wp_postmeta WHERE meta_key = "cohort")
// As MetaTable2 ON  MetaTable.profileID = MetaTable2.post_id

// LEFT JOIN
// ( SELECT meta_value as userMajor, post_id FROM wp_postmeta WHERE meta_key = "major")
// As MetaTable3 ON  MetaTable.profileID = MetaTable3.post_id

// -- This section of code getst the event ID and subsequent info that depends on that ID
// INNER JOIN
//     (SELECT REPLACE(slug, "event-", "") AS eventID, object_id
//         FROM wp_term_relationships
//         INNER JOIN wp_terms
//         ON wp_term_relationships.term_taxonomy_id = wp_terms.term_id
//         WHERE  term_taxonomy_id != 5) AS EventIDTable
// ON PostsTable.reflectionID  = EventIDTable.object_id
// INNER JOIN
//     (SELECT post_title as eventTitle, ID FROM wp_posts) AS EventTitleTable
// ON EventIDTable.eventID = EventTitleTable.ID
// INNER JOIN
//     (SELECT meta_value as eventHours, post_id FROM wp_postmeta WHERE meta_key = "_ecp_custom_2") AS EventHoursTable
// ON EventIDTable.eventID = EventHoursTable.post_id'

//             , OBJECT );
//         return $results;
//     }
// }



class SqlInterface {
    function __construct(){
        global $wpdb;
        $this->db = $wpdb;
    }

    function getOptions(){
        $results = $this->db->get_results(
    'SELECT reflectionID,  reflectionContent, postDate, EmailTable.userEmail, eventID, eventTitle, eventHours, profileID, userCohort, userMajor
FROM
    (SELECT ID as reflectionID, post_content as reflectionContent, post_date as postDate FROM wp_24727_posts WHERE post_type= "post") AS PostsTable
INNER JOIN
    (SELECT post_id, meta_value as userEmail FROM wp_24727_postmeta WHERE meta_key= "userEmail") AS EmailTable
ON PostsTable.reflectionID = EmailTable.post_id
-- Do a LEFT JOIN here because we are going to have fewer
LEFT JOIN
(
    SELECT profileID , userEmail FROM wp_24727_posts
    INNER JOIN
        ( SELECT meta_value as userEmail, post_id as profileID FROM wp_24727_postmeta WHERE meta_key = "userEmail") AS metaTable1
        ON wp_24727_posts.ID =  metaTable1.profileID WHERE post_type = "profile"
) As MetaTable ON  EmailTable.userEmail = MetaTable.userEmail

LEFT JOIN
( SELECT meta_value as userCohort, post_id FROM wp_24727_postmeta WHERE meta_key = "cohort")
As MetaTable2 ON  MetaTable.profileID = MetaTable2.post_id

LEFT JOIN
( SELECT meta_value as userMajor, post_id FROM wp_24727_postmeta WHERE meta_key = "major")
As MetaTable3 ON  MetaTable.profileID = MetaTable3.post_id

-- This section of code gets the event ID and subsequent info that depends on that ID
INNER JOIN
    (SELECT REPLACE(slug, "event-", "") AS eventID, object_id
        FROM wp_24727_term_relationships
        INNER JOIN wp_24727_terms
        ON wp_24727_term_relationships.term_taxonomy_id = wp_24727_terms.term_id
        WHERE  term_taxonomy_id != 5) AS EventIDTable
ON PostsTable.reflectionID  = EventIDTable.object_id
INNER JOIN
    (SELECT post_title as eventTitle, ID FROM wp_24727_posts) AS EventTitleTable
ON EventIDTable.eventID = EventTitleTable.ID
INNER JOIN
    (SELECT meta_value as eventHours, post_id FROM wp_24727_postmeta WHERE meta_key = "_ecp_custom_2") AS EventHoursTable
ON EventIDTable.eventID = EventHoursTable.post_id'

            , OBJECT );
        return $results;
    }
}



