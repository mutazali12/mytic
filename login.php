<?php
session_start();

$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // بيانات تسجيل الدخول (يمكن تعديلها حسب الرغبة)
    $admin_username = 'admin';
    $admin_password = 'password123';

    if($username === $admin_username && $password === $admin_password) {
        $_SESSION['logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'اسم المستخدم أو كلمة المرور غير صحيحة.';
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>تسجيل الدخول</title>
<style>
    body {
        font-family: Arial, sans-serif;
        direction: rtl;
        text-align: center;
        padding-top: 50px;
    }
    form {
        display: inline-block;
        margin-top: 20px;
    }
    label {
        display: block;
        margin-bottom: 10px;
    }
    input {
        padding: 8px;
        width: 200px;
    }
    .error {
        color: red;
    }
</style>
</head>
<body>

<h1>تسجيل الدخول للمدير</h1>

<?php if($error): ?>
    <p class="error"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="login.php">
    <label>اسم المستخدم:
        <input type="text" name="username" required>
    </label>
    <label>كلمة المرور:
        <input type="password" name="password" required>
    </label>
    <button type="submit">تسجيل الدخول</button>
</form>

</body>
</html>
