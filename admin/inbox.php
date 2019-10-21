<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<div class="grid_10">
	<?php 
	   if(isset($_GET['seenid'])){   
	     $seenid = $_GET['seenid'];
	     $query     = "UPDATE tbl_contact SET status='1' where id='$seenid'";
	     $msgupdate = $db->insert($query);
	     if($msgupdate){
	        echo "<span class='success'>Message Sent in the seen box !</span>";
	     }else{
	        echo "<span class='error'>Something Went Wrong !</span>";
	     }
	   }
	?>
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			   $query  = "select * from tbl_contact where status='0' order by id desc";
			   $result = $db->select($query);
			   if($result){
			   	$i=0;
			   	while ($contact = $result->fetch_assoc()) {
			   		$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $contact['firstname'].' '.$contact['lastname']; ?></td>
					<td><?php echo $contact['email']; ?></td>
					<td><?php echo $fm->shortentext($contact['body'], 50); ?></td>
					<td><?php echo $fm->formatdate($contact['date']); ?></td>
					<td><a href="viewmsg.php?msgid=<?php echo $contact['id']; ?>">View</a> ||
					    <a href="replymsg.php?msgid=<?php echo $contact['id']; ?>">Reply</a> ||
					    <a onclick="return confirm('Are are sure to move this message to seen box');" href="?seenid=<?php echo $contact['id']; ?>">Seen</a>
					</td>
				</tr>
			<?php } } ?>
			</tbody>
		</table>
       </div>
    </div>

    <div class="box round first grid">
        <h2>Seen Messages</h2>
        <?php 
          if(isset($_GET['delid'])){
          	$id     = $_GET['delid'];
          	$query  = "DELETE from tbl_contact WHERE id='$id'";
          	$delmsg = $db->delete($query);
          	if($delmsg){
          		echo "<span class='success'>Message Deleted Successfully !</span>";
          	}else{
          		echo "<span class='error'>Message Not Deleted !</span>";	
          	}
          }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			   $query  = "select * from tbl_contact where status='1' order by id desc";
			   $result = $db->select($query);
			   if($result){
			   	$i=0;
			   	while ($contact = $result->fetch_assoc()) {
			   		$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $contact['firstname'].' '.$contact['lastname']; ?></td>
					<td><?php echo $contact['email']; ?></td>
					<td><?php echo $fm->shortentext($contact['body'], 50); ?></td>
					<td><?php echo $fm->formatdate($contact['date']); ?></td>
					<td><a href="viewmsg.php?msgid=<?php echo $contact['id']; ?>">View</a> || 
						<a onclick="return confirm('Are are sure to delete this message');" href="?delid=<?php echo $contact['id']; ?>">Delete</a>
					</td>
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
