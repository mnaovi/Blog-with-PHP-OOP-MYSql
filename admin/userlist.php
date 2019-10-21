<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <?php 
          if(isset($_GET['userid'])){
          	$id     = $_GET['userid'];
          	$query  = "DELETE from tbl_user WHERE id='$id'";
          	$delcat = $db->delete($query);
          	if($delcat){
          		echo "<span class='success'>User Deleted Successfully !</span>";
          	}else{
          		echo "<span class='error'>User Not Deleted !</span>";	
          	}
          }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>User Name</th>
					<th>Email</th>
					<th>Details</th>
					<th>Role</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				   $query  = "select * from tbl_user order by id desc";
				   $result = $db->select($query);
				   if($result){
				   	$i=0;
				   	while ($user = $result->fetch_assoc()) {
				   		$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $user['name']; ?></td>
					<td><?php echo $user['username']; ?></td>
					<td><?php echo $user['email']; ?></td>
					<td><?php echo $fm->shortentext($user['details'], 30); ?></td>
					<td><?php
					        if($user['role'] == 0){
					        	echo "Admin";
					        }elseif($user['role'] == 1){
                                echo "Author";
					        }elseif($user['role'] == 2){
                                echo "Editor";
					        }
					     ?>	
					 </td>
					<td><a href="viewuser.php?userid=<?php echo $user['id'] ?>">View</a>
					<?php if(Session::get("userRole") == '0'){ ?>
					 || <a onclick="return confirm('Are you sure to Delete User!')"; href="?userid=<?php echo $user['id'] ?>">Delete</a></td>
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

