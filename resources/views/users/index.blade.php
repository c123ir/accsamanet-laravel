<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لیست کاربران</title>
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
</head>
<body>
<div class="container mt-5">
    <h2>لیست کاربران</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">ایجاد کاربر جدید</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>نام کاربری</th>
            <th>نام</th>
            <th>نام خانوادگی</th>
            <th>تلفن</th>
            <th>وضعیت</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->is_active ? 'فعال' : 'غیرفعال' }}</td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">مشاهده</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">ویرایش</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>