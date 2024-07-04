<?php

namespace App\Http\Controllers;

use App\Models\JobAd;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jobs = JobAd::where('created_by', $user->id)
            ->latest()
            ->paginate(10);

        $jobCount = JobAd::where('created_by', $user->id)->count();
        $latestJob = $jobs->first();

        return view('dashboard', compact('jobs', 'jobCount', 'latestJob'));
    }
}
