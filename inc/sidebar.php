<div class="sidebar clear">
	<div class="samesidebar clear">
		<h2>Categories</h2>
			<ul>
				<?php
				  $query = "select * from tbl_category order by id asc limit 6";
	              $result= $db->select($query);
	              if($result){
	              	while($category = $result->fetch_assoc()){
				?>
				<li><a href="posts.php?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
				<?php } } else{ ?>
                <li>No Category Exist !!</li>
				<?php } ?>					
			</ul>
	</div>
	
	<div class="samesidebar clear">
		<h2>Latest articles</h2>
	        <?php 
	           $query = "select * from tbl_post order by id desc limit 5";
	           $post = $db->select($query);
	           if($post){
		           while($result = $post->fetch_assoc()){
	        ?>
			<div class="popular clear">
				<h3><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h3>
				<a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
					<?php echo $fm->shortentext($result['body'], 125); ?>	
			</div>
            <?php } } ?>
	</div>
	
</div>