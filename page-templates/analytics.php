<?php
/**
 * Template Name: Analytics
 *
 * Template to see all student data - only available to admin
 *
 * @package understrap
 */

if (current_user_can('list_users')){
    $html = file_get_contents(get_stylesheet_directory() . '/davinci-analytics/dist/index.html');
    $dir = get_stylesheet_directory_uri() . '/davinci-analytics/dist/static';
    $clean = str_replace('/static', $dir, $html);

    echo $clean;
} else {
    echo '<div class="alert alert-info" role="alert">
    <p><strong>Oh snap!</strong> 😉 It looks like you don\'t have permission to view this page.</p>
  </div>';
}

wp_footer();

?>