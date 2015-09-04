<?php
get_header();
global $wp_query;
$term = $wp_query->queried_object;
query_posts(
  array_merge(
    $wp_query->query,
    array(
    'order' => 'ASC',
    'orderby'=>'title',
    'posts_per_page'=>-1,
    )
  )
);
?>
<?php get_template_part( 'header', 'image' ); ?>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-<?php echo (($sidebar[0]!="on") ? "8" : "12" ) ?>
         uw-content" role='main'>

      <?php uw_site_title(); ?>

      <?php uw_mobile_front_page_menu(); ?>

      <?php service_breadcrumbs(); ?>

      <div id='main_content' class="uw-body-copy" tabindex="-1">

                <h2>Top Services for <?php echo $term->name; ?></h2>
                <ul class='service-list'>
                <?php while (have_posts()) : the_post();
                global $post;
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
                <?php endwhile; ?>
                </ul>
       </div> <!-- main_content -->
     </div> <!-- uw-content -->
     <div id='sidebar' role='navigation' aria-label='Sidebar Menu'>
          <?php dynamic_sidebar('Service-Catalog-Sidebar'); ?>
     </div> <!-- #sidebar -->
    </div> <!-- row -->
  </div> <!-- uw-body -->
<?php get_footer(); ?>
