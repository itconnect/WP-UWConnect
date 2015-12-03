<?php
define( 'DONOTCACHEPAGE', True );
get_header();
$args = array('post_type' => 'service',
              'posts_per_page' => -1,
              'post_status' => 'publish',
              'orderby' => 'title',
              'order' => 'ASC',
);
$posts_query = new WP_Query($args);

?>
<?php get_template_part( 'header', 'image' ); ?>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-<?php echo (($sidebar[0]!="on") ? "8" : "12" ) ?> 
         uw-content" role='main'>

      <?php uw_site_title(); ?><span class="udub-slant"><span></span></span><h3 class="uw-site-tagline" >Information technology tools and resources at the UW</h3>


      <?php uw_mobile_front_page_menu(); ?>

      <?php service_breadcrumbs(); ?>

      <div id='main_content' class="uw-body-copy" tabindex="-1">
                <h2>Services A-Z</h2>
                <ul class='service-list'>
                <?php
                if( $posts_query->have_posts() ) {
                  while ($posts_query->have_posts()) : $posts_query->the_post();
                    $id = $post->ID;
                    $shortdesc = get_post_meta($id, 'uwc-short-description', true);
                    $perm = get_post_permalink($id);
                    ?>
                    <a href="<?php echo $perm ?>" class='service-link'>
                    <li class='service'><?php the_title(); ?></a>
                      <ul class='service-short-desc'>
                        <li><?php echo $shortdesc ?></li>
                      </ul>
                    </li>
                  <?php 
                  endwhile;
                } ?>
                </ul>
                <?php if (current_user_can('edit_posts')) {
                    edit_post_link('Edit', '<p>', '</p>');
                } ?>
       </div> <!-- main_content -->
     </div> <!-- uw-content -->
     <div id='sidebar' role='navigation' aria-label='Sidebar Menu'>
          <?php dynamic_sidebar('Service-Catalog-Sidebar'); ?>
     </div> <!-- #sidebar -->
    </div> <!-- row -->
  </div> <!-- uw-body -->
<?php get_footer(); ?>
