<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Hiển thị danh sách thể loại với phân trang.
     */
    public function index()
    {
        // Lấy danh sách, sắp xếp mới nhất lên đầu, phân trang 10 mục mỗi trang
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Hiển thị form tạo mới.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Lưu thể loại mới vào Database.
     */
    public function store(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable', // Chấp nhận trạng thái checkbox
        ]);

        try {
            // 2. Xử lý Slug
            $slug = $request->slug
                ? Str::slug($request->slug)
                : Str::slug($request->name);

            // Kiểm tra trùng slug lần nữa để đảm bảo
            if (Category::where('slug', $slug)->exists()) {
                $slug = $slug . '-' . time(); // Tự động thêm đuôi nếu trùng
            }

            // 3. Tạo mới
            Category::create([
                'name' => $request->name,
                'slug' => $slug,
                'description' => $request->description,
                'is_active' => $request->has('is_active') ? true : false,
            ]);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Thêm thể loại mới thành công!');

        } catch (\Exception $e) {
            Log::error("Lỗi thêm thể loại: " . $e->getMessage());
            return back()->withInput()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    /**
     * Hiển thị form chỉnh sửa.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Cập nhật thông tin thể loại.
     */
    public function update(Request $request, Category $category)
    {
        // 1. Validate (Bỏ qua ID hiện tại khi check unique name)
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        try {
            $slug = $request->slug
                ? Str::slug($request->slug)
                : Str::slug($request->name);

            // 2. Check trùng slug (trừ chính nó)
            if (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = $slug . '-' . time();
            }

            // 3. Update
            $category->update([
                'name' => $request->name,
                'slug' => $slug,
                'description' => $request->description,
                'is_active' => $request->has('is_active') ? true : false,
            ]);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Cập nhật thể loại thành công!');

        } catch (\Exception $e) {
            Log::error("Lỗi cập nhật thể loại: " . $e->getMessage());
            return back()->withInput()->with('error', 'Không thể cập nhật, vui lòng kiểm tra lại.');
        }
    }

    /**
     * Xóa thể loại.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Đã xóa thể loại thành công!');

        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi xóa dữ liệu!');
        }
    }
}