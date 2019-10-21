 <?php include 'config/config.php';?>	
<?php include "lib/Database.php";?>
<?php include "helpers/Format.php";?>	
<?php 
   $db = new Database(); 
   $fm = new Format(); 
?>
<!DOCTYPE html>
<html>
<head>
	<?php 
	   if(isset($_GET['pageid'])){
	   	  $pageid = $_GET['pageid'];
	      $query = "select * from tbl_page where id='$pageid'";
	      $pages = $db->select($query);
	      if($pages){
	        while($page = $pages->fetch_assoc()){ ?>
	          <title><?php echo $page['name']; ?> - <?php echo TITLE; ?></title>
          <?php } } } elseif(isset($_GET['id'])){
	   	  $id = $_GET['id'];
	      $query = "select * from tbl_post where id='$id'";
	      $posts = $db->select($query);
	      if($posts){
	        while($post = $posts->fetch_assoc()){ ?>
	          <title><?php echo $post['title']; ?> - <?php echo TITLE; ?></title>
          <?php } } } else { ?>
          	  <title><?php echo $fm->title(); ?> - <?php echo TITLE; ?></title>
          <?php } ?>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php
       if(isset($_GET['id'])){
       	  $id = $_GET['id'];
	      $query = "select * from tbl_post where id='$id'";
	      $ppost = $db->select($query);
	      if($ppost){
	      	while($post = $ppost->fetch_assoc()){ ?>
				<meta name="keywords" content="<?php echo $post['tags']; ?>">        
	     <?php  } } } else{ ?>
                <meta name="keywords" content="<?php echo KEYWORDS; ?>">
	  <?php  } ?>
	<meta name="author" content="Ovi">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">

	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<?php 
			  $query = "select * from title_slogan where id='1'";
			  $ahead = $db->select($query);
			  if($ahead){
			  	while($head = $ahead->fetch_assoc()){
			 ?>
			<div class="logo">
				
				<img src="admin/<?php echo $head['logo'] ?>" alt="Logo"/>
				<h2><?php echo $head['title'] ?></h2>
				<p><?php echo $head['slogan'] ?></p>
			    
			</div>
			<?php } } ?>
		</a>
		<div class="social clear">
			<?php 
			  $query   = "select * from tbl_social where id='1'";
			  $asocial = $db->select($query);
			  if($asocial){
			    while($social = $asocial->fetch_assoc()){
			?>  
			<div class="icon clear">
				<a href="<?php echo $social['facebook'] ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $social['twitter'] ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $social['linkedin'] ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $social['google'] ?>" target="_blank"><i class="fa fa-google"></i></a>
			</div>
		    <?php } } ?>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search Post..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<?php
	  $path = $_SERVER['SCRIPT_FILENAME'];
	  $cpage = basename($path, '.php');
	 ?>
	<ul>
		<li><a <?php if($cpage == 'index') { echo "id='active'";} ?> href="index.php">Home</a></li>
		<li><a <?php if($cpage == 'about') { echo "id='active'";} ?> href="about.php">About</a></li>
		<?php
		  $query = "select * from tbl_page";
		  $pages = $db->select($query);
		  if($pages){
		    while($page = $pages->fetch_assoc()){
		 ?>
		<li><a 
			<?php 
			   if(isset($_GET['pageid']) && $_GET['pageid'] == $page['id']){
			   	echo "id='active'";
			   }
			 ?>
		 href="page.php?pageid=<?php echo $page['id']; ?>"><?php echo $page['name']; ?></a></li>
		<?php  } } ?>	
		<li><a <?php if($cpage == 'contact') { echo "id='active'";} ?> href="contact.php">Contact</a></li>
	</ul>
</div>
