<?php
get_header(); ?>
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

    <div class="col-md-<?php echo (($sidebar[0]!='on') ? '8' : '12' ) ?>
         uw-content" role='main'>

      <?php uw_mobile_front_page_menu(); ?>

      <?php service_breadcrumbs(); ?>

      <div id='main_content' class="uw-body-copy" tabindex="-1">
             <?php while (have_posts()) : the_post();
                global $post;
                $id = $post->ID;
                ?>
                <h1 class='entry-title'><?php the_title(); ?></h1>
                <?php if (get_post_meta($id, 'uwc-description', true)) { ?>
                  <div class='attr-wrap'>
                    <h2 class='service-attr'>Service Description</h2>
                    <div class='attr-text'><?php echo wpautop(get_post_meta($id, 'uwc-description', true)); ?></div>
                  </div>
                <?php } ?>
                <?php if (get_post_meta($id, 'uwc-options-text', true)) { ?>
                <div class='attr-wrap'>
                  <h2 class='service-attr'>Service Options</h2>
                  <div class='attr-text'><?php echo wpautop(get_post_meta($id, 'uwc-options-text', true)); ?></div>
                </div>
                <?php } ?>
                <?php if (get_post_meta($id, 'uwc-eligibility', true)) { ?>
                <div class='attr-wrap'>
                  <h2 class='service-attr'>Eligibility</h2>
                  <div class='attr-text'><?php echo wpautop(get_post_meta($id, 'uwc-eligibility', true)); ?></div>
                </div>
                <?php } ?>
                <?php if (get_post_meta($id, 'uwc-ordering', true)) { ?>
                <div class='attr-wrap'>
                  <h2 class='service-attr'>How to Order</h2>
                  <div class='attr-text'><?php echo wpautop(get_post_meta($id, 'uwc-ordering', true)); ?></div>
                </div>
                <?php } ?>
                <?php if (get_post_meta($id, 'uwc-availability', true)) { ?>
                <div class='attr-wrap'>
                  <h2 class='service-attr'>Availability</h2>
                  <div class='attr-text'><?php echo wpautop(get_post_meta($id, 'uwc-availability', true)); ?></div>
               </div>
                <?php } ?>
                <?php if (get_post_meta($id, 'uwc-price', true)) { ?>
                <div class='attr-wrap'>
                  <h2 class='service-attr'>Price</h2>
                  <div class='attr-text'><?php echo wpautop(get_post_meta($id, 'uwc-price', true)); ?></div>
                </div>
                <?php } ?>
                <?php if (get_post_meta($id, 'uwc-level-descr', true)) { ?>
                <div class='attr-wrap'>
                  <h2 class='service-attr'>Service Level Description</h2>
                  <div class='attr-text'><?php echo wpautop(get_post_meta($id, 'uwc-level-descr', true)); ?></div>
                </div>
                <?php } ?>
                <?php if (get_post_meta($id, 'uwc-additional-info', true)) { ?>
                <div class='attr-wrap'>
                  <h2 class='service-attr'>Additional Information</h2>
                  <div class='attr-text'><?php echo wpautop(get_post_meta($id, 'uwc-additional-info', true)); ?></div>
                </div>
                <?php } ?>
                <?php if (get_post_meta($id, 'uwc-support-info', true)) { ?>
                <div class='attr-wrap'>
                  <h2 class='service-attr'>Support Information</h2>
                  <div class='attr-text'><?php echo wpautop(get_post_meta($id, 'uwc-support-info', true)); ?></div>
                </div>
                <?php } ?>
                <?php if (get_post_meta($id, 'uwc-customer-ref', true)) { ?>
                <div class='attr-wrap'>
                  <h2 class='service-attr'>Contact for More Information</h2>
                  <div class='attr-text'><?php echo wpautop(get_post_meta($id, 'uwc-customer-ref', true)); ?></div>
                </div>
                <?php } ?>
                <?php if (get_post_meta($id, 'uwc-last-review', true)) { ?>
                <hr id="fold" />
                <div class='superattr-wrap'>
                  <h2 class='service-attr belowf'>Maintenance</h2>
                  <div class='subattr-wrap'>
                    <p class='attr-text'>Last Review Date: <?php echo get_post_meta($id, 'uwc-last-review', true); ?></p>
                  </div>
                </div>
                <?php if (current_user_can('edit_posts')) {
                    edit_post_link('Edit', '<p>', '</p>');
                } ?>
                <?php } ?>
                <?php endwhile; ?>
       </div> <!-- main_content -->
     </div> <!-- uw-content -->
     <div id='sidebar' role='navigation' aria-label='Sidebar Menu'>
          <?php dynamic_sidebar('Service-Catalog-Sidebar'); ?>
     </div> <!-- #sidebar -->
    </div> <!-- row -->
  </div> <!-- uw-body -->
<?php get_footer(); ?>


