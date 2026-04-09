<!DOCTYPE html>
<html class="ptss-body">
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="ptss-card">
        <h2 class="ptss-title">Visitor Details</h2>
        <div class="ptss-data-view"><?php
            $handle = fopen($_GET['file'], "r");
            while (!feof($handle)) { echo fgets($handle); }
            fclose($handle);
        ?></div>
        <div style="margin-top:20px;"><a href="list.php" class="ptss-btn ptss-btn-primary">Back to List</a></div>
    </div>
</body>
</html>