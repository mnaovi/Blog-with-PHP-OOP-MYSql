<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php 
          if(isset($_GET['catid'])){
          	$id     = $_GET['catid'];
          	$query  = "DELETE from tbl_category WHERE id='$id'";
          	$delcat = $db->delete($query);
          	if($delcat){
          		echo "<span class='success'>Category Deleted Successfully !</span>";
          	}else{
          		echo "<span class='error'>Category Not Deleted !</span>";	
          	}
          }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				   $query  = "select * from tbl_category order by id desc";
				   $result = $db->select($query);
				   if($result){
				   	$i=0;
				   	while ($Category = $result->fetch_assoc()) {
				   		$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $Category['name']; ?></td>
					<td><a href="editcat.php?catid=<?php echo $Category['id'] ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete!')"; href="?catid=<?php echo $Category['id'] ?>">Delete</a></td>
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

