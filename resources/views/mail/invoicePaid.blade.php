@component('mail::message')
<div style="text-align: right; direction: rtl !important;">
    <p>مرحبًا <span>Journo Gouvana</span></p>
    <p>نأمل أن تكونوا بأتم الصحة والعافية. نرغب في إعلامكم بأن الفاتورة قد دفعت بنجاح.</p>
    <p>
        <span>و ذالك بتوقيت</span> &nbsp;
        <span style="color: #2196F3;">{{ date('m:i a') }} >
        <span> الموافق ل</span> &nbsp;
        <span style="color: #2196F3;">{{ date('Y F l') }}</span>
    </p>
</div>

@component('mail::button', ['url' => $url, 'color' => 'primary'])
الذهاب للصفحة
@endcomponent

<div style="text-align: right; direction: rtl !important;">
    <p>إذا كان لديكم أي استفسار أو تحتاجون إلى مزيد من المساعدة، فلا تترددوا في التواصل معنا.</p>
    <p>نشكركم على تعاونكم.</p>
    <p>مع أطيب التحيات،</p>
</div>

{{ config('app.name') }}
@endcomponent
