<!DOCTYPE html>
<html>

<head>
    <title>Adnan Eltaher</title>
</head>

<body>
    @if (App::getLocale() == 'ar')
        <h1>هلاً وسهلاً بكم , {{ $name }}!</h1>
        <p>سعداء جداً من أجل مساعدتك و مسرورين بإنضمامكم لنا في موقع عدنان الطاهر لتعليم القيادة
            و نتمنى لكم تجربة ممتعة و مفيدة.
            -عدنان الطاهر
            -فريق العمل</p>
    @else
        <h1>Welkom {{ $name }}!</h1>
        <p>
            Wij zijn erg blij om jou te mogen helpen met het oefenen van het auto theorie-examen.

            We wensen jou veel succes met het oefenen.

            Met vriendelijke groeten,

            Adnaan Altaher & team
        </p>
    @endif



</body>

</html>
