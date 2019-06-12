<div id="primary-section">
<div id="content">
<?php $Q = "select * from tbl_tags";
      $qs = mysqli_query($con,$Q);
	  while($qsfetch = mysqli_fetch_array($qs,MYSQLI_ASSOC))
	  {
		  ?>
		  <div class="singlevideo">
            <h1><a href="<?php echo $ru;?>/singletag/<?php echo $qsfetch['pk_tag_id']?>"><?php echo $qsfetch['tag_name'];?></a></h1>
            
          </div>
		  <?php
	  }
?>
</div>
</div>
<aside id="secondary-section">
 <nav id="metro-widget">

<div id="fb"><a href="#"><img height="144" width="138" src="<?php echo $ru;?>images/fb.png"></a></div>
<div id="rss"><a href="#"><img height="69" width="138" src="<?php echo $ru;?>images/rss.png"></a></div>
<div id="g"><a href="#"><img height="69" width="71" src="<?php echo $ru;?>images/g+.png"></a></div>
<div id="twitter"><a href="#"><img height="69" width="71" src="<?php echo $ru;?>images/twitter.png"></a></div>
<div id="in"><a href="#"><img height="69" width="71" src="<?php echo $ru;?>images/in.png"></a></div>
<div id="p"><a href="#"><img height="69" width="70" src="<?php echo $ru;?>images/p.png"></a></div>
<div id="yt"><a href="#"><img height="69" width="142" src="<?php echo $ru;?>images/yt.png"></a></div>
</nav>
  <section id="advertise">
  <h2>Advertisement</h2> <hr>
   <img height="100" width="298" style="margin-top:16px;" src="<?php echo $ru;?>images/300-100.png">
    
  </section>
  <section id="popular-coments">
 <img height="430" width="295" style="margin-top:21px;" src="<?php echo $ru;?>images/popular-comments.png">
    
  </section>
  <section id="advertise-2">
  <h2>Advertisement</h2> <hr>
   <img height="300" width="285" style="margin-top:16px; margin-left:8px;" src="<?php echo $ru;?>images/300-300.png">
    
  </section>
  <section id="calender">
  <h2>Calander</h2> <hr>
   <img height="323" width="285" style="margin-top:16px; margin-left:10px;" src="<?php echo $ru;?>images/calander.png">
    
  </section>
  <section id="fb-plugins">
   <img height="306" width="261" style="margin-left:16px;" src="<?php echo $ru;?>images/facebook-plugin.png">
  </section>
  
  <section id="google-circle">
  <a href="#"><img height="30" width="30" src="<?php echo $ru;?>images/g+.png"></a>

  <p>i'm on</p>
   <div class="add-to-circle"><a href="#">Add to circles</a></div>
  </section>
  </aside>