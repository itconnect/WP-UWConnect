<?php
define( 'DONOTCACHEPAGE', True );
get_header();
global $wp_query;
$term = $wp_query->queried_object;
/*query_posts(
  array_merge(
    $wp_query->query,
    array(
    'order' => 'ASC',
    'orderby'=>'title',
    'posts_per_page' => -1,
    )
  )
);
*/


$args = array_merge($wp_query->query,
	array(
              'posts_per_page' => -1,
              'orderby' => 'title',
              'order' => 'ASC',
));
$posts_query = new WP_Query($args);


?>
<?php get_template_part( 'header', 'image' ); ?>

<div class="container uw-body">

  <div class="row">

    <div class="hero-container">

      <?php uw_site_title(); ?>
      <span class='udub-slant'><span></span></span>
      <div class='uw-site-tagline' >Your connection to information technology at the UW</div>

      <div class="hero-search">
        <form role="search" method="get" id="searchform" class="searchform" action="https://itconnect.uw.edu/">
          <div>
            <label class="screen-reader-text" for="s">Search IT Connect:</label>
            <input type="text" value="" name="s" id="s" placeholder="Search IT Connect:" autocomplete="off">
            <button type="submit" aria-label="Submit search" class="hero-search-submit"></button>
          </div>
        </form>
      </div>

    </div>

    <!-- Moved message -->

        <div class="row show-grid">
          
          <div class="col-md-12" style="padding: 20px 0 !important;">

            <div class="row show-grid">

              <div class="col-md-6" style="padding: 0 !important;">
                
                <h1 style="font-size: 33px;">The UW-IT Service Catalog has moved.</h1>
                <p style="margin-top: 25px;">The UW-IT Service Catalog has moved to a new location. Please update your links and bookmarks to point to:<br /><b><a href="https://uw.service-now.com/sp?id=sc_home">https://uw.service-now.com/sp?id=sc_home</a></b>
                  <br />
                <a class="uw-btn" style="margin-top: 45px;" href="https://uw.service-now.com/sp?id=sc_home">Go to the UW-IT Service Catalog</a></p>
              
              </div>

              <div class="col-md-5 col-md-offset-1" style="margin-left: 40px !important;">

                <div class="woof" style="background: url( <?php echo get_template_directory_uri() . '/assets/images/404.jpg' ?>) center center no-repeat; background-size: 100%; height: 300px"></div>
                
              </div>

            </div>

          </div>
        </div>

<!-- End Moved Message -->

  </div>

</div>

<?php get_footer(); ?>
