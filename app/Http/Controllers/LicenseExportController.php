<?php

namespace App\Http\Controllers;

use App\Models\License;

class LicenseExportController extends Controller
{
    public function export()
    {
        $licenses = License::all();
        $csvData = "ID,Business Name,License Number,Issue Date,Expiry Date,Status,Owner Name,Email,Phone\n";

        foreach ($licenses as $license) {
            $csvData .= "{$license->id},{$license->business_name},{$license->license_number},{$license->issue_date},{$license->expiry_date},{$license->status},{$license->owner_name},{$license->email},{$license->phone}\n";
        }

        $fileName = 'licenses_' . date('Y-m-d_H-i-s') . '.csv';
        return response($csvData)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename={$fileName}");
    }
}