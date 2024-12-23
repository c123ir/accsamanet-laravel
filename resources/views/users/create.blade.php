<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ایجاد کاربر جدید</title>
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
</head>
<body>
<div class="container mt-5">
    <h2>ایجاد کاربر جدید</h2>
    <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">بازگشت به لیست</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>خطا!</strong> لطفاً موارد زیر را بررسی کنید.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="username">نام کاربری:</label>
            <input type="text" name="username" class="form-control" placeholder="نام کاربری را وارد کنید" value="{{ old('username') }}" required>
        </div>

        <div class="form-group">
            <label for="first_name">نام:</label>
            <input type="text" name="first_name" class="form-control" placeholder="نام را وارد کنید" value="{{ old('first_name') }}">
        </div>

        <div class="form-group">
            <label for="last_name">نام خانوادگی:</label>
            <input type="text" name="last_name" class="form-control" placeholder="نام خانوادگی را وارد کنید" value="{{ old('last_name') }}">
        </div>

        <div class="form-group">
            <label for="phone_number">تلفن:</label>
            <input type="text" name="phone_number" class="form-control" placeholder="تلفن را وارد کنید" value="{{ old('phone_number') }}">
        </div>

        <div class="form-group">
            <label for="profile_pic">عکس پروفایل:</label>
            <input type="file" name="profile_pic" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="start_date_shamsi">تاریخ شروع (هجری شمسی):</label>
            <input type="text" name="start_date_shamsi" class="form-control" placeholder="1402/01/01" value="{{ old('start_date_shamsi') }}">
        </div>

        <div class="form-group">
            <label for="end_date_shamsi">تاریخ پایان (هجری شمسی):</label>
            <input type="text" name="end_date_shamsi" class="form-control" placeholder="1402/12/30" value="{{ old('end_date_shamsi') }}">
        </div>

        <div class="form-group">
            <label for="is_active">وضعیت:</label>
            <select name="is_active" class="form-control" required>
                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>فعال</option>
                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>غیرفعال</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">رمز عبور:</label>
            <input type="password" name="password" class="form-control" placeholder="رمز عبور را وارد کنید" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">تأیید رمز عبور:</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="رمز عبور را مجدداً وارد کنید" required>
        </div>

        <button type="submit" class="btn btn-primary">ایجاد</button>
    </form>
</div>
</body>
</html>