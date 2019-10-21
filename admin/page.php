<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<style>
  .delete{ margin-left: 10px; }
.delete a{ 
    background: #f0f0f0 none repeat scroll 0 0;    
    border: 1px solid #ddd;
    color: #444;
    cursor: pointer;
    font-size: 20px;
    font-weight: normal;
    padding: 2px 10px; }
</style>
<div class="grid_10">
    <?php 
      if(!isset($_GET['pageid']) || $_GET['pageid'] == NULL){
        echo "<script>window.location = 'index.php';</script>";
      }else{
        $pageid = $_GET['pageid'];
      }
    ?>
    <div class="box round first grid">
        <h2>Update Page</h2>
        <?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $name  = mysqli_real_escape_string($db->link, $_POST['name']);
              $body  = mysqli_real_escape_string($db->link, $_POST['body']);

              if($name == "" || $body == ""){
                     echo "<span class='error'>Field must not be empty !</span>";
                }else{
                      $query = "UPDATE tbl_page 
                      SET
                      name = '$name',
                      body = '$body'
                      WHERE id='$pageid'";
                      $updated_row = $db->update($query);
                      if ($updated_row) {
                           echo "<span class='success'>Page Updated Successfully.
                           </span>";
                      }else {
                           echo "<span class='error'>Page Not Updated !</span>";
                      }
                  }    
              }
         ?>
        <div class="block">   
        <?php
          $query = "select * from tbl_page where id='$pageid'";
          $pages = $db->select($query);
          if($pages){
            while($page = $pages->fetch_assoc()){
         ?>            
         <form action="" method="post">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $page['name']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Body</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"><?php echo $page['body']; ?></textarea>
                    </td>
                </tr>
                
				        <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                        <span class="delete" ><a onclick="return confirm('Are you sure to Delete Page !')" href="deletepage.php?pageid=<?php echo $page['id']; ?>">Delete</a></span>
                    </td>
                </tr>
            </table>
            </form>
            <?php  } } ?>
        </div>
    </div>
</div>      
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php' ?>
