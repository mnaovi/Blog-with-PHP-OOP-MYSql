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
               $tmail    = $fm->validate($_POST['tmail']);
               $fmail    = $fm->validate($_POST['fmail']);
               $subject  = $fm->validate($_POST['subject']);
               $message  = $fm->validate($_POST['message']);

               $tmail    = mysqli_real_escape_string($db->link, $tmail);
               $fmail    = mysqli_real_escape_string($db->link, $fmail);
               $subject  = mysqli_real_escape_string($db->link, $subject);
               $message  = mysqli_real_escape_string($db->link, $message);

               $sendmail = mail($tmail, $subject, $message, $fmail);
               if($sendmail){
                echo "<span class='success'>Message Sent Successfully.</span>";
               }else{
                 echo "<span class='error'>Something Went Wrong.</span>";
               }
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
                        <label>To</label>
                    </td>
                    <td>
                        <input type="text" name="tmail" readonly="" value="<?php echo $msg['email']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>From</label>
                    </td>
                    <td>
                        <input type="email" name="fmail" placeholder="Enter Your Email Address" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Subject</label>
                    </td>
                    <td>
                        <input type="text" name="subject" placeholder="Enter Subject" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Message</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="message" ></textarea>
                    </td>
                </tr>
                
				        <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Send" />
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
