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
    <?php        
      $total_hours = 0; 
      $authors = [];
      $args = array(
        'blog_id'      => $GLOBALS['blog_id'],
        'role'         => 'author',
        'orderby' => 'display_name',

       ); 
       $the_users = get_users( $args ); 
       foreach ( $the_users as $author ) {
         $authors[$author->user_email] = array(
            'userEmail' => $author->user_email, 
            'profile' => [], 
            'reflections' => [], 
            'total_hours' => 0

          ); 
       }
       
       //Here we have a list of the authors email addresses
       //Now that we have this, we can get all of the reflections posts and append them to an array of reflections 
       //for each person, then we can go get all of the profiles post types and link those up to each authors email
       //At some point, we will need to loop through the invidiual reflections for each person and count them up, as well as add in some global variable stuff to collect the total hours for the group 

       //It may also be helpful to wrap all of this up in some fashion and spit it out as JSON, or at the very least 
       //create a separate data structure that we can then use to filter/visualize and pull additional insights from the data
       

          $args = array(
            'posts_per_page'   => -1,
            'post_type'   => 'post',  
            'category_name' => 'reflection', 
          );

          // query
          $the_query = new WP_Query( $args );
          if( $the_query->have_posts() ){

              while ( $the_query->have_posts() ){
                $the_query->the_post();
                $userEmail = get_post_meta(get_the_ID(), 'userEmail', true); 
                $hours = get_post_meta(get_the_ID(), 'hours', true);
                $title = get_the_title();  
                
                $reflection = array(
                  'userEmail' => $userEmail, 
                  'hours' => $hours, 
                  'title' => $title 

                  ); 

                if($authors[$userEmail]['reflections'] !== null){
                  array_push($authors[$userEmail]['reflections'], $reflection); 
                  $authors[$userEmail]['total_hours'] += $hours; 
                  $total_hours += $hours; 
                } else {
                  //If we are hitting this, it means likely their profile is not complete or 
                  //some other piece of info is missing
                  $authors[$userEmail]['userEmail'] = $userEmail;
                  $authors[$userEmail]['reflections'] = [];  
                  array_push($authors[$userEmail]['reflections'], $reflection); 
                  $authors[$userEmail]['total_hours'] += $hours; 
                  $total_hours += $hours; 
                }
                //add reflections  
              }
          }

           wp_reset_query();

          

          $profileArgs = array(
            'posts_per_page'   => -1,
            'post_type'   => 'profile',  
          );

          // query
          $profile_query = new WP_Query( $profileArgs );
          if( $profile_query->have_posts() ){

              while ( $profile_query->have_posts() ){
                $profile_query->the_post();

                $userEmail = get_post_meta(get_the_ID(), 'userEmail', true);
                $cohort = get_post_meta(get_the_ID(), 'cohort', true);
                $major = get_post_meta(get_the_ID(), 'major', true);
                $minor = get_post_meta(get_the_ID(), 'minor', true);
                $avatar = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail'); 


                $profile = array(
                    'cohort' => $cohort, 
                    'major' => $major, 
                    'minor' => $minor, 
                    'avatar' => $avatar
                  ); 

                if($authors[$userEmail]['profile'] !== null){
                  $authors[$userEmail]['profile'] = $profile;  
                } else {
                  $authors[$userEmail]['userEmail'] = $userEmail; 
                  $authors[$userEmail]['profile'] = $profile;  
                }


                //add profiles 
              }
          }

          wp_reset_query();

          ?>
<div class="container-fluid">
  <div class="container white">
    <div class="content">
      <div class="row nav">
       <div class="student-name">The Current Group: </div>
       <div class="display-total">
        <div id="totalHours"><?php echo $total_hours; ?></div>
        <span class="label">hours total</span>
      </div>
    </div>

  </div>  
    

    <div class="row">  
      <div class="col-lg-12">
      <h2>Individual Students</h2>

      <div class="card-columns">
      <?php foreach($authors as $author): ?>
        <div class="card text-center">
          <div class="card-body">
          
              <?php $avatar = ($author['profile']['avatar'] !== null) ? $author['profile']['avatar'] : 'https://rampages.us/davinci-events/wp-content/uploads/sites/24727/2017/08/mystery-man-150x150.png'; ?> 

              <img src="<?php echo $avatar; ?>" class="reflection-item-image">
              <h3 class="card-title">  <?php echo $author['userEmail']; ?>   <span class="badge badge-primary"><?php echo $author['total_hours']; ?></span> </h3>

              <div class="card-text">
                <table class="table">
                <tr>
                    <th>Event</th>
                    <th>Hours</th>
                  </tr>
                <?php foreach ($author['reflections'] as $reflection): ?>
                  <tr>
                    <td><?php echo $reflection['title']; ?></td>
                    <td><?php echo $reflection['hours']; ?></td>
                  </tr>
                <?php endforeach; ?>
                </table>            
              </div>
          </div>
        </div>
      <?php endforeach; ?>
      </div>
      
      </div>
      </div>
        </div>
      </div>
    </div>    
  </div>
</div>



</div><!-- Wrapper end -->



<?php get_footer(); ?>
