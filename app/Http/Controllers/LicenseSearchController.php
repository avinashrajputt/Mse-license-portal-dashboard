<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class LicenseSearchController extends Controller
{
    public function index()
    {
        return view('licenses.search');
    }

    public function search(Request $request)
    {
        $request->validate([
            'license_number' => 'required|string'
        ]);

        $license = License::where('license_number', $request->license_number)->first();

        return view('licenses.search', compact('license'));
    }
}