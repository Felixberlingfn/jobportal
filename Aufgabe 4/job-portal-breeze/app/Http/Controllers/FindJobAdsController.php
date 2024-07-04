<?php

namespace App\Http\Controllers;

use App\Models\JobAd;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Http\Request;

class FindJobAdsController extends Controller
{
    public function index()
    {
        $jobs = JobAd::with(['company', 'category'])
            ->latest()
            ->paginate(10);
        $jobCount = JobAd::count();
        $latestJob = JobAd::with(['company', 'category'])
            ->latest()
            ->first();
        $companies = Company::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('find-jobs.index', compact('jobs', 'jobCount', 'latestJob', 'companies', 'categories'));
    }

    public function search(Request $request)
    {
        $query = JobAd::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%")
                    ->orWhereHas('company', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        if ($request->filled('company')) {
            $query->where('company_id', $request->input('company'));
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $jobs = $query->with(['company', 'category'])->latest()->paginate(10);
        $jobCount = $jobs->total();
        $companies = Company::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('find-jobs.index', compact('jobs', 'jobCount', 'companies', 'categories'))
            ->with('search', $request->input('search'))
            ->with('selectedCompany', $request->input('company'))
            ->with('selectedCategory', $request->input('category'));
    }

    public function show($id)
    {
        $job = JobAd::with(['company', 'category', 'creator'])
            ->findOrFail($id);

        return view('find-jobs.show', compact('job'));
    }
}
