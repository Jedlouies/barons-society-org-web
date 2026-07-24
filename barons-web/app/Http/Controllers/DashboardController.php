<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class DashboardController extends Controller
{
    /**
     * Display the admin/member dashboard with summary metrics.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $totalMembers = User::count() ?: 500;
        } catch (Exception $e) {
            $totalMembers = 500;
        }

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