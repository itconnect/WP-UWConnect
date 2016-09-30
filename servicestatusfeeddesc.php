<script language="JavaScript">
function makeURL(type) {
var myURL = document.URL;
myURL = myURL.replace('http:','https:');
if (type == 'eoutage') { myURL = myURL.replace('desc','/eoutage'); }
else if (type == 'incidents') { myURL = myURL.replace('desc','/incidents'); }
else { myURL = myURL.replace('desc',''); }


//document.getElementById('feedURL').style.cssText = "border: 1px; font-size: bigger;";

document.getElementById('feedURL').style.display="block";
document.getElementById('feedURL').style.cssText="color:green;border-top: solid black;border-right: solid black;border-left: solid black;border-bottom: solid black;padding: 10px;border-radius: 10px;font-size: 125%;text-align:center;";
document.getElementById('feedURL').innerHTML = "Your UW-IT Service Status RSS Feed URL is:<br>"+myURL ;



}

</script>

<style>
.first-icon { display: none; }
.second-icon {display: none; }

<?	get_header(); ?>



   <?php get_template_part( 'header', 'image' ); ?>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-<?php echo (($sidebar[0]!='on') ? '8' : '12' ) ?>
         uw-content" role='main'>

      <?php uw_site_title(); ?><span class="udub-slant"><span></span></span><h3 class="uw-site-tagline" >Information technology tools and resources at the UW</h3>


      <?php uw_mobile_front_page_menu(); ?>

      <?php service_breadcrumbs(); ?>


   		<h1 class="entry-title hidden-phone">Service Status RSS Feed</h1>

		<div class="entry-content">
	UW-IT syndicates <strong>current</strong> eOutage and High Priority Incident information as an RSS feed. To generate the subscription URL, select the kind of status updates you would like to subscribe to:
<p><p>
<form name="feedOptions" action="#" id="feedOptions">
<input type="radio" name="feedOption" value="eoutage" onClick="makeURL('eoutage');"/> eOuatges<br>
<input type="radio" name="feedOption" value="incidents" onClick="makeURL('incidents');"/> High Priority Incidents<br>
<input type="radio" name="feedOption" value="eoutage" onClick="makeURL('all');"/> Both<br>
</form>
<div id="feedURL" style="display: none;"></div>

</div>
				</div><!-- .entry-content -->
    <div id='sidebar' role='navigation' aria-label='Sidebar Menu'>
          <?php dynamic_sidebar('Service-Catalog-Sidebar'); ?>
    </div> <!-- #sidebar -->
  
<!-- #wrap -->
     <!-- uw-content -->
    </div> <!-- row -->
  </div> <!-- uw-body -->
<?php get_footer(); ?>

