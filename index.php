<?php include 'inc/header.php';?>	
<?php include "inc/slider.php";?>	

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<!-- pagination -->
			 <?php 
               $per_page = 3;
               if(isset($_GET["page"])){
               	$page = $_GET["page"];
               } else{
               	$page = 1;
               }
               $strtpage = ($page-1)*$per_page;
			 ?>
			<!-- pagination -->
        <?php 
           $query = "select * from tbl_post limit $strtpage,$per_page";
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
                    <?php 
	                    $query  = "select * from tbl_post";
	                    $result = $db->select($query);
	                    $total_rows = mysqli_num_rows($result);
	                    $total_page = ceil($total_rows/$per_page);
	                    
	                    echo "<span style='display: block; font-size: 20px; margin-top: 10px; padding: 10px; text-align: center;'><a style='background: #e6af4b none repeat scroll 0 0; border: 1px solid #a7700c; border-radius: 3px; color: #333; margin-left: 2px; padding: 2px 10px;text-decoration: none;' href='index.php?page=1'>".'First Page'."</a>";
	                    for ($i=1; $i<=$total_page; $i++) { 
	                    	echo"<a style='background: #e6af4b none repeat scroll 0 0; border: 1px solid #a7700c; border-radius: 3px; color: #333; margin-left: 2px; padding: 2px 10px;text-decoration: none;' href='index.php?page=".$i."'>".$i."</a>";
	                    };
	                    echo"<a style='background: #e6af4b none repeat scroll 0 0; border: 1px solid #a7700c; border-radius: 3px; color: #333; margin-left: 2px; padding: 2px 10px;text-decoration: none;' href='index.php?page=$total_page'>".'Last Page'."</a></span>";
	                ?>


                    <?php } else{ header("Location:404.php"); } ?>
		</div>
<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>
	