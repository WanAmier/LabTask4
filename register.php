<?php
$errors = [];
// Fields excluding the special ones (package, gender, date)
$text_fields = ['name', 'ic', 'institution', 'contact', 'email', 'address', 'remarks'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST;
    
    // Validation
    if (empty($data['package'])) $errors['package'] = "Required";
    if (empty($data['gender'])) $errors['gender'] = "Required";
    if (empty($data['date'])) $errors['date'] = "Required";
    foreach ($text_fields as $f) { 
        if (empty($data[$f])) $errors[$f] = "Required"; 
    }

    if (empty($errors)) {
        if (!is_dir('registrations')) { mkdir('registrations'); }
        $filename = "registrations/" . preg_replace('/[^a-z0-9]/i', '', $data['name']) . "" . time() . ".txt";
        $file = fopen($filename, "w");
        foreach ($data as $key => $value) {
            if ($key != 'submit') fwrite($file, ucfirst($key) . ": " . $value . "\n");
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
        <h2 class="ptss-title">Package Booking Form</h2>
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
                <div class="ptss-error"><?php echo $errors['package'] ?? ''; ?></div>
            </div>

            <div class="ptss-form-group">
                <label class="ptss-label">Visit Date</label>
                <input type="date" name="date" class="ptss-input">
                <div class="ptss-error"><?php echo $errors['date'] ?? ''; ?></div>
            </div>

            <div class="ptss-form-group">
                <label class="ptss-label">Gender</label>
                <div style="padding: 10px 0;">
                    <input type="radio" name="gender" value="Male" id="male"> 
                    <label for="male" style="margin-right: 20px;">Male</label>
                    
                    <input type="radio" name="gender" value="Female" id="female"> 
                    <label for="female">Female</label>
                </div>
                <div class="ptss-error"><?php echo $errors['gender'] ?? ''; ?></div>
            </div>

            <?php foreach ($text_fields as $f): ?>
            <div class="ptss-form-group">
                <label class="ptss-label"><?php echo ucfirst($f); ?></label>
                <input type="text" name="<?php echo $f; ?>" class="ptss-input">
                <div class="ptss-error"><?php echo $errors[$f] ?? ''; ?></div>
            </div>
            <?php endforeach; ?>

            <div style="margin-top: 30px;">
                <button type="submit" class="ptss-btn ptss-btn-success">Confirm Booking</button>
                <a href="index.php" class="ptss-btn ptss-btn-primary">Back Home</a>
            </div>
        </form>
    </div>
</body>
</html>