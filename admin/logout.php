<?php 
include("includes/db.inc.php");

session_destroy();
header("location:index.php");
?>