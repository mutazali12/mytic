<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>حجز الرحلات</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="main-content">    

<h1>حجز الرحلات</h1>

<div class="options">
    <button id="soloBtn">مسافر بمفردي</button>
    <button id="familyBtn">مسافر مع أسرتي</button>
</div>

<form id="soloForm" action="process.php" method="post" style="display: none;">
    <h2>بيانات المسافر</h2>
    <!-- حقول مسافر بمفرده -->
    <label>إسم المسافر مطابق للجواز:
        <input type="text" name="name" required>
    </label>
    <label>رقم الجواز:
        <input type="text" name="passport_number" required>
    </label>
    <label>تاريخ إصدار الجواز:
        <input type="date" name="passport_issue" required>
    </label>
    <label>تاريخ انتهاء الجواز:
        <input type="date" name="passport_expiry" required>
    </label>
    <label>مطار المغادرة:
        <input type="text" name="departure_airport" required>
    </label>
    <label>مطار الوصول:
        <input type="text" name="arrival_airport" required>
    </label>
    <label>تاريخ الرحلة:
        <input type="date" name="travel_date" required>
    </label>
    <label>الدرجة:
        <select name="class" required>
            <option value="economy">اقتصادية</option>
            <option value="business">أعمال</option>
        </select>
    </label>
    <label>رقم الهاتف (واتساب):
        <input type="tel" name="phone" required>
    </label>
    <button type="submit">متابعة للدفع</button>
</form>

<form id="familyForm" action="process.php" method="post" style="display: none;">
    <h2>بيانات العائلة</h2>
    <!-- بيانات عدد المسافرين والأطفال -->
    <label>عدد المسافرين:
        <input type="number" id="numTravelers" name="num_travelers" min="1" required>
    </label>
    <label>عدد الأطفال أقل من 11 سنة:
        <input type="number" id="numChildren" name="num_children" min="0" required>
    </label>
    <div id="travelersInfo"></div>
    <!-- معلومات ثابتة -->
    <label>مطار المغادرة:
        <input type="text" name="departure_airport" required>
    </label>
    <label>مطار الوصول:
        <input type="text" name="arrival_airport" required>
    </label>
    <label>تاريخ الرحلة:
        <input type="date" name="travel_date" required>
    </label>
    <label>الدرجة:
        <select name="class" required>
            <option value="economy">اقتصادية</option>
            <option value="business">أعمال</option>
        </select>
    </label>
    <label>رقم الهاتف (واتساب):
        <input type="tel" name="phone" required>
    </label>
    <button type="submit">متابعة للدفع</button>
</form>

<script src="script.js"></script>

</div>

</body>
<footer class="fo4-footer"> 

	<div class="fo4-footer-container">	
		<div class="fo4-footer-logo">
			<a href="/" title="Foter" class=""></a>
		</div>
	
		<div class="fo4-footer-links">
			<ul>
				<li><a href="/about/"></a></li>
				<li><a href="/about/#contact"></a></li>
            	<li><a href="/about/#advertise"></a></li>
            	<li><a href="/about/#media-kit"></a></li>  
			</ul>
			
			<ul>
				<li><a href="/about/#editorial-policy"></a></li>
				<li><a href="/about/#jobs"></a></li>
				<li><a href="/about/#help"></a></li>
			</ul>
			
			<ul>
				<li><a href="/terms/"></a></li>
            	<li><a href="/terms/#privacy-policy"></a></li>
            	<li><a href="/terms/#do-not-sell-my-info"></a></li>
			</ul>
		</div>

		<div class="fo4-footer-pro">
			<h4>مرحباً بك في تطبيق نذكرتي</h4>
			<ul>
				<li><a href=""></a></li>
				<li><span></span></li>
				<li><a href="/returns-refunds/"></a></li>
							</ul>
		</div>

			</div>
	
	<div class="fo4-footer-bottom">
		<div class="fo4-footer-rights">
			<div class="fo4-footer-share">
				<a target="_blank" href="" class="icon icon-white-pin"></a>
    			<a target="_blank" href="" class="icon icon-white-insta"></a>
    			<a target="_blank" href=""></a>
    			<a target="_blank" href="" class="icon icon-white-fb"></a>
    		</div>
		
	 		<p> ©  2025 MUTAZ HIGH FLAYERS - All rights reserved mutazlifezone@gmail.com +249912500618</p> 
		</div>
	</div>

</footer>
</html>
