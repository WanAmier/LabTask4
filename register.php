<?php
$errors = [];
$fields = ['name', 'ic', 'institution', 'date', 'contact', 'email', 'gender', 'address', 'remarks'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST;
    if (empty($data['package'])) $errors['package'] = "Selection required";
    foreach ($fields as $f) { if (empty($data[$f])) $errors[$f] = "Required"; }

    if (empty($errors)) {
        if (!is_dir('registrations')) { mkdir('registrations'); }
        $filename = "registrations/" . preg_replace('/[^a-z0-9]/i', '_', $data['name']) . "_" . time() . ".txt";
        $file = fopen($filename, "w");
        foreach ($data as $key => $value) {
            fwrite($file, ucfirst($key) . ": " . $value . "\n");
        }
        fclose($file);
        header("Location: list.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html class="ptss-body">
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="ptss-card">
        <h2 class="ptss-title">Package Booking</h2>
        <form method="POST">
            <div class="ptss-form-group">
                <label class="ptss-label">Selected Package</label>
                <select name="package" class="ptss-input">
                    <option value="">-- Select a Package --</option>
                    <option>Campus Discovery Tour</option>
                    <option>Innovation Gallery Visit</option>
                    <option>Short Professional Courses</option>
                    <option>Guest House Stay</option>
                </select>
            </div>
            
            <?php foreach ($fields as $f): ?>
            <div class="ptss-form-group">
                <label class="ptss-label"><?php echo ucfirst($f); ?></label>
                <input type="text" name="<?php echo $f; ?>" class="ptss-input">
                <div class="ptss-error"><?php echo $errors[$f] ?? ''; ?></div>
            </div>
            <?php endforeach; ?>

            <button type="submit" class="ptss-btn ptss-btn-success">Confirm Booking</button>
            <a href="index.php" class="ptss-btn ptss-btn-primary">Back Home</a>
        </form>
    </div>
</body>
</html>