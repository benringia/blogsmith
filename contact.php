<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


<?php 

// the message
    // $msg = "First line of text\nSecond line of text";

    // // use wordwrap() if lines are longer than 70 characters
    // $msg = wordwrap($msg,70);

    // // send email
    // mail("benringia@gmail.com","My subject",$msg);

    if(isset($_POST['submit'])) {

        $to = "benringia@gmail.com";
        $subject  = wordwrap($_POST['subject'],70);
        $body = $_POST['body'];
        $header = "FROM: " . $_POST['email'];

        mail($to, $subject, $body, $header);
    } 

?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 style="margin-bottom: 30px">Contact</h1>
                    <form role="" action="" method="post" id="login-form" autocomplete="off">
                        
                        
                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                        </div>
                         <div class="form-group">
                            <textarea class="form-control" name="body" id="body"  rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-success btn-lg btn-block" value="Send">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
