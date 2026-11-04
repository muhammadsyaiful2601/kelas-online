<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Category;
use App\Course;
use App\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCourses      = Course::count();
        $publishedCourses  = Course::published()->count();
        $totalEnrollments  = Enrollment::count();
        $recentEnrollments = Enrollment::with('course')->latest()->take(5)->get();
        $totalCategories   = Category::count();

        return view('admin.dashboard', compact(
            'totalCourses',
            'publishedCourses',
            'totalEnrollments',
            'recentEnrollments',
            'totalCategories'
        ));
    }
}
