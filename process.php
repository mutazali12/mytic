<?php
// بدء جلسة لتخزين بيانات الحجز
session_start();

// تضمين جدول الأسعار
include 'prices.php';

// استقبال البيانات من النموذج (سواءً من مسافر بمفرده أو مع أسرة)
$departure_airport = $_POST['departure_airport'];
$arrival_airport = $_POST['arrival_airport'];
$class = $_POST['class'];
$travel_date = $_POST['travel_date'];
$phone = $_POST['phone'];

if (isset($_POST['num_travelers'])) {
    // **مسافر مع أسرة**
    $num_travelers = intval($_POST['num_travelers']);
    $num_children = intval($_POST['num_children']);
    $total_passengers = $num_travelers + $num_children;

    // جمع بيانات المسافرين
    $travelers = [];
    for ($i = 1; $i <= $total_passengers; $i++) {
        $traveler = [
            'name' => $_POST['name' . $i],
            'passport_number' => $_POST['passport_number' . $i],
            'birth_date' => $_POST['birth_date' . $i],
            'passport_issue' => $_POST['passport_issue' . $i],
            'passport_expiry' => $_POST['passport_expiry' . $i],
        ];
        $travelers[] = $traveler;
    }
} else {
    // **مسافر بمفرده**
    $total_passengers = 1;
    $traveler = [
        'name' => $_POST['name'],
        'passport_number' => $_POST['passport_number'],
        'passport_issue' => $_POST['passport_issue'],
        'passport_expiry' => $_POST['passport_expiry'],
    ];
    $travelers = [$traveler];
}

// **حساب التكلفة الإجمالية**
$price_per_ticket = getPrice($departure_airport, $arrival_airport, $class);
$total_cost = $price_per_ticket * $total_passengers;

// **حفظ بيانات الحجز في ملف CSV**
$file = 'bookings.csv';

// تجهيز البيانات للحفظ
$booking_data = [];

// إضافة البيانات العامة
$booking_data[] = $departure_airport; // مطار المغادرة
$booking_data[] = $arrival_airport;   // مطار الوصول
$booking_data[] = $travel_date;       // تاريخ الرحلة
$booking_data[] = ($class == 'economy' ? 'اقتصادية' : 'أعمال'); // الدرجة
$booking_data[] = $phone;             // رقم الهاتف
$booking_data[] = $total_passengers;  // عدد المسافرين
$booking_data[] = $total_cost;        // التكلفة الإجمالية

// إضافة بيانات كل مسافر
foreach ($travelers as $traveler) {
    $booking_data[] = $traveler['name'];             // اسم المسافر
    $booking_data[] = $traveler['passport_number'];  // رقم الجواز
    if (isset($traveler['birth_date'])) {
        $booking_data[] = $traveler['birth_date'];   // تاريخ الميلاد
    }
    $booking_data[] = $traveler['passport_issue'];   // تاريخ إصدار الجواز
    $booking_data[] = $traveler['passport_expiry'];  // تاريخ انتهاء الجواز
}

// فتح الملف في وضع الإلحاق
$handle = fopen($file, 'a');

// إذا كان الملف فارغاً، نضيف صف العناوين
if (filesize($file) == 0) {
    $headers = ['مطار المغادرة', 'مطار الوصول', 'تاريخ الرحلة', 'الدرجة', 'رقم الهاتف', 'عدد المسافرين', 'التكلفة الإجمالية'];

    // إضافة عناوين لبيانات المسافرين
    $traveler_count = count($travelers);
    for ($i = 1; $i <= $traveler_count; $i++) {
        $headers[] = "اسم المسافر $i";
        $headers[] = "رقم جواز المسافر $i";
        if (isset($travelers[$i - 1]['birth_date'])) {
            $headers[] = "تاريخ ميلاد المسافر $i";
        }
        $headers[] = "تاريخ إصدار جواز المسافر $i";
        $headers[] = "تاريخ انتهاء جواز المسافر $i";
    }

    fputcsv($handle, $headers);
}

// كتابة البيانات في الملف
fputcsv($handle, $booking_data);

// إغلاق الملف
fclose($handle);

// **حفظ بيانات الحجز في الجلسة لعرضها في صفحة الملخص والدفع**
$_SESSION['booking'] = [
    'departure_airport' => $departure_airport,
    'arrival_airport' => $arrival_airport,
    'travel_date' => $travel_date,
    'class' => $class,
    'phone' => $phone,
    'total_passengers' => $total_passengers,
    'total_cost' => $total_cost,
    'travelers' => $travelers,
];

// **عرض ملخص الحجز للمستخدم**

echo '<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>ملخص الحجز</title>
<style>
    body {
        font-family: Arial, sans-serif;
        direction: rtl;
        margin: 20px;
    }
    h1, h2, h3 {
        text-align: center;
    }
    p {
        font-size: 18px;
    }
    .summary {
        max-width: 800px;
        margin: 0 auto;
    }
    .summary p {
        margin-bottom: 10px;
    }
    .traveler {
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }
    .traveler:last-child {
        border-bottom: none;
    }
    .payment-button {
        text-align: center;
        margin-top: 20px;
    }
    .payment-button button {
        padding: 15px 30px;
        font-size: 18px;
    }
</style>
</head>
<body>';

echo "<h1>ملخص الحجز الخاص بك</h1>";
echo "<div class='summary'>";
echo "<p><strong>مطار المغادرة:</strong> $departure_airport</p>";
echo "<p><strong>مطار الوصول:</strong> $arrival_airport</p>";
echo "<p><strong>تاريخ الرحلة:</strong> $travel_date</p>";
echo "<p><strong>درجة السفر:</strong> " . ($class == 'economy' ? 'اقتصادية' : 'أعمال') . "</p>";
echo "<p><strong>عدد المسافرين:</strong> $total_passengers</p>";
echo "<p><strong>التكلفة الإجمالية:</strong> $total_cost دولار</p>";

echo "<h2>بيانات المسافرين:</h2>";

foreach ($travelers as $index => $traveler) {
    $num = $index + 1;
    echo "<div class='traveler'>";
    echo "<h3>مسافر $num</h3>";
    echo "<p><strong>الاسم:</strong> {$traveler['name']}</p>";
    echo "<p><strong>رقم الجواز:</strong> {$traveler['passport_number']}</p>";
    if (isset($traveler['birth_date'])) {
        echo "<p><strong>تاريخ الميلاد:</strong> {$traveler['birth_date']}</p>";
    }
    echo "<p><strong>تاريخ إصدار الجواز:</strong> {$traveler['passport_issue']}</p>";
    echo "<p><strong>تاريخ انتهاء الجواز:</strong> {$traveler['passport_expiry']}</p>";
    echo "</div>";
}

echo "<p><strong>سيتم التواصل معك عبر واتساب على الرقم:</strong> $phone</p>";

echo "<div class='payment-button'>";
echo "<form action='payment.php' method='post'>";
echo "<input type='hidden' name='total_cost' value='$total_cost'>";
echo "<button type='submit'>الانتقال إلى صفحة الدفع</button>";
echo "</form>";
echo "</div>";

echo "</div>";
echo "</body></html>";
?>
