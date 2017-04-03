<?php define( 'DONOTCACHEPAGE', True ); ?>
<?php require_once('status-functions.php');
	get_header(); ?>
   <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'header', 'image' ); ?>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-<?php echo (($sidebar[0]!='on') ? '8' : '12' ) ?>
         uw-content" role='main'>

      <?php uw_site_title(); ?><span class="udub-slant"><span></span></span><h3 class="uw-site-tagline" >Information technology tools and resources at the UW</h3>


      <?php uw_mobile_front_page_menu(); ?>

      <?php service_breadcrumbs(); ?>


	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
   		<h1 class="entry-title hidden-phone">Change Calendar</h1>
		</header><!-- .entry-header -->

		<div class="entry-content">

	<?php endwhile; // end of the loop.  ?>
 <!--   <div id='sidebar' role='navigation' aria-label='Sidebar Menu'>
          <?php dynamic_sidebar('Service-Catalog-Sidebar'); ?>
    </div> <!-- #sidebar -->
   
   <!--   <div class="push"></div>
  </div> -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/fullcalendar.min.css"/>
<!-- <script language="JavaScript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
-->

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
-->
<script language="JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script language="JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/fullcalendar.min.js"></script>
<script>

    $(document).ready(function() {

        $('#calendar').fullCalendar({
            theme: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listMonth'
            },
            navLinks: true, // can click day/week names to navigate views
            eventLimit: true, // allow "more" link when too many events
             events: '/wp-content/plugins/WP-UWConnect/caldata.php'

});

    });

</script>



    <div id='calendar'></div> 
     
</div>     
</div>     
     
     <!-- uw-content -->
    </div> <!-- row -->
  </div> <!-- uw-body -->
<?php get_footer(); ?>

