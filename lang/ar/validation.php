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
    
        'accepted' => 'يجب قبول :attribute.',
        'accepted_if' => 'يجب قبول :attribute عندما يكون :other :value.',
        'active_url' => 'يجب أن يكون :attribute رابطًا صالحًا.',
        'after' => 'يجب أن يكون :attribute تاريخًا بعد :date.',
        'after_or_equal' => 'يجب أن يكون :attribute تاريخًا بعد أو مساويًا لـ :date.',
        'alpha' => 'يجب أن يحتوي :attribute على حروف فقط.',
        'alpha_dash' => 'يجب أن يحتوي :attribute على حروف، أرقام، شرطات وشرطات سفلية فقط.',
        'alpha_num' => 'يجب أن يحتوي :attribute على حروف وأرقام فقط.',
        'array' => 'يجب أن يكون :attribute مصفوفة.',
        'ascii' => 'يجب أن يحتوي :attribute على رموز أحادية البايت فقط.',
        'before' => 'يجب أن يكون :attribute تاريخًا قبل :date.',
        'before_or_equal' => 'يجب أن يكون :attribute تاريخًا قبل أو مساويًا لـ :date.',
        'between' => [
            'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.',
            'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
            'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
            'string' => 'يجب أن يكون طول النص :attribute بين :min و :max حروف.',
        
    
    

   ],
    
   
    'boolean' => 'يجب أن تكون قيمة :attribute صحيحة أو خاطئة.',
    'can' => 'حقل :attribute يحتوي على قيمة غير مصرح بها.',
    'confirmed' => 'تأكيد :attribute غير مطابق.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => 'يجب أن يكون :attribute تاريخًا صحيحًا.',
    'date_equals' => 'يجب أن يكون :attribute تاريخًا مطابقًا لـ :date.',
    'date_format' => 'يجب أن يتطابق :attribute مع الشكل :format.',
    'decimal' => 'يجب أن يحتوي :attribute على :decimal منازل عشرية.',
    'declined' => 'يجب رفض :attribute.',
    'declined_if' => 'يجب رفض :attribute عندما يكون :other هو :value.',
    'different' => 'يجب أن يكون :attribute و :other مختلفين.',
    'digits' => 'يجب أن يحتوي :attribute على :digits رقمًا.',
    'digits_between' => 'يجب أن يحتوي :attribute بين :min و :max رقمًا.',
    'dimensions' => 'لـ :attribute أبعاد صورة غير صالحة.',
    'distinct' => 'لـ :attribute قيمة مكررة.',
    'doesnt_end_with' => 'يجب أن لا ينتهي :attribute بأحد القيم التالية: :values.',
    'doesnt_start_with' => 'يجب أن لا يبدأ :attribute بأحد القيم التالية: :values.',
    'email' => 'يجب أن يكون :attribute بريدًا إلكترونيًا صحيحًا.',
    'ends_with' => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values.',
    'enum' => ':attribute غير صالح.',
    'exists' => ':attribute المحدد غير صالح.',
    'extensions' => 'يجب أن يكون :attribute ملفًا من نوع: :values.',
    'file' => 'يجب أن يكون :attribute ملفًا.',
    'filled' => 'يجب أن يحتوي :attribute على قيمة.',
    'gt' => [
        'array' => 'يجب أن يحتوي :attribute على أكثر من :value عنصر.',
        'file' => 'يجب أن يكون حجم :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'string' => 'يجب أن يكون طول :attribute أكبر من :value حرفًا.',
    

    ],
    
        'gte' => [
            'array' => 'يجب أن يحتوي :attribute على :value عنصر أو أكثر.',
            'file' => 'يجب أن يكون حجم الملف :attribute أكبر من أو مساويًا لـ :value كيلوبايت.',
            'numeric' => 'يجب أن تكون قيمة :attribute أكبر من أو مساوية لـ :value.',
            'string' => 'يجب أن يكون طول النص :attribute أكبر من أو مساويًا لـ :value حروف.',
        ],
    
        
            'hex_color' => 'يجب أن يكون :attribute لونًا سداسيًا صحيحًا.',
            'image' => 'يجب أن يكون :attribute صورة.',
            'in' => ':attribute المحدد غير صالح.',
            'in_array' => 'يجب أن يكون :attribute موجودًا في :other.',
            'integer' => 'يجب أن يكون :attribute عددًا صحيحًا.',
            'ip' => 'يجب أن يكون :attribute عنوان IP صالحًا.',
            'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صالحًا.',
            'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صالحًا.',
            'json' => 'يجب أن يكون :attribute نصًا صحيحًا بصيغة JSON.',
            'lowercase' => 'يجب أن يكون :attribute بحروف صغيرة فقط.',
            'lt' => [
                'array' => 'يجب أن يحتوي :attribute على أقل من :value عنصر.',
                'file' => 'يجب أن يكون حجم الملف :attribute أقل من :value كيلوبايت.',
                'numeric' => 'يجب أن تكون قيمة :attribute أقل من :value.',
                'string' => 'يجب أن يكون طول النص :attribute أقل من :value حرفًا.',
            ],
        
        
    
            
                'lte' => [
                    'array' => 'يجب ألا يحتوي :attribute على أكثر من :value عنصر.',
                    'file' => 'يجب أن يكون حجم الملف :attribute أقل من أو يساوي :value كيلوبايت.',
                    'numeric' => 'يجب أن تكون قيمة :attribute أقل من أو تساوي :value.',
                    'string' => 'يجب أن يكون طول النص :attribute أقل من أو يساوي :value حرفًا.',
                ],
            
            
    'mac_address' => 'يجب أن يكون :attribute عنوان MAC صالحًا.',
                    'max' => [
                        'array' => 'يجب ألا يحتوي :attribute على أكثر من :max عنصر.',
                        'file' => 'يجب ألا يتجاوز حجم الملف :attribute :max كيلوبايت.',
                        'numeric' => 'يجب ألا تكون قيمة :attribute أكبر من :max.',
                        'string' => 'يجب ألا يزيد طول النص :attribute عن :max حرفًا.',
                    ],
                
                
                    
                        'max_digits' => 'يجب ألا يحتوي :attribute على أكثر من :max رقم.',
                        'mimes' => 'يجب أن يكون :attribute ملفًا من نوع: :values.',
                        'mimetypes' => 'يجب أن يكون :attribute ملفًا من نوع: :values.',
                        'min' => [
                            'array' => 'يجب أن يحتوي :attribute على الأقل على :min عنصر.',
                            'file' => 'يجب ألا يقل حجم الملف :attribute عن :min كيلوبايت.',
                            'numeric' => 'يجب ألا تقل قيمة :attribute عن :min.',
                            'string' => 'يجب ألا يقل طول النص :attribute عن :min حرف.',
                        ],
                    
                    
                        
                            'min_digits' => 'يجب أن يحتوي :attribute على الأقل :min أرقام.',
                            'missing' => 'يجب أن يكون :attribute مفقودًا.',
                            'missing_if' => 'يجب أن يكون :attribute مفقودًا عندما يكون :other هو :value.',
                            'missing_unless' => 'يجب أن يكون :attribute مفقودًا إلا إذا كان :other هو :value.',
                            'missing_with' => 'يجب أن يكون :attribute مفقودًا عندما تكون :values موجودة.',
                            'missing_with_all' => 'يجب أن يكون :attribute مفقودًا عندما تكون :values موجودة.',
                            'multiple_of' => 'يجب أن تكون قيمة :attribute مضاعفًا لـ :value.',
                            'not_in' => 'العنصر المحدد :attribute غير صالح.',
                            'not_regex' => 'صيغة :attribute غير صحيحة.',
                            'numeric' => 'يجب أن يكون :attribute رقمًا.',
                            'password' => [
                                'letters' => 'يجب أن يحتوي :attribute على حرف واحد على الأقل.',
                                'mixed' => 'يجب أن يحتوي :attribute على حرف كبير وحرف صغير على الأقل.',
                                'numbers' => 'يجب أن يحتوي :attribute على رقم واحد على الأقل.',
                                'symbols' => 'يجب أن يحتوي :attribute على رمز واحد على الأقل.',
                                'uncompromised' => 'تم العثور على :attribute في تسريب بيانات. يرجى اختيار :attribute مختلف.',
                            ],
                        
                        
                            
                                'present' => 'يجب أن يكون :attribute موجودًا.',
                                'present_if' => 'يجب أن يكون :attribute موجودًا عندما يكون :other هو :value.',
                                'present_unless' => 'يجب أن يكون :attribute موجودًا إلا إذا كان :other هو :value.',
                                'present_with' => 'يجب أن يكون :attribute موجودًا عندما تكون :values موجودة.',
                                'present_with_all' => 'يجب أن يكون :attribute موجودًا عندما تكون :values موجودة.',
                                'prohibited' => 'يجب أن يكون :attribute محظورًا.',
                                'prohibited_if' => 'يجب أن يكون :attribute محظورًا عندما يكون :other هو :value.',
                                'prohibited_unless' => 'يجب أن يكون :attribute محظورًا إلا إذا كان :other في :values.',
                                'prohibits' => 'يجب أن يحظر :attribute وجود :other.',
                                'regex' => 'صيغة :attribute غير صحيحة.',
                                'required' => ':attribute مطلوب.',
                                'required_array_keys' => 'يجب أن يحتوي :attribute على إدخالات لـ: :values.',
                                'required_if' => ':attribute مطلوب عندما يكون :other هو :value.',
                                'required_if_accepted' => ':attribute مطلوب عندما يتم قبول :other.',
                                'required_unless' => ':attribute مطلوب إلا إذا كان :other في :values.',
                                'required_with' => ':attribute مطلوب عندما تكون :values موجودة.',
                                'required_with_all' => ':attribute مطلوب عندما تكون :values موجودة.',
                                'required_without' => ':attribute مطلوب عندما لا تكون :values موجودة.',
                                'required_without_all' => ':attribute مطلوب عندما لا تكون أي من :values موجودة.',
                                'same' => 'يجب أن يتطابق :attribute مع :other.',
                            
                            
                                
                                    'size' => [
                                        'array' => 'يجب أن يحتوي :attribute على :size عنصر.',
                                        'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت.',
                                        'numeric' => 'يجب أن تكون قيمة :attribute :size.',
                                        'string' => 'يجب أن يكون طول النص :attribute :size حرفًا.',
                                    ],
                                
                                
                                    
                                        'starts_with' => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values.',
                                        'string' => 'يجب أن يكون :attribute نصًا.',
                                        'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا.',
                                        'unique' => ':attribute تم استخدامه بالفعل.',
                                        'uploaded' => 'فشل تحميل :attribute.',
                                        'uppercase' => 'يجب أن يكون :attribute بحروف كبيرة.',
                                        'url' => 'يجب أن يكون :attribute رابطًا صالحًا.',
                                        'ulid' => 'يجب أن يكون :attribute ULID صالحًا.',
                                        'uuid' => 'يجب أن يكون :attribute UUID صالحًا.',
                                    
                                    
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
                'rule-name' => 'رسالة مخصصة',
            ],
        ],
    
    

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
