<?php
/**
 * Template Name: All Users
 *
 * Template to see all student data - only available to admin 
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
  		 <div class="student-name">The Current Group: </div>
  		 <div class="display-total">
        <div id="totalHours"></div>
        <span class="label">hours total</span>
      </div>
    </div>
		<?php        
          // get the authors by id
      $authors = [];
      $args = array(
        'blog_id'      => $GLOBALS['blog_id'],
        'role'         => 'author',
       ); 
       $the_users = get_users( $args ); 
       foreach ( $the_users as $author ) {
         array_push($authors,$author->ID);
       }

          $args = array(
            'posts_per_page'   => -1,
            'post_type'   => 'post',  
            'category_name' => 'reflection', 
            'orderby' => 'author',  
            'order' => 'DESC',     
            'author__in' => $authors, //get just author level posts
          );

          // query
          $the_query = new WP_Query( $args );
          ?>
    </div>  
    
    <?php echo 'total hrs- ' . get_the_author_meta('totalHrs');?>

      <div class="row">  
      <div class="col-md-12"><h2>Events Attended</h2></div>
        <div class="col-md-3 event-list-header">Student</div>
        <div class="col-md-6 event-list-header">Event Title</div>
        <div class="col-md-3 event-list-header">Event Hours</div>
        <?php if( $the_query->have_posts() ): ?>
          <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="col-md-3 event-list-detail">
              <?php the_author_meta('user_email');?>
            </div>
            <div class="col-md-6 event-list-detail">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>
            <div class="col-md-3 event-list-detail">
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




<!--this way was updating a meta field on the user profile but if change hrs, delete post etc. things get messy-->
<?php $args = array(
    'blog_id'      => $GLOBALS['blog_id'],
    'role'         => 'author',
   ); 
  $the_users = get_users( $args ); 
  foreach ( $the_users as $author ) {
    //echo '<span>' .  $author->user_email  . '-' .  get_the_author_meta('totalHrs', $author->ID ) . '</span><br>';
  }
?>

<!--NOW TO PULL FROM GFORMs API-->
<?php
$form_id = '4';
$entry = GFAPI::get_entries( $form_id );
var_dump($entry);
?>

<!--End Top Content Section-->

<!--Main items Section-->


</div><!-- Wrapper end -->



<?php get_footer(); ?>
