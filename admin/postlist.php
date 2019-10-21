<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<div class="grid_10">
    <div class="box round first grid">
    	<?php 
    	  if(isset($_GET['postid'])){
    	  	$id     = $_GET['postid'];
    	  	$sql = "select * from tbl_post where id='$id'";
    	  	$res = $db->select($sql);
    	  	if($res){
    	  		while($sres = $res->fetch_assoc()){
    	  			$imglink = $sres['image'];
    	  			unlink($imglink);
    	  		}
    	  	}
    	  	$query  = "DELETE FROM tbl_post WHERE id='$id'";
    	  	$delpost = $db->delete($query);
    	  	if($delpost){
    	  		echo "<span class='success'>Post Deleted Successfully !</span>";
    	  	}else{
    	  		echo "<span class='error'>Post Not Deleted !</span>";	
    	  	}
    	  }
    	?>
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="5%">No.</th>
					<th width="15%">Post Title</th>
					<th width="18%">Description</th>
					<th width="10%">Category</th>
					<th width="10%">Image</th>
					<th width="10%">Author</th>
					<th width="10%">Tags</th>
					<th width="10%">Date</th>
					<th width="12% ">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				  $query  = "SELECT tbl_post.*,tbl_category.name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat_id = tbl_category.id ORDER BY tbl_post.title DESC"; 
				  $result = $db->select($query);
				  if($result){
				  	$i=0;
				  	while($post = $result->fetch_assoc()){
				  		$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $post['title']; ?></td>
					<td><?php echo $fm->shortentext($post['body'], 80); ?></td>
					<td><?php echo $post['name']; ?></td>
					<td><img src="<?php echo $post['image']; ?>" height="40px" width="60px" alt="Post Image"></td>
					<td><?php echo $post['author']; ?></td>
					<td><?php echo $post['tags']; ?></td>
					<td><?php echo $fm->formatdate($post['date']); ?></td>
					<td> <a href="viewpost.php?postid=<?php echo $post['id']?>">View</a>
					<?php if(Session::get("userId") == $post['userid'] || Session::get("userRole") == '0' ) { ?>
					 || <a href="editpost.php?postid=<?php echo $post['id']?>">Edit</a> || <a onclick="return confirm('Are you sure to Delete !')" href="?postid=<?php echo $post['id']; ?>">Delete</a></td>
					<?php } ?>
				</tr>
			    <?php } } ?>
			</tbody> 
		</table>

       </div>
    </div>
</div>     
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php' ?>
    
