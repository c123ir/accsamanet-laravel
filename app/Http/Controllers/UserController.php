<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * نمایش لیست کاربران.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * نمایش فرم ایجاد کاربر جدید.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * ذخیره کاربر جدید در دیتابیس.
     */
    public function store(Request $request)
    {
        // اعتبارسنجی داده‌ها
        $request->validate([
            'username' => 'required|unique:users,username',
            'name' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'phone_number' => 'nullable|string|max:20',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date_shamsi' => 'nullable|date_format:Y/m/d',
            'end_date_shamsi' => 'nullable|date_format:Y/m/d',
            'is_active' => 'required|boolean',
        ]);

        // آپلود عکس پروفایل در صورت وجود
        if ($request->hasFile('profile_pic')) {
            $imageName = time().'.'.$request->profile_pic->extension();
            $request->profile_pic->move(public_path('images/profiles'), $imageName);
        } else {
            $imageName = null;
        }

        // ایجاد کاربر جدید
        User::create([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'profile_pic' => $imageName,
            'start_date_shamsi' => $request->start_date_shamsi,
            'end_date_shamsi' => $request->end_date_shamsi,
            'is_active' => $request->is_active,
            'creator_user_id' => auth()->id(), // فرض بر این است که سیستم احراز هویت فعال است
        ]);

        return redirect()->route('users.index')->with('success', 'کاربر با موفقیت ایجاد شد.');
    }

    /**
     * نمایش مشخصات یک کاربر.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * نمایش فرم ویرایش کاربر.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * به‌روزرسانی کاربر در دیتابیس.
     */
    public function update(Request $request, User $user)
    {
        // اعتبارسنجی داده‌ها
        $request->validate([
            'username' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:6|confirmed',
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'phone_number' => 'nullable|string|max:20',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date_shamsi' => 'nullable|date_format:Y/m/d',
            'end_date_shamsi' => 'nullable|date_format:Y/m/d',
            'is_active' => 'required|boolean',
        ]);

    
// آپلود عکس پروفایل
if ($request->hasFile('profile_pic')) {
    $imageName = time().'.'.$request->profile_pic->extension();
    $request->profile_pic->storeAs('profiles', $imageName, 'public');
} else {
    $imageName = null;
}

// نمایش عکس پروفایل
@if($user->profile_pic)
    <img src="{{ Storage::url('profiles/' . $user->profile_pic) }}" alt="Profile Picture" width="150">
@endif


// پس از ایجاد کاربر
Mail::to($user->email)->send(new WelcomeMail($user));     

// به‌روزرسانی کاربر
        $user->update([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'profile_pic' => $imageName,
            'start_date_shamsi' => $request->start_date_shamsi,
            'end_date_shamsi' => $request->end_date_shamsi,
            'is_active' => $request->is_active,
            'creator_user_id' => auth()->id(),
        ]);

        return redirect()->route('users.index')->with('success', 'کاربر با موفقیت به‌روزرسانی شد.');
    }

    /**
     * حذف کاربر از دیتابیس.
     */
    public function destroy(User $user)
    {
        // حذف عکس پروفایل در صورت وجود
        if ($user->profile_pic) {
            $imagePath = public_path('images/profiles/') . $user->profile_pic;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'کاربر با موفقیت حذف شد.');
    }
}