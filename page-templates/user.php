<?php
/**
 * Template Name: User
 *
 * Template to see student data
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>
<div id="home-wrapper">
	<div class="container" id="home-content">
	<!--Top logo Section-->
	  <div class="top-logo-area">
	    <div class="row home-page">	  
	     
	        <?php while ( have_posts() ) : the_post(); ?>
				<?php the_content();?>
	        <?php endwhile; // end of the loop. ?>
	    </div>
	  </div>
	</div>
</div>
<!--End Top logo Section-->

<div class="container-fluid">
  <div class="container white">
    <div class="content">
      <div class="row nav">
  		 <div class="student-name"><?php echo userName();?></div>
  		 <div class="display-total">
        <div id="totalHours"></div>
        <span class="label">hours total</span>
      </div>
    </div>
		<?php  
        $user = wp_get_current_user();       
        $email = $user->user_email;
          // args

          $args = array(
            'posts_per_page'   => -1,
            'post_type'   => 'post',
            'category_name' => 'reflection',        
           'meta_query' => array(
				array(
					'key' => 'userEmail',
					'value' => $email,
				)
			)
            
          );

          // query
          $the_query = new WP_Query( $args );
          ?>
    </div>  
      <div class="student-events row">  
      <div class="col-md-12"><h2>Events Attended</h2></div>
        <div class="col-md-8 event-list-header">Event Title</div>
        <div class="col-md-4 event-list-header">Event Hours</div>
        <?php if( $the_query->have_posts() ): ?>
          <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="col-md-8 event-list-detail">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>
            <div class="col-md-4 event-list-detail">
              <span class="list-event-hours"><?php echo 'hours: <span class="hours-data">' .theHours(get_the_ID()) . '</span>';?> 
            </div>  
            
          <?php endwhile; ?>
        <?php endif; ?>

          <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
      </div>
        </div>
      </div>
    </div>    
  </div>
</div>
<!--End Top Content Section-->

<!--Main items Section-->


</div><!-- Wrapper end -->



<?php get_footer(); ?>
