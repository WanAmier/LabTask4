<?php
$errors = [];
$fields = ['name', 'ic', 'institution', 'package', 'date', 'contact', 'email', 'gender', 'address', 'remarks'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [];
    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = "This field is required";
        } else {
            $data[$field] = $_POST[$field];
        }
    }

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
        <h2 class="ptss-title">Visit PTSS 2026 Registration</h2>
        <form method="POST">
            <?php foreach ($fields as $f): ?>
            <div class="ptss-form-group">
                <label class="ptss-label"><?php echo ucfirst($f); ?></label>
                <input type="text" name="<?php echo $f; ?>" class="ptss-input">
                <div class="ptss-error"><?php echo $errors[$f] ?? ''; ?></div>
            </div>
            <?php endforeach; ?>
            <button type="submit" class="ptss-btn ptss-btn-success">Register Now</button>
            <a href="list.php" class="ptss-btn ptss-btn-primary">View Records</a>
        </form>
    </div>
</body>
</html>