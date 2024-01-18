<?php

return [

    'name' => 'تقدُم',
    'model' => [
        'program' => 'البرامج',
        'applicant' => 'المتقدمين',
        'application' => 'الطلبات المقدمة',
        'criteria' => 'المعايير',
        'exam_result' => 'نتائج الامتحانات',
        'exam' => 'الامتحانات',
        'interview' => 'المقابلة',
        'interviewer' => 'المقابلين',
        'interview_result' => 'نتائج المقابلات',
        'review' => 'المراجعات',
        'reviewer' => 'المراجعين',
        'status' => 'حالات الطلبات المقدمة',
        'result' => 'النتائج العامة',
        'faq' => 'الأسئلة الشائعة',
    ],
    'program' => [
        'name' => 'اسم البرنامج',
        'image' => 'الصورة',
        'description' => 'وصف البرنامج',
        'status' => 'حالة البرنامج',
        'start_date' => 'تاريخ البدء',
        'end_date' => 'تاريخ الانتهاء',
        'student_count' => 'الطاقة الاستيعابية',
        'is_published' => 'السماح بالنشر'
    ],
    'user' => [
        'name' => 'الاسم',
        'email' => 'الإيميل',
        'password' => 'كلمة السر',
    ],
    'interview' => [
        'interview_date' => 'موعد المقابلة',
        'min_rate' => 'معدل اجتياز المقابلة'
    ],
    'status' => [
        'name' => 'حالة الطلب',
    ],
    'review' => [
        'note' => 'الملاحظات',
    ],
    'interview_result' => [
        'note' => 'الملاحظات',
    ],
    'result' => [
        'result' => 'النتائج',
    ],
    'criteria' => [
        'name' => 'المعيار',
    ],
    'application' => [
        'values' => 'بيانات الطلب',
    ],
    'exam_result' => [
        'note' => 'الملاحظات',
        'exam_degree' => 'درجة الامتحان',
    ],
    'exam' => [
        'min_degree' => 'درجة الإقصاء',
        'exam_date' => 'تاريخ الإمتحان',
    ],
    'faq' => [
        'question' => 'السوال',
        'answer' => 'الإجابة',
    ]

];
