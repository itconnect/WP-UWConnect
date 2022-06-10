<?php
/**
 * The template for displaying Service Status page
 *
 */

define( 'DONOTCACHEPAGE', True ); 
require_once('status-functions.php');

get_header();

$sidebar = get_post_meta( $post->ID, 'sidebar' );

?>

<div class="container-fluid uw-body">
  <div class="row">

    <?php
    if ( ! isset( $sidebar[0] ) || 'on' !== $sidebar[0] ) {
      get_sidebar();
    }
    ?>

    <main id="primary" class="site-main uw-body-copy col-md-<?php echo ( ( ! isset( $sidebar[0] ) || 'on' !== $sidebar[0] ) ? '9' : '12' ); ?>">

      <?php //uw_mobile_front_page_menu(); ?>

      <?php //service_breadcrumbs(); ?>


      <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('service-status-page'); ?>>

          <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
          </header><!-- .entry-header -->
        
          <div class="entry-content">

            <p>This page shows active eOutages and High priority incidents for UW Seattle, Bothell, and Tacoma network and computing services managed by UW Information Technology.</p>
            <p>You may also <a href="/servicestatusfeeddesc">Subscribe to Service Status RSS Feeds</a>.</p>

            <?php 

              the_content();
              
              wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) );

                include_once(ABSPATH . 'wp-admin/includes/plugin.php');
                
                // prompt the user to log in and leave feedback if appropriate
                if (is_plugin_active('document-feedback/document-feedback.php') && !is_user_logged_in()): 
              ?>
                  <p id='feedback_prompt'>
                    <?php 
                      printf(__('<a href="%s">Log in</a> to leave feedback.'), wp_login_url( get_permalink() . '#document-feedback' ) ); 
                    ?>
                  </p>
              <?php 
                endif;
              ?>

          </div><!-- .entry-content -->

          <div id="noscript" class="alert">
            JavaScript is required to view this content. Please enable JavaScript and try again.
          </div>

          <div id="spinner" style="width:150px; margin:auto; display: none; text-align:center; line-height:100px;">
            <img src="<?php echo site_url('/wp-admin/images/loading.gif'); ?>" alt="Loading..." />
          </div>

          <div id="services"></div>
        
        </article><!-- #post-<?php the_ID(); ?> -->

      <?php endwhile; // end of the loop.  ?>

      <script>
        servicestatus();
      </script>

      <style type="text/css">
        .service-status-page h2 {
          font-size: 21px;
          font-weight: 600;
        }
      </style>

    </main><!-- #primary -->

    <?php
    if ( ! isset( $sidebar[0] ) || 'on' !== $sidebar[0] ) {
      get_template_part( 'template-parts/sidebar', 'mobile' );
    }
    ?>

  </div><!-- .row -->
</div><!-- .container -->

<?php
get_footer();

