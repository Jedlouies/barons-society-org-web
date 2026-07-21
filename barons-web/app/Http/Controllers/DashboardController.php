<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin/member dashboard with summary metrics.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Dynamic or fallback statistics for the dashboard
        $totalMembers = User::count(a) ?: 500;
        $totalClasses = 12;
        $totalBlogs   = 8;
        $totalPhotos  = 45;

        return view('dashboard', compact(
            'totalMembers',
            'totalClasses',
            'totalBlogs',
            'totalPhotos'
        ));
    }
}