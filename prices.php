php
function getPrice($departure, $arrival, $class) {
     جدول أسعار الرحلات
    $prices = [
        'مطار الرياض_مطار جدة' = [
            'economy' = 100,
            'business' = 300
        ],
        'مطار الرياض_مطار دبي' = [
            'economy' = 200,
            'business' = 500
        ],
         أضف المزيد من الأسعار حسب الحاجة
    ];

    $key = $departure . '_' . $arrival;

    if(isset($prices[$key][$class])) {
        return $prices[$key][$class];
    } else {
         سعر افتراضي في حال عدم العثور على السعر
        return 150;
    }
}

