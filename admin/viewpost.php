<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<div class="grid_10">
  <?php 
    if(!isset($_GET['postid']) || $_GET['postid'] == NULL){
      echo "<script>window.location = 'postlist.php'</script>";
    }else{
      $postid = $_GET['postid'];
    }
  ?>
    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
             echo "<script>window.location = 'postlist.php'</script>";
          }
         ?>
        <div class="block">    
        <?php 
          $query   = "select * from tbl_post where id='$postid'";
          $oldpost = $db->select($query);
          if($oldpost){
            while($opost = $oldpost->fetch_assoc()){
        ?>           
         <form action="" method="post">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" readonly="" value="<?php echo $opost['title']; ?>" class="medium" />
                    </td>
                </tr>
             
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select">
                            <option>Select Category</option>
                            <?php
                              $query  = "select * from tbl_category";
                              $result = $db->select($query);
                              if($result){
                                while($category = $result->fetch_assoc()){
                             ?>
                            <option
                               <?php
                                  if($opost['cat_id'] == $category['id']){ ?>
                                    selected = "selected"; 
                               <?php  
                                  }
                                ?>
                             value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
           
                <tr>
                    <td>

                        <label>Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $opost['image']; ?>" alt="" height="100px" width="250px">
                        <br>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                          <?php echo $opost['body']; ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Tags</label>
                    </td>
                    <td>
                        <input type="text" readonly="" value="<?php echo $opost['tags']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Author</label>
                    </td>
                    <td>
                        <input type="text" readonly="" value="<?php echo $opost['author']; ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Ok" />
                    </td>
                </tr>
            </table>
            </form>
          <?php } }?>
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
