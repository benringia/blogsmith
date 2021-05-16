<?php include 'db.php'; ?>
<?php include 'functions.php'; ?>

<?php 
    session_start();

    if(isset($_POST['login'])) {
       login_user($_POST['username'], $_POST['password']);
         
    }
?>