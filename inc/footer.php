</div>

	<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
	  <?php 
	    $query   = "select * from tbl_footer where id='1'";
	    $afooter = $db->select($query);
	    if($afooter){
	      while($footer = $afooter->fetch_assoc()){
	  ?>  
	  <p>&copy; <?php echo $footer['note']; ?> <?php echo date('Y'); ?></p>
	  <?php } } ?>
	</div>
	<?php 
	  $query   = "select * from tbl_social where id='1'";
	  $asocial = $db->select($query);
	  if($asocial){
	    while($social = $asocial->fetch_assoc()){
	?>  
	<div class="fixedicon clear">
		<a href="<?php echo $social['facebook'] ?>" target="blank"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $social['twitter'] ?>" target="blank"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $social['linkedin'] ?>" target="blank"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $social['google'] ?>" target="blank"><img src="images/gl.png" alt="Google"/></a>
	</div>
     <?php } } ?>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>