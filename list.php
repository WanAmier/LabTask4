<!DOCTYPE html>
<html class="ptss-body">
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="ptss-card">
        <h2 class="ptss-title">Registration List</h2>
        <table class="ptss-table">
            <thead>
                <tr>
                    <th class="ptss-th">Visitor Name</th>
                    <th class="ptss-th">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $files = glob("registrations/*.txt");
                foreach ($files as $file) {
                    $name = basename($file, ".txt");
                    echo "<tr>
                        <td class='ptss-td'>$name</td>
                        <td class='ptss-td'>
                            <a href='view.php?file=$file' class='ptss-btn ptss-btn-primary'>View</a>
                            <a href='update.php?file=$file' class='ptss-btn ptss-btn-warning'>Edit</a>
                            <a href='delete.php?file=$file' class='ptss-btn ptss-btn-danger' onclick='return confirmDelete()'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <div style="margin-top:20px;"><a href="index.php" class="ptss-btn ptss-btn-success">New Registration</a></div>
    </div>
    <script src="script.js"></script>
</body>
</html>