<?php
// استقبال التكلفة الإجمالية من `process.php`
$total_cost = $_POST['total_cost'];
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>صفحة الدفع</title>
<link rel="stylesheet" href="payment_styles.css">
<!-- إضافة خط Cairo من Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
<!-- إضافة Font Awesome للأيقونات -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>

<h1>صفحة الدفع</h1>

<div class="payment-summary">
    <h2>التكلفة الإجمالية: <span><?php echo $total_cost; ?>جنيه سوداني</span></h2>
</div>

<div class="bank-details">
    <h2>تفاصيل الحسابات البنكية</h2>
    <div class="bank-account">
        <h3><i class="fas fa-university"></i> بنك الخرطوم</h3>
        <p>رقم الحساب: <span>3296130</span></p>
        <p>إسم الحساب: <span>معتز مدثر علي بابكر</span></p>
    </div>
    <div class="bank-account">
        <h3><i class="fas fa-university"></i> بنك فيصل</h3>
        <p>رقم الحساب: <span>51253286</span></p>
        <p>إسم الحساب: <span></span>معتز مدثر علي بابكر</p>
    </div>
</div>

<div class="instructions">
    <p>يرجى اختيار أحد الحسابات البنكية أعلاه لإتمام عملية الدفع. بعد إجراء الدفع، يرجى التواصل معنا عبر واتساب لتأكيد الحجز.</p>
</div>

<div class="contact">
    <a href="https://wa.me/+249912500618" class="whatsapp-button">
        <i class="fab fa-whatsapp"></i> تواصل معنا عبر واتساب
    </a>
</div>

<div class="thank-you">
    <p>شكراً لاختياركم خدماتنا، نتمنى لكم رحلة سعيدة</p>
    <a href="about.html">MUTAZ HIGHFLAYERS</a>
    <P></P>
</div>

</body>
</html>
