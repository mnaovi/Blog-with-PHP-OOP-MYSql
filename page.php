<?php include 'inc/header.php';?>	
<?php 
  if(!isset($_GET['pageid']) || $_GET['pageid'] == NULL){
    echo "<script>window.location = '404.php';</script>";
  }else{
    $pageid = $_GET['pageid'];
  }
?>
<div class="contentsection contemplete clear">
	<?php
	  $query = "select * from tbl_page where id='$pageid'";
	  $pages = $db->select($query);
	  if($pages){
	    while($page = $pages->fetch_assoc()){
	 ?>    
	<div class="maincontent clear">
		<div class="about">
			<h2><?php echo $page['name']; ?></h2>
			<?php echo $page['body']; ?>
        </div>
	</div>
   <?php } }  else{ echo "<script>window.location = '404.php';</script>"; } ?>
<?php include "inc/sidebar.php"?>
<?php include "inc/footer.php"?>
