<!DOCTYPE html>
<html class="ptss-body">
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="ptss-card" style="max-width: 600px; margin: auto;">
        <h2 class="ptss-title">Visitor Registration</h2>
        <form action="process.php?action=create" method="POST">
            <div class="ptss-form-group">
                <label class="ptss-label">Choose Package</label>
                <select name="package" class="ptss-input" required>
                    <option value="">-- Select --</option>
                    <option>Campus Discovery Tour</option>
                    <option>Innovation Gallery Visit</option>
                    <option>Short Professional Courses</option>
                    <option>Guest House Stay</option>
                </select>
            </div>

            <div class="ptss-form-group">
                <label class="ptss-label">Visit Date</label>
                <input type="date" name="date" class="ptss-input" required>
            </div>

            <div class="ptss-form-group">
                <label class="ptss-label">Gender</label>
                <div class="ptss-radio-group">
                    <label><input type="radio" name="gender" value="Male" required> Male</label>
                    <label><input type="radio" name="gender" value="Female"> Female</label>
                </div>
            </div>

            <?php 
            $fields = ['name', 'ic', 'institution', 'contact', 'email', 'address', 'remarks'];
            foreach ($fields as $f): 
            ?>
            <div class="ptss-form-group">
                <label class="ptss-label"><?php echo ucfirst($f); ?></label>
                <input type="text" name="<?php echo $f; ?>" class="ptss-input" required>
            </div>
            <?php endforeach; ?>

            <button type="submit" class="ptss-btn ptss-btn-success">Submit Registration</button>
            <a href="index.php" class="ptss-btn ptss-btn-primary">Cancel</a>
        </form>
    </div>
</body>
</html>