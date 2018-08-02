<?php get_header(); ?>

<?php get_template_part( 'header', 'image' ); ?>

<div class="container uw-body">

  <div class="row">

    <div class="hero-container">

      <?php uw_site_title(); ?>
      <span class='udub-slant'><span></span></span>
      <div class='uw-site-tagline' >Information technology tools and resources at the UW</div>

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

    <div class="col-md-<?php echo (($sidebar[0]!="on") ? "8" : "12" ) ?> 
         uw-content" role='main'>

      <?php uw_mobile_front_page_menu(); ?>
      
      <?php service_breadcrumbs(); ?>

      <div id='main_content' class="uw-body-copy" tabindex="-1">

                <?php while (have_posts()) : the_post();
                global $post;
                $title = $post->post_title;
                ?>
                <h2><?php echo $title ?></h2>
                <?php the_content(); ?>
                <?php endwhile; ?>
                <?php if (current_user_can('edit_posts')) {
                    edit_post_link('Edit', '<p>', '</p>');
                } ?>
     </div> <!-- main_content -->

    </div> <!-- uw-content -->

    <div id="sidebar">
      <?php dynamic_sidebar('Service-Catalog-Sidebar'); ?>
    </div>

  </div>

</div>

<?php get_footer(); ?>
