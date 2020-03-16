<?php define( 'DONOTCACHEPAGE', True ); ?>
<?php require_once('status-functions.php');
	get_header(); ?>
   <?php while ( have_posts() ) : the_post(); ?>

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
<!--
    <div class="col-md-<?php echo (($sidebar[0]!='on') ? '8' : '12' ) ?>
         uw-content" role='main'>
-->
 <div class="col-md-12 uw-content" role='main'>

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
            nextDayThreshold: '00:00:00',
            height: 'auto',
            navLinks: true, // can click day/week names to navigate views
            eventLimit: 4, // allow "more" link when too many events
            events:{
                url: '/wp-content/plugins/WP-UWConnect/caldata.php',
                cache: true
            },
	    loading: function( isLoading) {
              if(isLoading) {// isLoading gives boolean value
                        $('#wait').show();
                         $('#calendar').hide();
                              } else {
                                        $('#wait').hide();
                                         $('#calendar').show();
                                              }
                                                },
	    eventClick: function(event) {
            if (event.url) {
                    window.open(event.url, "_blank");
                            return false;
                                }
                                }
});

    });

</script>
<style>
#wait {
    display: flex;
      //align-items: center;
        justify-content: center ;

}
.loadheader {  color:  #4b2e83; position: absolute; margin-bottom: 100px;}
.loader {
 margin-top: 50px;
 position: relative;
  border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #4b2e83; /* UW Purple */
      border-radius: 50%;
        width: 120px;
          height: 120px;
            animation: spin 2s linear infinite;
            }

            @keyframes spin {
              0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
                }


.fc-event-time, .fc-event-title {
padding: 0 1px;
white-space: nowrap;
}

.fc-title {
white-space: normal;

}
</style>
<div id="wait"><div class="loadheader"><strong>Loading changes...</strong><br></div>
<div class="loader"></div>
</div>

    <div id='calendar' height='auto'></div>
    <!-- width='900px' height='1000px'></div> -->
    <br>
    <strong>Legend:</strong><p>
    <table style='border: none; border-width: none; background-color: white' border='0' >
    <tr style="background-color: white; border: none">
    <td style="margin: 5px; background-color: white; border: none"><span style="color: white; background-color: blue; padding: 10px;">Comprehensive Changes</span></td>
    <td style="background-color: white; border: none"><span style="color: white;background-color: red;padding: 10px;">Emergency Changes</span></td>
    <td style="background-color: white; border: none"><span style="color: white;background-color: black;padding: 10px;">Make No Changes</span></td>
    <td style="background-color: white; border: none"><span style="color: white;background-color: #85754D;padding: 10px;">Start of Quarter/Term</span></td></tr></table>    <p>

    <h2>What information is on the Change Calendar?</h2><p>
     The Change Calendar lists UW-IT's comprehensive and emergency changes in UW Connect approved by various Change Advisory Boards (CABs). It also lists the "Make No Changes" days at the start of the quarter and any additional days approved by the UW-IT Enterprise change advisory board. The colors for the changes have no distinction; they're just there to separate multiple events on a day. Make No Changes days are always in black.
<br>
Some examples of the approved changes include:
<br><ul>
<li>Planned network equipment software updates (ITI CAB)</li>
<li>Changes to UW Connect (ITSM CAB)</li>
<li>Work being done in data centers (ITI CAB)</li>
<li>Azure changes (Azure Active Directory CAB)</li></ul><p>
<h2>Who do I ask if I don't know whether the entry should go on the Change Calendar?</h2><p>
                    Send an email to <script type="text/javascript">
                      document.write("<a href=\"mail" + "to:" + new Array("help","uw.edu").join("@") + "\">" + "help@uw.edu" + "</" + "a>");
                      </script>, attention "Change Management."<p>
<h2>If the activity is not appropriate for the Change Calendar, are there other procedures that I should follow?</h2><p>
                    There are other ways to communicate scheduled activities. Some examples include the "work in area" (<script type="text/javascript">
                                          document.write("<a href=\"mail" + "to:" + new Array("wia"                                          ,"uw.edu").join("@") + "\">" + "wia@uw.edu" + "</" + "a>");</script>) and "outages" (<script type="text/javascript"> document.write("<a href=\"mail" + "to:" + new Array("outages"                                          ,"uw.edu").join("@") + "\">" + "outages@uw.edu" + "</" + "a>");</script>) lists</a>. You should work with your team to determine all of the appropriate steps necessary to communicate your activity.
<p>
<h2>I'm trying to add an entry and I'm not authorized. How do I get permission to add?</h2><p>
                    To request access contact <script type="text/javascript">
                      document.write("<a href=\"mail" + "to:" + new Array("help","uw.edu").join("@") + "\">" + "help@uw.edu" + "</" + "a>");
                      </script>, attention "Change Management."<p>
<h2>What does "Make No Changes" mean?</h2><p>
                    To ensure quality service for students, faculty, and administrative staff during days marked with "Make No Changes," the following applies:<br><ul>
<li>Make no changes to production services</li>
<li>Ensure full support coverage</li>
<li>Perform extra monitoring</li>
<li>Have a fallback / load contingency plan</li></ul><p>
The peak load on UW Information Technology's computing and networking infrastructure typically occurs on the first day of the quarter, so the stability of all infrastructure components is critical. To minimize the chance of introducing a problem, no changes should be made to production equipment and services.
<p>
If an emergency change is needed, an exception can be made with the approval of the Vice President for UW Information Technology or a division leader through use of an emergency change submitted to the UW-IT Enterprise change advisory board. Please run your change through your change advisory board first for initial approval. The change board managers should understand the risk of the change to the production services they manage. If there is a high or medium risk change that should be escalated to the UW-IT Enterprise CAB. Low risk, and routine changes should be handled by first level change advisory boards.<p>
For more information about Change Management, including how to submit your change, visit the <a href="https://wiki.cac.washington.edu/display/smportal/Change+Control" target="_new">Change Management Wiki</a>.
                                     


</div>     
</div>     
     
     <!-- uw-content -->
    </div> <!-- row -->
  </div> <!-- uw-body -->
<?php get_footer(); ?>

