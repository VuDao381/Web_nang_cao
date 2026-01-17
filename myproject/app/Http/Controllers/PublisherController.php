<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::orderBy('id', 'desc')->paginate(10);
        return view('publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'    => 'required|string|max:255',
                'address' => 'nullable|string|max:255',
                'phone'   => 'nullable|string|max:50',
                'email'   => 'nullable|email|max:255',
            ],
            [
                'name.required' => 'Tên nhà xuất bản không được để trống',
                'email.email'   => 'Email không đúng định dạng',
            ]
        );

        Publisher::create($request->only([
            'name',
            'address',
            'phone',
            'email',
        ]));

        return redirect()
            ->route('publishers.index')
            ->with('success', 'Thêm nhà xuất bản thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $publisher = Publisher::findOrFail($id);
        return view('publishers.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $publisher = Publisher::findOrFail($id);

        $request->validate(
            [
                'name'    => 'required|string|max:255',
                'address' => 'nullable|string|max:255',
                'phone'   => 'nullable|string|max:50',
                'email'   => 'nullable|email|max:255',
            ],
            [
                'name.required' => 'Tên nhà xuất bản không được để trống',
                'email.email'   => 'Email không đúng định dạng',
            ]
        );

        $publisher->update($request->only([
            'name',
            'address',
            'phone',
            'email',
        ]));

        return redirect()
            ->route('publishers.index')
            ->with('success', 'Cập nhật nhà xuất bản thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $publisher = Publisher::findOrFail($id);
        $publisher->delete();

        return redirect()
            ->route('publishers.index')
            ->with('success', 'Xóa nhà xuất bản thành công');
    }
}
