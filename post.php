<?php include 'inc/header.php';?>	
<?php
  if(!isset($_GET['id']) || $_GET['id'] == NULL){
  	header("Location:404.php");
  }else{
  	$id    = $_GET['id'];
  }
 ?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<?php
			  $query = "select * from tbl_post where id=$id";
              $result= $db->select($query);
              if($result){
              	while($post = $result->fetch_assoc()){
			?>
			<h2><?php echo $post['title']; ?></h2>
			<h4><?php echo $fm->formatdate($post['date']); ?>, By <a href=""><?php echo $post['author']; ?></a></h4>
			<a href="#"><img src="admin/<?php echo $post['image']; ?>" alt="post image"/></a>
			<?php echo $post['body']; ?>
			<div class="relatedpost clear">
				<h2>Related articles</h2>
				<?php 
				  $catid = $post['cat_id'];
				  $relatedquery = "select * from tbl_post where cat_id=$catid order by rand() limit 6";
				  $rpost = $db->select($relatedquery);
				  if($rpost){
				  	while($rp = $rpost->fetch_assoc()){
				?>
				<a href="post.php?id=<?php echo $rp['id']; ?>"><img src="admin/<?php echo $rp['image']; ?>" alt="post image"/></a>
			    <?php } } ?>
			</div>
			<?php } } else{ header("Location:404.php"); } ?>
        </div>
	</div>
<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>