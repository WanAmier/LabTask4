<?php
$file_path = $_GET['file'] ?? '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $handle = fopen($file_path, "w");
    foreach ($_POST as $key => $value) {
        if ($key != 'submit') { fwrite($handle, ucfirst($key) . ": " . $value . "\n"); }
    }
    fclose($handle);
    header("Location: list.php");
    exit();
}

$data = [];
if (file_exists($file_path)) {
    $handle = fopen($file_path, "r");
    while (($line = fgets($handle)) !== false) {
        $parts = explode(": ", $line, 2);
        if (count($parts) == 2) { $data[strtolower($parts[0])] = trim($parts[1]); }
    }
    fclose($handle);
}
?>
<!DOCTYPE html>
<html class="ptss-body">
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="ptss-card">
        <h2 class="ptss-title">Update Registration</h2>
        <form method="POST">
            <?php foreach ($data as $key => $val): ?>
            <div class="ptss-form-group">
                <label class="ptss-label"><?php echo ucfirst($key); ?></label>
                <input type="text" name="<?php echo $key; ?>" class="ptss-input" value="<?php echo $val; ?>">
            </div>
            <?php endforeach; ?>
            <button type="submit" name="submit" class="ptss-btn ptss-btn-warning">Save Changes</button>
            <a href="list.php" class="ptss-btn ptss-btn-primary">Cancel</a>
        </form>
    </div>
</body>
</html>