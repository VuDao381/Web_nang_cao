<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PublisherController extends Controller
{
    /**
     * Danh sách nhà xuất bản (Phân trang 10).
     */
    public function index()
    {
        $publishers = Publisher::orderBy('id', 'desc')->paginate(10);
        return view('admin.publishers.index', compact('publishers'));
    }

    /**
     * Hiển thị form thêm mới.
     */
    public function create()
    {
        return view('admin.publishers.create');
    }

    /**
     * Lưu nhà xuất bản mới.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:publishers,name',
                'address' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
            ],
            [
                'name.required' => 'Tên nhà xuất bản không được để trống',
                'name.unique' => 'Tên nhà xuất bản này đã tồn tại',
                'email.email' => 'Email không đúng định dạng',
            ]
        );

        try {
            Publisher::create($request->all());

            return redirect()
                ->route('admin.publishers.index')
                ->with('success', 'Thêm nhà xuất bản thành công!');
        } catch (\Exception $e) {
            Log::error("Lỗi thêm NXB: " . $e->getMessage());
            return back()->withInput()->with('error', 'Có lỗi xảy ra khi lưu dữ liệu.');
        }
    }

    /**
     * Form chỉnh sửa (Sử dụng Route Model Binding).
     */
    public function edit(Publisher $publisher)
    {
        return view('admin.publishers.edit', compact('publisher'));
    }

    /**
     * Cập nhật thông tin.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:publishers,name,' . $publisher->id,
                'address' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
            ],
            [
                'name.required' => 'Tên nhà xuất bản không được để trống',
                'name.unique' => 'Tên nhà xuất bản đã tồn tại',
                'email.email' => 'Email không đúng định dạng',
            ]
        );

        try {
            $publisher->update($request->all());

            return redirect()
                ->route('admin.publishers.index')
                ->with('success', 'Cập nhật nhà xuất bản thành công!');
        } catch (\Exception $e) {
            Log::error("Lỗi cập nhật NXB: " . $e->getMessage());
            return back()->withInput()->with('error', 'Không thể cập nhật thông tin.');
        }
    }

    /**
     * Xóa nhà xuất bản.
     */
    public function destroy(Publisher $publisher)
    {
        try {
            // Kiểm tra xem NXB có đang liên kết với quyển sách nào không
            if ($publisher->books()->count() > 0) {
                return back()->with('error', 'Không thể xóa nhà xuất bản này vì đang có sách thuộc về họ!');
            }

            $publisher->delete();
            return redirect()
                ->route('admin.publishers.index')
                ->with('success', 'Xóa nhà xuất bản thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi khi xóa dữ liệu.');
        }
    }
}