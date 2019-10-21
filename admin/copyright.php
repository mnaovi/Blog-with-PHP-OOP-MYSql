<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<div class="grid_10">

    <?php 
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $note = $fm->validate($_POST['note']);
        $note = mysqli_real_escape_string($db->link, $note);
        
        if($note == ""){
            echo "<span class='error'>Field must not be empty !</span>";
        }else{
            $query = "UPDATE tbl_footer
                      SET 
                      note   = '$note'
                      WHERE id='1'";
            $updated_row = $db->update($query);
            if ($updated_row) {
                 echo "<span class='success'>SCopyright Text Updated Successfully.
                 </span>";
            }else {
                 echo "<span class='error'>Copyright Text Not Updated !</span>";
            }
        }

      }
    ?>

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <div class="block copyblock"> 
        <?php 
          $query   = "select * from tbl_footer where id='1'";
          $afooter = $db->select($query);
          if($afooter){
            while($footer = $afooter->fetch_assoc()){
        ?>  
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" value="<?php echo $footer['note']; ?>" name="note" class="large" />
                    </td>
                </tr>
				
				 <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
         <?php } } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php' ?>