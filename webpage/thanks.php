<?php
include('header.php');
session_start();

// $_REQUEST['city']; will not works
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Dear <?= $_SESSION['name'] ?>. Thanks for your submission.</h1>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
