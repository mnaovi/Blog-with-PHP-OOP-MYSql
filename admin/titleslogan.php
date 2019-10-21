﻿<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<style>
    .leftside{ width: 70%; float: left; }
    .rightside{ width: 30%; float: left; }
    .leftside img{ height: 160px; width: 180px; }
</style>
<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $title  = $fm->validate($_POST['title']);
      $slogan = $fm->validate($_POST['slogan']);
      $title  = mysqli_real_escape_string($db->link, $title);
      $slogan = mysqli_real_escape_string($db->link, $slogan);

      $permited  = array('png');
      $file_name = $_FILES['logo']['name'];
      $file_size = $_FILES['logo']['size'];
      $file_temp = $_FILES['logo']['tmp_name'];

      $div            = explode('.', $file_name);
      $file_ext       = strtolower(end($div));
      $same_image     = 'Logo'.'.'.$file_ext;
      $uploaded_image = "upload/".$same_image;

      if($title == "" || $slogan == ""){
             echo "<span class='error'>Field must not be empty !</span>";
        }else{
           if(!empty($file_name)){

             if ($file_size >1048567) {
                  echo "<span class='error'>Image Size should be less then 1MB!
                  </span>";
             }elseif (in_array($file_ext, $permited) === false) {
                  echo "<span class='error'>You can upload only:-"
                  .implode(', ', $permited)."</span>";
             }else{
                 move_uploaded_file($file_temp, $uploaded_image);
                 $query = "UPDATE title_slogan
                           SET 
                           title  = '$title',
                           slogan = '$slogan',
                           logo   = '$uploaded_image'
                           WHERE id='1'";
                 $updated_row = $db->update($query);
                 if ($updated_row) {
                      echo "<span class='success'>Data Updated Successfully.
                      </span>";
                 }else {
                      echo "<span class='error'>Data Not Updated !</span>";
                 }
             }

           }else{
               $query = "UPDATE title_slogan
                         SET 
                         title = '$title',
                         slogan = '$slogan'
                         WHERE id='1'";
               $updated_row = $db->update($query);
               if ($updated_row) {
                    echo "<span class='success'>Data Updated Successfully.
                    </span>";
               }else {
                    echo "<span class='error'>Data Not Updated !</span>";
               }
           }
        }
  }
 ?>
<div class="grid_10">
    <?php
       $query  = "select * from title_slogan where id='1'"; 
       $tsiall = $db->select($query);
       if($tsiall){
        while($tsi = $tsiall->fetch_assoc()){
     ?>
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock">  
        <div class="leftside">            
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">					
                <tr>
                    <td>
                        <label>Website Title</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $tsi['title']; ?>"  name="title" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Website Slogan</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $tsi['slogan']; ?>" name="slogan" class="medium" />
                    </td>
                </tr>
				 
                 <tr>
                     <td>
                         <label>Upload Logo</label>
                     </td>
                     <td>
                         <input type="file" name="logo" />
                     </td>
                 </tr>
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            </div> 
            <div class="rightside">
                <img src="<?php echo $tsi['logo']; ?>" alt="Logo">
            </div>
        </div>
    </div>
    <?php } } ?>
</div>
<?php include 'inc/footer.php' ?>