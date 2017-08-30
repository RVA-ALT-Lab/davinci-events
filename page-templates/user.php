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
<!-- {Your VCU Email Address:8}{Post Custom Field:9} -->
<?php 
      //This is the query to get the users profile information
      $user = wp_get_current_user();       
        $email = $user->user_email;

          $profile_args = array(
            'posts_per_page'   => 1,
            'post_type'   => 'profile',       
            'meta_query' => array(
                  array(
                    'key' => 'userEmail',
                    'value' => $email,
                  )
             )
          );

          // query
          $the_profile_query = new WP_Query( $profile_args );
?>



<div class="container-fluid">
  <div class="container white">
    <div class="content">
      <div class="row nav">
        <img src="">      
        <div class="student-name"><?php echo userName();?></div>
        <div class="display-total">
            <div id="totalHours"></div>
            <span class="label">hours total</span>
        </div>
      </div>
      <div class="row">
      <div class="col-md-12">

    <?php if( $the_profile_query->have_posts() ): ?>
          <?php while ( $the_profile_query->have_posts() ) : $the_profile_query->the_post(); ?>
          
          <br>
          <br>
          <div class="row student-profile">
            <div class="col-lg-3 col-md-3">
              <?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array('class' => 'reflection-item-image') ); ?>
            </div>
            <div class="col-lg-9 col-md-9">
              <table class="table">
                <tr>
                  <td>Cohort</td>
                  <td>
                    <?php echo get_post_meta(get_the_ID(), 'cohort', true);  ?>
                  </td>
                </tr>
                <tr>
                  <td>Major</td>
                  <td>
                    <?php echo get_post_meta(get_the_ID(), 'major', true);  ?>
                  </td>
                </tr>
                <tr>
                  <td>Minor</td>
                  <td>
                    <?php echo get_post_meta(get_the_ID(), 'minor', true);  ?>
                  </td>
                </tr>
                <tr>
                  <td>Bio</td>
                  <td>
                    <?php echo get_post_meta(get_the_ID(), 'bio', true);  ?>
                  </td>
                </tr>
              </table> 
            </div>
          </div> 
            
          <?php endwhile; ?>
        <?php else: ?>
          <br>
          <div class="alert alert-info" role="alert">
            <p><strong>Oh snap!</strong> 😉 It looks like you don't have a profile yet, you should fill one out now.</p>
            <a class="btn btn-primary" href="davinci-events/add-profile">Add Profile</a>
          </div>
    <?php endif; ?>

    <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>




    <?php  
        //This is the query to get the reflections submitted by the user
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
      <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>  
  <!-- End Student Profile and Header Content -->
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
