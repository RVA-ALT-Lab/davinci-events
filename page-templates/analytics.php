<?php
/**
 * Template Name: Analytics
 *
 * Template to see all student data - only available to admin
 *
 * @package understrap
 */
$html = file_get_contents(get_stylesheet_directory() . '/davinci-analytics/dist/index.html');
$dir = get_stylesheet_directory_uri() . '/davinci-analytics/dist/static';
$clean = str_replace('/static', $dir, $html);

echo $clean;


wp_footer();

?>