<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobAd;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostJobAdController extends Controller
{
    public function create()
    {
        $companies = Company::all();
        $categories = Category::all();
        return view('post-jobs.create', compact('companies', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:10255',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|max:255',
            'salary' => 'nullable|numeric',
            'contact_name' => 'required|max:255',
            'contact_email' => 'required|email|max:255',
        ]);

        // Get the company ID from the authenticated user
        $company = Auth::user()->company;
        if (!$company) {
            return back()->with('error', 'No associated company found for the user.');
        }

        // Replace company and category names with their IDs
        $validatedData['company_id'] = $company->id;

        $validatedData['created_by'] = Auth::id();

        $job = JobAd::create($validatedData);

        if($job) {
            return redirect()->route('find-jobs.show', $job->id)->with('success', 'Job created successfully!');
        } else {
            return back()->with('error', 'Failed to create job. Please try again.');
        }
    }

    public function index()
    {
        $jobs = JobAd::with(['company', 'category'])->get();
        return view('post-jobs.index', compact('jobs'));
    }
}
