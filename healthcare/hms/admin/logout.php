<?php
session_start();
$_SESSION['login']=="";
session_unset();
session_destroy();
header("Location: login.php?logout=success");
exit();
?>

<script language="javascript">
document.location="index.php";
</script>
