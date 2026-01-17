<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Danh sách user
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Form tạo user
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Lưu user mới
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'role'     => 'required|in:admin,user',
                'phone'    => 'nullable|string|max:20',
                'address'  => 'nullable|string',
            ],
            [
                'email.unique'        => 'Email đã tồn tại',
                'password.confirmed'  => 'Mật khẩu xác nhận không khớp',
            ]
        );

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password, // auto hash
            'role'      => $request->role,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Thêm người dùng thành công');
    }

    /**
     * Form sửa user
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Cập nhật user
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate(
            [
                'name'  => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'role'  => 'required|in:admin,user',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
            ]
        );

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'role'      => $request->role,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'is_active' => $request->boolean('is_active'),
        ];

        // Nếu admin nhập mật khẩu mới
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:6|confirmed',
            ]);

            $data['password'] = $request->password;
        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'Cập nhật người dùng thành công');
    }

    /**
     * Xóa user
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Không cho tự xóa chính mình
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Bạn không thể xóa chính mình');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Xóa người dùng thành công');
    }

    /**
     * Khóa / mở user (toggle active)
     */
    public function toggleStatus(string $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'is_active' => !$user->is_active
        ]);

        return back()->with('success', 'Cập nhật trạng thái thành công');
    }
}
