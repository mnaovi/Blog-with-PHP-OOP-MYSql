<?php include 'inc/header.php';?>	

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<!-- pagination -->
			 <?php 
			   if(!isset($_GET["search"]) || $_GET["search"] == NULL){
			   	header("Location:404.php");
			   }else{
			   	$keyword = $_GET["search"];
			   }
			 ?>
			<!-- pagination -->
        <?php 
           $query = "select * from tbl_post where title LIKE '%$keyword%' OR body LIKE '%$keyword%'";
           $post = $db->select($query);
           if($post){
	           while($result = $post->fetch_assoc()){
        ?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title'] ?></a></h2>
				<h4><?php echo $fm->formatdate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
				 <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
				<p>
					<?php echo $fm->shortentext($result['body']); ?>
				</p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
				</div>
			</div>
                    <?php } ?><!--end of while loop-->
                <?php } else{ ?>
                     <p>Your Keyword didn't found any result !!</p> 
                <?php } ?>
		</div>
<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>
	