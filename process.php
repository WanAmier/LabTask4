<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // 1. CREATE RECORD
    if ($action == 'create' && $_SERVER["REQUEST_METHOD"] == "POST") {
        $data = $_POST;
        if (!is_dir('registrations')) { mkdir('registrations'); }
        
        $clean_ic = preg_replace('/[^A-Za-z0-9]/', '', $data['ic']);
        $filename = "registrations/" . $clean_ic . ".txt";
        
        $file = fopen($filename, "w");
        foreach ($data as $key => $value) {
            fwrite($file, ucfirst($key) . ": " . $value . "\n");
        }
        fclose($file);
        header("Location: list.php?msg=created");
        exit();
    }

    // 2. UPDATE RECORD
    if ($action == 'update' && $_SERVER["REQUEST_METHOD"] == "POST") {
        $file_path = $_POST['target_file'];
        $handle = fopen($file_path, "w");
        foreach ($_POST as $key => $value) {
            if ($key != 'target_file' && $key != 'submit') {
                fwrite($handle, ucfirst($key) . ": " . $value . "\n");
            }
        }
        fclose($handle);
        header("Location: list.php?msg=updated");
        exit();
    }

    // 3. DELETE RECORD
    if ($action == 'delete') {
        $file = $_GET['file'];
        if (file_exists($file)) { unlink($file); }
        header("Location: list.php?msg=deleted");
        exit();
    }
}
?>