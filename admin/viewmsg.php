<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<div class="grid_10">
  <?php 
     if(!isset($_GET['msgid']) || $_GET['msgid'] == NULL){
       echo "<script>window.location = 'inbox.php';</script>";
     }else{
       $msgid = $_GET['msgid'];
     }
  ?>
    <div class="box round first grid">
        <h2>View Message</h2>
        <?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
              echo "<script>window.location = 'inbox.php';</script>";
              }
         ?>
        <div class="block">  
        <?php
          $query = "select * from tbl_contact where id='$msgid'";
          $amsg = $db->select($query);
          if($amsg){
            while($msg = $amsg->fetch_assoc()){
         ?>                 
         <form action="" method="post">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" readonly="" value="<?php echo $msg['firstname'].' '.$msg['lastname'] ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" readonly="" value="<?php echo $msg['email']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Date</label>
                    </td>
                    <td>
                        <input type="text" readonly="" value="<?php echo $fm->formatdate($msg['date']); ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Message</label>
                    </td>
                    <td>
                        <textarea class="tinymce" ><?php echo $msg['body']; ?></textarea>
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
