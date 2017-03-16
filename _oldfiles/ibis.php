<?php
//XMLXSL Transformation class
require_once('includes/MM_XSLTransform/MM_XSLTransform.class.php'); 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" lang="en"/>
<title>Birmingham Airport | Hotels > Ibis</title>
<meta name="description" content="Book a Room at the Ibis at Birmingham Airport. Details, reviews and rates." />
<link href="/bhxv2.css" rel="stylesheet" type="text/css" />


<!-- Yelp Hilton Review Script -->
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script>
function showData(data) {
    $.each(data.businesses, function(i,business){
        // extra loop
        $.each(business.reviews, function(i,review){ 
            var content = '<p>' + review.text_excerpt + '<a href="' + review.url +'">Read more...</a></p>';
			content += 'Rating - <img src="' + business.rating_img_url + '" />';
			content += '<p>Date Added - ' + review.date + ' by ' + review.user_name + '</p>';

            $(content).appendTo('#review');
        });
    });      
}


$(document).ready(function(){
    // note the use of the "callback" parameter
    writeScriptTag( "http://api.yelp.com/business_review_search?"+
    "term=ibis"+
    "&location=B26%203QJ"+
    "&ywsid=lOoGGbkYpVmTvxHlWGT2Lw"+
    "&callback=showData"); // <- callback
});

function writeScriptTag(path) {
    var fileref = document.createElement('script');
    fileref.setAttribute("type","text/javascript");
    fileref.setAttribute("src", path);

    document.body.appendChild(fileref);
}
</script>



<script type="text/javascript">     (function(p,u,s,h){         p._pcq=p._pcq||[];         p._pcq.push(['_currentTime',Date.now()]);         s=u.createElement('script');         s.type='text/javascript';         s.async=true;         s.src='https://cdn.pushcrew.com/js/863d9221c6830718a8b1c4642c80b88c.js';         h=u.getElementsByTagName('script')[0];         h.parentNode.insertBefore(s,h);     })(window,document); </script></head>

<body>


<!-- Start Wrapper -->
<div id="wrapper">
<div id="masthead">
<!-- Start Logo Image -->
<div id="logo_image">
<!-- End Logo Image --></div>
<div id="top_banner"><script type="text/javascript">
var uri = 'http://impgb.tradedoubler.com/imp?type(js)pool(342687)a(1683084)' + new String (Math.random()).substring (2, 11);
document.write('<sc'+'ript type="text/javascript" src="'+uri+'" charset="ISO-8859-1"></sc'+'ript>');
</script></div>
</div>



<!-- Start Header -->
<div id="Header"><div id="image_credits"><p>Image by Kossy@FINEDAYS on <a href="http://www.flickr.com/photos/kossy/354401232/">Flickr</a><img src="/images/by3px.png" alt="Creative Commons"/><img src="/images/cc3px.png" alt="Attribution"/></p>
</div>



</div><!-- End Header -->

<!-- Start Nav Menu --><div id="nav_menu">
<?php include ("menu.php"); ?>
</div>
<!-- End Nav Menu -->


<div id="main_content">

<div id="right_content">
<h1>Ibis - Birmingham Airport</h1>

<H2>Hotel Description</H2>


      <div id="leftpic"><img src="/images/ibis.jpg" alt="Ibis Hotel at Birmingham International Airport" /></div><p>The Ibis is a good value hotel and is just a short walk away from the main terminal building and comprises of 162 rooms.  The Ibis has both a bar and restaurant/cafe, and parking can be found nearby. <br />
<br />
Ibis is a brand of Accor Hotels, and as a consequence you can also collect or spend a-club membership points for your stay.</p>

<br />
<br />
 

<H2>Address</H2> 
 

<div id="" class="vcard">
 <span class="fn">Ibis Birmingham Airport</span>
 <div class="adr">
  <span class="street-address">Ambassador Road</span>	
  <span class="locality">Birmingham</span>
, 
  <span class="region">West Midlands</span>
, 
  <span class="postal-code">B26 3AW</span>

  <span class="country-name">United Kingdom</span>

 </div>
 <div class="tel">+44(0)121 7805800</div>
</div>


<H2>Hotel Reviews</H2>
<div id="TA_selfserveprop83" class="TA_selfserveprop">
<ul id="mb15jFwKpsgG" class="TA_links DhRHmc6LBRQI">
<li id="kb1C66JKH" class="F4nUML9Vrp">
<a target="_blank" href="https://www.tripadvisor.co.uk/"><img src="https://www.tripadvisor.co.uk/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a>
</li>
</ul>
</div>
<script src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=83&amp;locationId=1163803&amp;lang=en_UK&amp;rating=true&amp;nreviews=4&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=true&amp;border=true&amp;display_version=2"></script>


<H2>Rates and Offers</H2>
<a href="http://clk.tradedoubler.com/click?p=31820&a=1683084&g=17855650&url=http://www.accorhotels.com/accorhotels/lien_externe.svlt?goto=rech_ville&code_chaine=IBI&nom_ville=birmingham airport&sourceid=[TD_AFFILIATE_ID]-[TD_PROGRAM_ID]-[TD_GE_ID]-[TD_GUID]&merchantid=RT-PC025825-&xtor=AL-40">Check prices and availability</a>














<br /><br />


</div><!-- End right content -->

<div id="left_content">



<div id="content_box_left">

</div>

</div><!-- End left content -->















<!-- Start Footer -->
<div id="footer"><!-- #BeginLibraryItem "/Library/footer.lbi" -->

<div class="leftpic">
<a href="/about-birmingham-airport.php">About</a><br />
<a href="/destinations.php">Destinations</a><br />
<a href="/gettinghere.php">Getting Here</a><br />
<a href="/parking.php">Parking</a><br />
<a href="/hotels.php">Hotels</a><br />
<a href="/arrivals_departures.php">Flight Status</a><br />
<a href="/atbhx.php">At the Airport</a><br />
<a href="http://www.jdoqocy.com/9l65mu2-u1HLNMOKMRHJIOLRLMQ" target="_blank" onmouseover="window.status='http://www.skyscanner.net';return true;" onmouseout="window.status=' ';return true;">Book Cheap Flights</a><br />

</div>

<div class="leftpic">
<a href="/money-saving-tips.php">Money Saving Tips</a><br />
<a href="/bhxcarhire.php">Car Hire</a><br />
<a href="/blog/index.php">Blog</a><br />
<a href="registration.php">Register</a><br />
<a href="contact_us.php">Feedback</a><br />
<a href="http://www.1and1.co.uk/?k_id=8151648">Hosted by 1and1.co.uk</a></div>

<div class="leftpic">
<img src="/images/twittericon.png" alt="Follow us on Twitter" /><a href="http://www.twitter.com/brumairport">Twitter</a><br />
<img src="/images/fbicon.png" alt="Join us on Facebook" /><a href="http://www.facebook.com/group.php?gid=106288736105">Facebook</a><br />
<img src="/images/flickricon.png" alt="Follow us on Flickr" /><a href="http://www.flickr.com/groups/bhx/">Flickr</a>

</div>
<!-- #EndLibraryItem --></div><!-- End Footer -->

</div><!-- End of main content -->

</div><!-- End Wrapper -->


<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58aca4ebdd2716f4"></script>

</body>
</html>
