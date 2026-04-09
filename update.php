<?php
$file_path = $_GET['file'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $handle = fopen($file_path, "w");
    foreach ($_POST as $key => $value) {
        if ($key != 'submit') {
            fwrite($handle, ucfirst($key) . ": " . $value . "\n");
        }
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
        if (count($parts) == 2) {
            $data[strtolower($parts[0])] = trim($parts[1]);
        }
    }
    fclose($handle);
} else {
    die("File not found.");
}
?>
<!DOCTYPE html>
<html class="ptss-body">
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="ptss-card" style="max-width: 600px; margin: auto;">
        <h2 class="ptss-title">Update Visitor Record</h2>
        <form method="POST">
            
            <div class="ptss-form-group">
                <label class="ptss-label">Package</label>
                <select name="package" class="ptss-input">
                    <option <?php echo ($data['package'] == 'Campus Discovery Tour') ? 'selected' : ''; ?>>Campus Discovery Tour</option>
                    <option <?php echo ($data['package'] == 'Innovation Gallery Visit') ? 'selected' : ''; ?>>Innovation Gallery Visit</option>
                    <option <?php echo ($data['package'] == 'Short Professional Courses') ? 'selected' : ''; ?>>Short Professional Courses</option>
                    <option <?php echo ($data['package'] == 'Guest House Stay') ? 'selected' : ''; ?>>Guest House Stay</option>
                </select>
            </div>

            <div class="ptss-form-group">
                <label class="ptss-label">Visit Date</label>
                <input type="date" name="date" class="ptss-input" value="<?php echo $data['date'] ?? ''; ?>">
            </div>

            <div class="ptss-form-group">
                <label class="ptss-label">Gender</label>
                <div class="ptss-radio-group">
                    <label><input type="radio" name="gender" value="Male" <?php echo ($data['gender'] == 'Male') ? 'checked' : ''; ?>> Male</label>
                    <label><input type="radio" name="gender" value="Female" <?php echo ($data['gender'] == 'Female') ? 'checked' : ''; ?>> Female</label>
                </div>
            </div>

            <?php 
            $text_fields = ['name', 'ic', 'institution', 'contact', 'email', 'address', 'remarks'];
            foreach ($text_fields as $f): 
            ?>
            <div class="ptss-form-group">
                <label class="ptss-label"><?php echo ucfirst($f); ?></label>
                <input type="text" name="<?php echo $f; ?>" class="ptss-input" value="<?php echo $data[$f] ?? ''; ?>">
            </div>
            <?php endforeach; ?>

            <div style="margin-top: 20px;">
                <button type="submit" name="submit" class="ptss-btn ptss-btn-warning">Update Record</button>
                <a href="list.php" class="ptss-btn ptss-btn-primary">Back to List</a>
            </div>
        </form>
    </div>
</body>
</html>