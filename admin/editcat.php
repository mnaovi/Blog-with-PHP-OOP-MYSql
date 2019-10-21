<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
       <div class="block copyblock">
        <?php
           if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
            echo "<script>window.location = 'catlist.php';</script>";
            //header("Location: catlist.php");
           }else{
            $id = $_GET['catid'];
           }
         ?> 
        <?php 
          if($_SERVER['REQUEST_METHOD']== 'POST'){
              $name = $_POST['name'];
              if(empty($name)){
                echo "<span class='error'>Field must not be empty !</span>";
              }else{
                 $query     = "UPDATE tbl_category SET name='$name' where id='$id'";
                 $catupdate = $db->insert($query);
                 if($catupdate){
                    echo "<span class='success'>Category Updated Successfully !</span>";
                 }else{
                    echo "<span class='error'>Category Not Updated !</span>";
                 }
              }
          }
        ?>
        <?php
           $query  = "select * from tbl_category where id='$id'";
           $result = $db->select($query);
           $oldcat = $result->fetch_assoc();
         ?>
         <form action="" method="post"> 
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="name" value="<?php echo $oldcat['name'];?>" class="medium" />
                    </td>
                </tr>
				<tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
         </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php' ?>
