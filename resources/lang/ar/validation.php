<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'لابد من قبول :attribute',
    'active_url'           => ':attribute يجب ان يكون على هيئة رابط',
    'after'                => ':attribute يجب أن يكون تاريخ بعد :date.',
    'after_or_equal'       => ':attribute يجب أن يكون تاريخ بعد أو مساوي لـ :date.',
    'alpha'                => ':attribute يجب أن يحتوي على احرف فقط',
    'alpha_dash'           => ':attribute يجب ان يحتوي على احرف أو ارقام أو داش (-)',
    'alpha_num'            => ':attribute يجب ان يحتوي على احرف أو ارقام فقط',
    'array'                => ':attribute يجب ان يكون على هيئة مصفوفة',
    'before'               => ':attribute يجب ان يكون تاريخ قبل :date.',
    'before_or_equal'      => ':attribute يجب أن يكون تاريخ قبل أو مساوي لـ :date.',
    'between'              => [
        'numeric' => ':attribute يجب أن يكون بين :min و :max.',
        'file'    => ':attribute يجب ان يكون بين :min و :max كيلوبايت',
        'string'  => ':attribute يجب ان يكون بين :min و :max احرف',
        'array'   => ':attribute يجب ان يحتوي بين :min و :max عنصر',
    ],
    'boolean'              => ':attribute لابد ان يحتوي قيمة ( صحيح أو خطأ )',
    'confirmed'            => ':attribute غير متطابق مع التأكيد',
    'date'                 => ':attribute يجب ان يحتوي على تاريخ',
    'date_format'          => ':attribute غير متطابق مع التنسيق :format',
    'different'            => ':attribute و :other يجب ان يكونوا مختلفين',
    'digits'               => ':attribute يجب ان يكون :digits رقم',
    'digits_between'       => ':attribute يجب ان يكون بين :min و :max رقم',
    'dimensions'           => ':attribute يحتوى على ابعاد صورة غير صالحة',
    'distinct'             => ':attribute يحتوى الحقل على قيمة مكررة',
    'email'                => ':attribute يجب ان يحتوي على بريد إلكتروني',
    'exists'               => 'القيمة المختاره :attribute غير صحيحة',
    'file'                 => ':attribute يجب ان يكون ملف',
    'filled'               => ':attribute يجب ان يحتوي على قيمة',
    'image'                => ':attribute يجب ان يكون صورة',
    'in'                   => 'القيمة المختاره :attribute غير صحيحه',
    'in_array'             => ':attribute يجب ان يكون ضمن :other.',
    'integer'              => ':attribute يجب ان يكون رقم',
    'ip'                   => ':attribute يجب ان يحتوى على عنوان IP',
    'ipv4'                 => ':attribute يجب ان يحتوي على IPv4',
    'ipv6'                 => ':attribute يجب ان يحتوي على IPv6',
    'json'                 => ':attribute يجب ان يحتوى على JSON',
    'max'                  => [
        'numeric' => ':attribute قد لا يكون اكبر من :max',
        'file'    => ':attribute قد لا يكون اكبر من :max كيلوبايت',
        'string'  => ':attribute قد لا يكون اكبر من :max احرف',
        'array'   => ':attribute قد لا يحتوي اكثر من :max عنصر',
    ],
    'mimes'                => ':attribute يجب ان يكون ملف من النوع: :values',
    'mimetypes'            => ':attribute يجب ان يكون ملف من النوع: :values',
    'min'                  => [
        'numeric' => ':attribute يجب ان يكون على الاقل :min',
        'file'    => ':attribute يجب ان يكون على الاقل :min كيلوبايت',
        'string'  => ':attribute يجب ان يكون على الاقل :min حرف',
        'array'   => ':attribute يجب ان يكون على الاقل :min عنصر',
    ],
    'not_in'               => 'القيمة المختاره :attribute غير صحيحه',
    'numeric'              => ':attribute يجب ان يكون رقم',
    'present'              => ':attribute يجب ان يكون المجال موجوداً',
    'regex'                => ':attribute النسق غير صحيح',
    'required'             => 'يجب تعبئته :attribute',
    'required_if'          => ':attribute يجب تعبئة الحقل عندما :other يكون :value',
    'required_unless'      => ':attribute الحقل مطلوب ما لم :other موجود في :values',
    'required_with'        => ':attribute يجب تعبئة الحقل عندما :values في المجال',
    'required_with_all'    => ':attribute يجب تعبئة الحقل عندما :values في المجال',
    'required_without'     => ':attribute يجب تعبئة الحقل عندما :values غير موجود فى المجال',
    'required_without_all' => ':attribute حقل مطلوب عندما لا شيء من :values حاضرون',
    'same'                 => ':attribute و :other يجب أن تتطابق',
    'size'                 => [
        'numeric' => ':attribute يجب ان يكون :size',
        'file'    => ':attribute يجب ان يكون :size كيلوبايت',
        'string'  => ':attribute يجب ان يكون :size حرف',
        'array'   => ':attribute يجب ان يحتوي :size عنصر',
    ],
    'string'               => ':attribute يجب ان يكون نص',
    'timezone'             => ':attribute المنطقة غير صالحة',
    'unique'               => ':attribute مسجل لدينا بالفعل',
    'uploaded'             => ':attribute غير قادر على رفع الملف',
    'url'                  => ':attribute النسق غير صحيح',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
