<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Category;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->latest()->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.courses.create', compact('categories'));
    }

    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?? $data['title']);
        $data['is_free'] = $request->has('is_free');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function show(Course $course)
    {
        $course->load('category', 'enrollments');

        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $categories = Category::all();

        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?? $data['title']);
        $data['is_free'] = $request->has('is_free');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}
