<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<div class="grid_10">
    <?php 
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $facebook = $fm->validate($_POST['facebook']);
        $twitter  = $fm->validate($_POST['twitter']);
        $linkedin = $fm->validate($_POST['linkedin']);
        $google   = $fm->validate($_POST['google']);

        $facebook = mysqli_real_escape_string($db->link, $facebook);
        $twitter  = mysqli_real_escape_string($db->link, $twitter);
        $linkedin = mysqli_real_escape_string($db->link, $linkedin);
        $google   = mysqli_real_escape_string($db->link, $google);
        
        if($facebook == "" || $twitter == "" || $linkedin == "" || $google == ""){
            echo "<span class='error'>Field must not be empty !</span>";
        }else{
            $query = "UPDATE tbl_social
                      SET 
                      facebook   = '$facebook',
                      twitter    = '$twitter',
                      linkedin   = '$linkedin',
                      google     = '$google'
                      WHERE id='1'";
            $updated_row = $db->update($query);
            if ($updated_row) {
                 echo "<span class='success'>Socail Media Updated Successfully.
                 </span>";
            }else {
                 echo "<span class='error'>Socail Media Not Updated !</span>";
            }
        }

      }
    ?>

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">    
        <?php 
          $query   = "select * from tbl_social where id='1'";
          $asocial = $db->select($query);
          if($asocial){
            while($social = $asocial->fetch_assoc()){
        ?>           
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="facebook" value="<?php echo $social['facebook'] ?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="twitter" value="<?php echo $social['twitter'] ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="linkedin" value="<?php echo $social['linkedin'] ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Google</label>
                    </td>
                    <td>
                        <input type="text" name="google" value="<?php echo $social['google'] ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td></td>
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