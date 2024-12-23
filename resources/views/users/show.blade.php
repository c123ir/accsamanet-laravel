<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مشخصات کاربر</title>
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
</head>
<body>
<div class="container mt-5">
    <h2>مشخصات کاربر</h2>
    <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">بازگشت به لیست</a>

    <div class="card">
        <div class="card-header">
            {{ $user->username }}
        </div>
        <div class="card-body">
            <p><strong>نام:</strong> {{ $user->first_name }}</p>
            <p><strong>نام خانوادگی:</strong> {{ $user->last_name }}</p>
            <p><strong>ایمیل:</strong> {{ $user->email }}</p>
            <p><strong>تلفن:</strong> {{ $user->phone_number }}</p>
            <p><strong>وضعیت:</strong> {{ $user->is_active ? 'فعال' : 'غیرفعال' }}</p>
            <p><strong>تاریخ شروع:</strong> {{ $user->start_date_shamsi }}</p>
            <p><strong>تاریخ پایان:</strong> {{ $user->end_date_shamsi }}</p>
            @if($user->profile_pic)
                <p><strong>عکس پروفایل:</strong></p>
                <img src="{{ asset('images/profiles/' . $user->profile_pic) }}" alt="Profile Picture" width="150">
            @endif
            <p><strong>ایجاد شده توسط:</strong> {{ $user->creator ? $user->creator->name : 'نامشخص' }}</p>
        </div>
    </div>
</div>
</body>
</html>