<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ویرایش کاربر</title>
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
</head>
<body>
<div class="container mt-5">
    <h2>ویرایش کاربر</h2>
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

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="username">نام کاربری:</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
        </div>

        <div class="form-group">
            <label for="first_name">نام:</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}">
        </div>

        <div class="form-group">
            <label for="last_name">نام خانوادگی:</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}">
        </div>

        <div class="form-group">
            <label for="phone_number">تلفن:</label>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
        </div>

        <div class="form-group">
            <label for="profile_pic">عکس پروفایل:</label>
            @if($user->profile_pic)
                <div class="mb-2">
                    <img src="{{ asset('images/profiles/' . $user->profile_pic) }}" alt="Profile Picture" width="100">
                </div>
            @endif
            <input type="file" name="profile_pic" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="start_date_shamsi">تاریخ شروع (هجری شمسی):</label>
            <input type="text" name="start_date_shamsi" class="form-control" value="{{ old('start_date_shamsi', $user->start_date_shamsi) }}" placeholder="1402/01/01">
        </div>

        <div class="form-group">
            <label for="end_date_shamsi">تاریخ پایان (هجری شمسی):</label>
            <input type="text" name="end_date_shamsi" class="form-control" value="{{ old('end_date_shamsi', $user->end_date_shamsi) }}" placeholder="1402/12/30">
        </div>

        <div class="form-group">
            <label for="is_active">وضعیت:</label>
            <select name="is_active" class="form-control" required>
                <option value="1" {{ old('is_active', $user->is_active) == '1' ? 'selected' : '' }}>فعال</option>
                <option value="0" {{ old('is_active', $user->is_active) == '0' ? 'selected' : '' }}>غیرفعال</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">رمز عبور:</label>
            <input type="password" name="password" class="form-control" placeholder="رمز عبور جدید را وارد کنید">
        </div>

        <div class="form-group">
            <label for="password_confirmation">تأیید رمز عبور:</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="رمز عبور جدید را مجدداً وارد کنید">
        </div>

        <button type="submit" class="btn btn-primary">به‌روزرسانی</button>
    </form>
</div>
</body>
</html>