<?php
// بدء الجلسة للتحقق من تسجيل الدخول
session_start();

// التحقق من تسجيل الدخول
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// قراءة ملف الحجوزات
$file = 'bookings.csv';

?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم المدير - سجل الحجوزات</title>
    <link rel="stylesheet" href="admin_styles.css">
    <!-- إضافة خط Cairo من Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <!-- إضافة Font Awesome للأيقونات -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>

<header>
    <div class="container">
        <h1>لوحة تحكم المدير</h1>
        <nav>
            <a href="#">الرئيسية</a>
            <a href="logout.php">تسجيل الخروج <i class="fas fa-sign-out-alt"></i></a>
        </nav>
    </div>
</header>

<main>
    <div class="container">
        <h2>سجل الحجوزات</h2>

        <?php
        if (!file_exists($file) || filesize($file) == 0) {
            echo '<p class="no-bookings">لا توجد حجوزات حالياً.</p>';
        } else {
            echo '<table>';
            $handle = fopen($file, 'r');
            $is_header = true;

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($is_header) {
                    echo '<thead><tr>';
                    foreach ($data as $cell) {
                        echo '<th>' . htmlspecialchars($cell) . '</th>';
                    }
                    echo '</tr></thead><tbody>';
                    $is_header = false;
                } else {
                    echo '<tr>';
                    foreach ($data as $cell) {
                        echo '<td>' . htmlspecialchars($cell) . '</td>';
                    }
                    echo '</tr>';
                }
            }
            echo '</tbody></table>';
            fclose($handle);
        }
        ?>

    </div>
</main>

<footer>
    <div class="container">
        <p>جميع الحقوق محفوظة &copy; 2023</p>
    </div>
</footer>

</body>
</html>
