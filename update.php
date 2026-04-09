<?php
$file_path = $_GET['file'];
$data = [];
$handle = fopen($file_path, "r");
while (($line = fgets($handle)) !== false) {
    $parts = explode(": ", $line, 2);
    if (count($parts) == 2) { $data[strtolower($parts[0])] = trim($parts[1]); }
}
fclose($handle);
?>
<!DOCTYPE html>
<html class="ptss-body">
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="ptss-card" style="max-width: 600px; margin: auto;">
        <h2 class="ptss-title">Edit Record</h2>
        <form action="process.php?action=update" method="POST">
            <input type="hidden" name="target_file" value="<?php echo $file_path; ?>">

            <div class="ptss-form-group">
                <label class="ptss-label">Visit Date</label>
                <input type="date" name="date" class="ptss-input" value="<?php echo $data['date']; ?>">
            </div>

            <?php 
            $edit_fields = ['package', 'name', 'ic', 'institution', 'contact', 'email', 'address', 'remarks'];
            foreach ($edit_fields as $f): 
            ?>
            <div class="ptss-form-group">
                <label class="ptss-label"><?php echo ucfirst($f); ?></label>
                <input type="text" name="<?php echo $f; ?>" class="ptss-input" value="<?php echo $data[$f]; ?>">
            </div>
            <?php endforeach; ?>

            <button type="submit" class="ptss-btn ptss-btn-warning">Save Changes</button>
            <a href="list.php" class="ptss-btn ptss-btn-primary">Back</a>
        </form>
    </div>
</body>
</html>