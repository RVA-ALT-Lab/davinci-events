<?php
/**
 * Template Name: Require Login
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="full-width-page-wrapper">

  <div class="<?php echo esc_html( $container ); ?>" id="content">

    <div class="row">

      <div class="col-md-12 content-area" id="primary">

        <main class="site-main" id="main" role="main">

          <?php if(is_user_logged_in() && current_user_can('edit_posts') ): ?>
          <?php while ( have_posts() ) : the_post(); ?>
            <h1 class="entry-title"><?php the_title(); ?>  </h1>
            <?php the_content();?>
          <?php endwhile; // end of the loop. ?>
       <?php else: ?>
            <p>You must be logged in to access this functionality</p>
            <?php
                    $args = array(
                            'echo' => true,
                            'redirect' => site_url( $_SERVER['REQUEST_URI'] ), 
                            'form_id' => 'loginform',
                            'label_username' => __( 'Username' ),
                            'label_password' => __( 'Password' ),
                            'label_remember' => __( 'Remember Me' ),
                            'label_log_in' => __( 'Log In' ),
                            'id_username' => 'user_login',
                            'id_password' => 'user_pass',
                            'id_remember' => 'rememberme',
                            'id_submit' => 'wp-submit',
                            'remember' => true,
                            'value_username' => NULL,
                            'value_remember' => false );

                    wp_login_form( $args );

             ?>  
       <?php endif; ?> 
        </main><!-- #main -->

      </div><!-- #primary -->

    </div><!-- .row end -->

  </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>



