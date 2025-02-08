// عرض النموذج المناسب عند الضغط على الأيقونات
document.getElementById('soloBtn').addEventListener('click', function() {
    document.getElementById('soloForm').style.display = 'block';
    document.getElementById('familyForm').style.display = 'none';
});

document.getElementById('familyBtn').addEventListener('click', function() {
    document.getElementById('familyForm').style.display = 'block';
    document.getElementById('soloForm').style.display = 'none';
});

// إنشاء حقول المسافرين بناءً على العدد المدخل
document.getElementById('numTravelers').addEventListener('input', generateTravelerFields);
document.getElementById('numChildren').addEventListener('input', generateTravelerFields);

function generateTravelerFields() {
    const numTravelers = parseInt(document.getElementById('numTravelers').value) || 0;
    const numChildren = parseInt(document.getElementById('numChildren').value) || 0;
    const totalPassengers = numTravelers + numChildren;

    const container = document.getElementById('travelersInfo');
    container.innerHTML = '';

    for (let i = 1; i <= totalPassengers; i++) {
        const travelerDiv = document.createElement('div');
        travelerDiv.innerHTML = `
            <h3>بيانات المسافر ${i}</h3>
            <label>إسم المسافر مطابق للجواز:
                <input type="text" name="name${i}" required>
            </label>
            <label>رقم الجواز:
                <input type="text" name="passport_number${i}" required>
            </label>
            <label>تاريخ الميلاد:
                <input type="date" name="birth_date${i}" required>
            </label>
            <label>تاريخ إصدار الجواز:
                <input type="date" name="passport_issue${i}" required>
            </label>
            <label>تاريخ انتهاء الجواز:
                <input type="date" name="passport_expiry${i}" required>
            </label>
        `;
        container.appendChild(travelerDiv);
    }
}
