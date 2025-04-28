<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class LicenseController extends Controller
{
    // Display a listing of licenses
    // public function index()
    // {
    //     $licenses = License::all();
    //     return view('licenses.index', compact('licenses'));
    // }
    public function index(Request $request)
    {
        // $query = License::query();

        // // Search functionality
        // if ($request->has('search')) {
        //     $query->where('business_name', 'like', '%' . $request->search . '%')
        //         ->orWhere('license_number', 'like', '%' . $request->search . '%')
        //         ->orWhere('owner_name', 'like', '%' . $request->search . '%');
        // }

        // // Paginate results
        // $licenses = $query->paginate(10);

        // return view('licenses.index', compact('licenses'));

        $query = License::query();

        // Search functionality
        if ($request->has('search')) {
            $query->where('business_name', 'like', '%' . $request->search . '%')
                ->orWhere('license_number', 'like', '%' . $request->search . '%')
                ->orWhere('owner_name', 'like', '%' . $request->search . '%');
        }

        // Paginate results
        $licenses = $query->paginate(10);

        // Fetch analytics data
        $totalLicenses = License::count();
        $activeLicenses = License::where('status', 'Active')->count();
        $expiredLicenses = License::where('status', 'Expired')->count();
        $licensesExpiringSoon = License::where('expiry_date', '<=', Carbon::now()->addDays(7))->count();

        // Pass data to the view
        return view('licenses.index', [
            'licenses' => $licenses,
            'totalLicenses' => $totalLicenses,
            'activeLicenses' => $activeLicenses,
            'expiredLicenses' => $expiredLicenses,
            'licensesExpiringSoon' => $licensesExpiringSoon,
        ]);
    }

    // /**
    //  * Display analytics data.
    //  */
    // public function analytics()
    // {
    //     // Fetch analytics data
    //     $totalLicenses = License::count();
    //     $activeLicenses = License::where('status', 'Active')->count();
    //     $expiredLicenses = License::where('status', 'Expired')->count();
    //     $licensesExpiringSoon = License::where('expiry_date', '<=', Carbon::now()->addDays(7))->count();

    //     // Pass data to the analytics view
    //     return view('licenses.analytics', [
    //         'totalLicenses' => $totalLicenses,
    //         'activeLicenses' => $activeLicenses,
    //         'expiredLicenses' => $expiredLicenses,
    //         'licensesExpiringSoon' => $licensesExpiringSoon,
    //     ]);
    // }

    

    // Show the form for creating a new license
    public function create()
    {
        return view('licenses.create');
    }

    // Store a newly created license in the database
    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'license_number' => 'required|string|unique:licenses',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date',
            'owner_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
        ]);

        License::create($request->all());
        return redirect()->route('licenses.index')->with('success', 'License created successfully.');
    }

    public function updateStatus(Request $request, License $license)
    {
        $request->validate([
            'status' => 'required|string|in:Active,Expired,Suspended',
        ]);
        $license->update(['status' => $request->status]);
        return redirect()->route('licenses.index')->with('success', 'License status updated successfully.');
        // $license->update(['status' => $request->status]);
        // return redirect()->route('licenses.index')->with('success', 'License status updated successfully.');
    }

    // Export licenses to CSV
    //  public function export()
    //  {
    // return response('<h1>Export Route Reached</h1>', 200)
    // ->header('Content-Type', 'text/html');

    //          $licenses = License::all();
    //          $csvData = "ID,Business Name,License Number,Issue Date,Expiry Date,Status,Owner Name,Email,Phone\n";

    //          foreach ($licenses as $license) {
    //              $csvData .= "{$license->id},{$license->business_name},{$license->license_number},{$license->issue_date},{$license->expiry_date},{$license->status},{$license->owner_name},{$license->email},{$license->phone}\n";
    //          }

    //          $fileName = 'licenses_' . date('Y-m-d_H-i-s') . '.csv';
    //          return response($csvData)
    //              ->header('Content-Type', 'text/csv')
    //              ->header('Content-Disposition', "attachment; filename={$fileName}");
    //      }

    //      public function renew(License $license)
    // {
    //     $license->update([
    //         'issue_date' => now(),
    //         'expiry_date' => now()->addYear(), // Extend expiry by 1 year
    //     ]);

    //     return redirect()->route('licenses.index')->with('success', 'License renewed successfully.');
    // }

    // Display the specified license
    public function show(License $license)
    {
        return view('licenses.show', compact('license'));
    }

    // Show the form for editing the specified license
    public function edit(License $license)
    {
        return view('licenses.edit', compact('license'));
    }

    // Update the specified license in the database
    public function update(Request $request, License $license)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'license_number' => 'required|string|unique:licenses,license_number,' . $license->id,
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date',
            'owner_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
        ]);

        $license->update($request->all());
        return redirect()->route('licenses.index')->with('success', 'License updated successfully.');
    }

    // Remove the specified license from the database
    public function destroy(License $license)
    {
        $license->delete();
        return redirect()->route('licenses.index')->with('success', 'License deleted successfully.');
    }
}
