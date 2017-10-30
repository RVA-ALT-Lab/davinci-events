<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version  4.3
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();
$event_start_date = tribe_get_start_date($event_id, true);

$days_to_keep_open = tribe_get_custom_fields()['Days to Keep Open:'];
$multiplier = 5;

switch($days_to_keep_open){
	case '7':
		$multiplier = 7;
		break;
	case '10':
		$multiplier = 10;
		break;
	case '15':
		$multiplier = 15;
		break;
	case 'Indefinite':
		$multiplier = 365;
		break;
	default:
		$multiplier = 5;

}
//Do all of the stuff related to the dates here
// There is some odd GMT stuff going on that may have to do with the
// 1. Timezone settings in PHP
// 2. Timezone of the server
// 3. Some of the default settings of WP or Events Plugin
// This seems to work however as we have the settings now

$year = date('Y');
$replacedDate = str_replace('@', $year, $event_start_date );
$one_day = 24 * 60 * 60;
$gmt_fix = 4 * 60 * 60;
$event_date = strtotime($replacedDate) + $gmt_fix;
$today = time() - $gmt_fix;
$future_cut_off_date = ($one_day * $multiplier);

?>

<div id="tribe-events-content" class="tribe-events-single">

	<p class="tribe-events-back">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '&laquo; ' . esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
	</p>

	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<?php the_title( '<h1 class="tribe-events-single-event-title">', '</h1>' ); ?>

	<div class="tribe-events-schedule tribe-clearfix">
		<?php echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?>
		<?php if ( tribe_get_cost() ) : ?>
			<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
		<?php endif; ?>
	</div>

	<!-- Event header -->
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
		<!-- .tribe-events-sub-nav -->
	</div>
	<!-- #tribe-events-header -->

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Event featured image, but exclude link -->
			<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</div> <!-- #post-x -->
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>


<!--
* This next section of code deals specifically with getting and rendering check-in
* data. We make a call for all of the check-ins that match a specific event ID, then query
* the profile post type to get the avatar (featured image) for each email found in the check-in
* query result. If the current user's email is found in the array of check-ins, they are
* presented with a different message and not the form
-->


			<!-- Wrap everything inside the check-in in an IF statement checking that the event hasn't occured yet -->


			<?php
			      //This is the query to get the list of event checkins from the list of posts


					  $is_user_going = false;
					  $userEmail = userEmail();

			          $check_in_args = array(
			            'posts_per_page'   => -1,
			            'post_type'   => 'check-in',
			            'meta_query' => array(
			                  array(
			                    'key' => 'eventID',
			                    'value' => $event_id,
			                  )
			             )
			          );

			          // query
			          $the_check_in_query = new WP_Query( $check_in_args );

			          $checkInArray = array();

			         if( $the_check_in_query->have_posts()){
			         	while ( $the_check_in_query->have_posts() ){
			         		$the_check_in_query->the_post();
			         		$check_in = array (
			         			'userEmail' => get_post_meta(get_the_ID(), 'userEmail', true),
			         			'profilePic' => ''
			         			);

			         		array_push($checkInArray, $check_in);

			         	}

			         }

			         wp_reset_query();

			         //Now that we have an array of checkins, we loop through that and get the assoicated profile info we need

			         foreach ($checkInArray as &$check_in ) {

			         	if (trim($check_in['userEmail']) == trim($userEmail) ){
			         		$is_user_going = true;
			         	}

			         	$profile_args = array(
				            'posts_per_page'   => 1,
				            'post_type'   => 'profile',
				            'meta_query' => array(
				                  array(
				                    'key' => 'userEmail',
				                    'value' => $check_in['userEmail'],
				                  )
				             )
				        );


				     $the_profile_query = new WP_Query( $profile_args );

			         if( $the_profile_query->have_posts()){

			         	while($the_profile_query->have_posts()){
			         		$the_profile_query->the_post();
			         		$check_in['profilePic'] = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
			         	}
			         }

			         wp_reset_query();

			         }


			?>


			  <h3>
				<?php
					$num_going = sizeof($checkInArray);
					$num_people = $num_going == 1 ? " Person is" : " People are";
					$tag_line = $num_going > 0 ? "Are You?" : "Be a Trend Setter.";
					$tag_line = $is_user_going ? "You're a part of the cool crowd." : $tag_line;
					echo $num_going . $num_people ." In. ". $tag_line;
			 	?>
			  </h3>

			  <div class="row student-checkins">
			  		<?php foreach($checkInArray as $checkIn): ?>
			  		<div class="col-md-3 reflection-thumb">
			                    <div class="col-md-12">
				                     <a class="reflection-item-title" ">
				                     	 <?php if ( $checkIn['profilePic']!== "" ){
				                     	 	printf ('<img class="reflection-item-image" src="%s">', $checkIn['profilePic']);
				                     	} else {
				                     		echo '<img class="reflection-item-image" src="https://rampages.us/davinci-events/wp-content/uploads/sites/24727/2017/08/mystery-man-150x150.png">';
				                     	}?>
				                     </a>
			                    </div>
			            </div>
			         <?php endforeach; ?>
			  </div>


			<!-- Add in date check here  -->
			<?php if(!$is_user_going && !($today >= $event_date) ): ?>

			<h3>Check-in</h3>

				<!-- Perform a check to see if user is logged in -->
				<?php if(!is_user_logged_in() || !is_user_member_of_blog(get_current_user_id()) ): ?>
					<p>You must be logged in to access that functionality. </p>

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

				<?php else: ?>
				<div id="check-in">
					<input type="hidden" name="check-in-event-id" id="check-in-event-id" value="<?php echo $event_id; ?>">
					<input type="hidden" name="check-in-event-start-date" id="check-in-event-start-date" value="<?php echo $event_start_date; ?>">
					<?php echo do_shortcode('[gravityform id="7" title="false" description="false"]');?>
				</div>

				<?php endif; ?>

			<?php endif; ?>


			<!-- Wrap Everything from here on down in an If statement checking to see if the
			Event Date is greater than the current date -->

			<?php if($today >= $event_date && !($today > ($event_date + $future_cut_off_date))): ?>


				<?php if(!is_user_logged_in()): ?>
					<p>You must be logged in to access that functionality. </p>

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

				<?php else: ?>


				<button type="button" class="btn btn-default reflect-button" aria-label="reflect on attenedance" id="student-log-button">
					<i class="fa fa-pencil" aria-hidden="true"></i>Reflect
				</button>
			    <div id="student-log">
						<?php echo do_shortcode('[gravityform id="4" title="false" description="false"]');?>
				</div>

				<?php endif; ?>



			<?php endif;?>


			<!--
			* This next portion of code loops through the list of reflections for the event
			* and gets the author's avatar from the profile post type
			*
			 -->
			<?php if($today >= $event_date): ?>


				<?php
					// Here we are getting a list of the posts tagged with the individual
					// event, then we are going to make separate queries to get each of the profile posts, add them to a new list, then render that list of avatars

					$reflectionArray = array();

					//Initial query for all reflections tagged
					$tag = 'event-'.$event_id;
			          // args
			          $args = array(
			            'numberposts' => -1,
			            'post_type'   => 'post',
			            'tag' => $tag,
			         );
			          // query
			         $the_query = new WP_Query( $args );

			         if($the_query->have_posts()){
			         	while($the_query->have_posts()){
			         		$the_query->the_post();

			         		$reflection = array(
			         			'userEmail' => get_post_meta(get_the_ID(), 'userEmail', true),
			         			'profilePic' => ''
			         			);

			         		array_push($reflectionArray, $reflection);


			         	}

			         }


			         wp_reset_query();


			         foreach ($reflectionArray as &$reflection) {
			         	$profile_args = array(
				            'posts_per_page'   => 1,
				            'post_type'   => 'profile',
				            'meta_query' => array(
				                  array(
				                    'key' => 'userEmail',
				                    'value' => $reflection['userEmail'],
				                  )
				             )
				        );


				     $the_profile_query = new WP_Query( $profile_args );

			         if( $the_profile_query->have_posts()){

			         	while($the_profile_query->have_posts()){
			         		$the_profile_query->the_post();
			         		$reflection['profilePic'] = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
			         	}
			         }

			         wp_reset_query();
			         }


				?>







			<div class="row student-reflections">
			   <div class="col-md-12"><h2>Submitted Reflections</h2></div>

			            <?php foreach($reflectionArray as $user): ?>

			            <div class="col-md-3 reflection-thumb">
			                    <div class="col-md-12">
				                     <a class="reflection-item-title">
				                     	 <?php if ($user['profilePic'] !== ""){
				                     	 printf('<img class="reflection-item-image" src="%s">', $user['profilePic']);
				                     	} else {
				                     		echo '<img class="reflection-item-image" src="https://rampages.us/davinci-events/wp-content/uploads/sites/24727/2017/08/mystery-man-150x150.png">';
				                     	}?>
				                     </a>
			                    </div>
			            </div>
			        <?php endforeach; ?>
			     </div>
			    <?php endif; ?>

	<?php endwhile; ?>
	<!-- Top Level While Statement for Tribe Events -->

	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
		<!-- .tribe-events-sub-nav -->
	</div>
	<!-- #tribe-events-footer -->

</div><!-- #tribe-events-content -->
