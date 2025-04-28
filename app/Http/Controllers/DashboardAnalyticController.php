<?php

namespace App\Http\Controllers;

use App\Models\License;
use Carbon\Carbon;

class DashboardAnalyticController extends Controller
{
    /**
     * Display the dashboard analytics.
     */
    public function index()
    {
        // Fetch analytics data
        $totalLicenses = License::count();
        $activeLicenses = License::where('status', 'Active')->count();
        $expiredLicenses = License::where('status', 'Expired')->count();
        $licensesExpiringSoon = License::where('expiry_date', '<=', Carbon::now()->addDays(7))->count();

        // Pass data to the Blade view
        return view('licenses.index', [
            'totalLicenses' => $totalLicenses,
            'activeLicenses' => $activeLicenses,
            'expiredLicenses' => $expiredLicenses,
            'licensesExpiringSoon' => $licensesExpiringSoon,
        ]);
    }
}