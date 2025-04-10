<!-- Title -->
<title>@yield("title")</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon" />

<!-- Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
@yield('css')
<!--- Style css -->
<link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">

<!--- Style css -->
@if (App::getLocale() == 'en')
    <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
@else
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
@endif

<style>
    .dropdown-menu {
        min-width: 200px;  /* عرض القوائم المنسدلة */
        z-index: 1050; /* التأكد من ظهور القائمة فوق العناصر الأخرى */
    }

    .dropdown-item {
        padding: 10px 20px;
        font-size: 14px;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;  /* تغيير الخلفية عند التمرير */
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- تأكد من تحميل jQuery -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.4/dist/umd/popper.min.js"></script> <!-- تأكد من تحميل Popper -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- تأكد من تحميل Bootstrap -->
