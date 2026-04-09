<?php
if (isset($_GET['file']) && file_exists($_GET['file'])) {
    unlink($_GET['file']);
}
header("Location: list.php");
exit();