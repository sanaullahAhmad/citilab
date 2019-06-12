<?php
$query_select="SELECT * FROM `tbl_dynamic_pages` WHERE `status` = '1' and `id`='1'";
$query_res = mysqli_query($con,$query_select);
$query_row = mysql_fetch_assoc($query_res);
$title = $query_row['page_title'];
$des = $query_row['page_description'];
?>
<div class="page-content">
  <div id="primary-section">
      <div class="black23"><?php echo $title;?></div>
      <section id="events">
        <div id="holiday-seasons3">
              <div class="newscontendiv">
                <p>
                 <?php echo stripslashes(urldecode($des));?>
                </p>
             </div>
       </div>
       <div style="clear:both"></div>
    </section>
  </div><!--end of primary section-->
  
<aside id="secondary-section">
 <nav id="metro-widget">

<div id="fb"><a href="#"><img src="<?php echo $ru;?>images/fb.png" width="138" height="144"/></a></div>
<div id="rss"><a href="#"><img src="<?php echo $ru;?>images/rss.png" width="138" height="69" /></a></div>
<div id="g"><a href="#"><img src="<?php echo $ru;?>images/g+.png" width="71" height="69"  /></a></div>
<div id="twitter"><a href="#"><img src="<?php echo $ru;?>images/twitter.png" width="71" height="69"/></a></div>
<div id="in"><a href="#"><img src="<?php echo $ru;?>images/in.png" width="71" height="69" /></a></div>
<div id="p"><a href="#"><img src="<?php echo $ru;?>images/p.png" width="70" height="69"/></a></div>
<div id="yt"><a href="#"><img src="<?php echo $ru;?>images/yt.png" width="142" height="69" /></a></div>
</nav>
  <section id="advertise">
  <h2>Advertisement</h2> <hr>
   <img src="<?php echo $ru;?>images/300-100.png" width="298" height="100" style="margin-top:16px;" />
    
  </section>
  <section id="popular-coments">
 <img src="<?php echo $ru;?>images/popular-comments.png" width="295" height="430" style="margin-top:21px;"/>
    
  </section>
  <section id="advertise-2">
  <h2>Advertisement</h2> <hr>
   <img src="<?php echo $ru;?>images/300-300.png" width="285" height="300" style="margin-top:16px; margin-left:8px;" />
    
  </section>
  <section id="calender">
  <h2>Calander</h2> <hr>
   <img src="<?php echo $ru;?>images/calander.png" width="285" height="323" style="margin-top:16px; margin-left:10px;" />
    
  </section>
  <section id="fb-plugins">
   <img src="<?php echo $ru;?>images/facebook-plugin.png" width="261" height="306" style="margin-left:16px;" />
  </section>
  </section>
  <section id="google-circle">
  <a href="#"><img src="<?php echo $ru;?>images/g+.png" width="30" height="30" /></a>

  <p>i'm on</p>
   <div class="add-to-circle"><a href="#">Add to circles</a></div>
  </section>
  </aside>

            