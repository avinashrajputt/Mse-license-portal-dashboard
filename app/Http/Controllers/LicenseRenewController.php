<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class LicenseRenewController extends Controller
{
    public function renew(License $license)
    {
        $license->update([
            'issue_date' => now(),
            'expiry_date' => now()->addYear(3), // Extend expiry by 1 year
        ]);

        // return redirect()->route('licenses.index')->with('success', 'License renewed successfully.');
        return redirect()->route('licenses.index')->with('success', 'Your license expiration date has been extended by 3 years!');

    }
}