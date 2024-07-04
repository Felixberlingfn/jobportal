<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobAd;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class EditJobAdController extends Controller
{
    public function edit($id)
    {
        $job = JobAd::with(['company', 'category'])->findOrFail($id);

        if (Auth::id() !== $job->created_by && Auth::user()->id != 1) {
            return redirect()->route('find-jobs.index')->with('error', 'You are not authorized to edit this job.');
        }

        $companies = Company::all();
        $categories = Category::all();

        return view('edit-jobs.edit', compact('job', 'companies', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $job = JobAd::findOrFail($id);

        if (Auth::id() !== $job->created_by && Auth::user()->id != 1) {
            return redirect()->route('find-jobs.index')->with('error', 'You are not authorized to update this job.');
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:10255',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|max:255',
            'salary' => 'nullable|numeric',
            'contact_name' => 'required|max:255',
            'contact_email' => 'required|email|max:255',
        ]);

        $company = Auth::user()->company;
        if (!$company) {
            return back()->with('error', 'No associated company found for the user.');
        }

        $validatedData['company_id'] = $company->id;

        if($job->update($validatedData)) {
            return redirect()->route('find-jobs.show', $job->id)->with('success', 'Job updated successfully!');
        } else {
            return back()->with('error', 'Failed to update job. Please try again.');
        }
    }

    public function destroy($id)
    {
        $job = JobAd::findOrFail($id);

        if (Auth::id() !== $job->created_by) {
            return redirect()->route('find-jobs.index')->with('error', 'You are not authorized to delete this job.');
        }

        if($job->delete()) {
            return redirect()->route('dashboard')->with('success', 'Job deleted successfully!');
        } else {
            return back()->with('error', 'Failed to delete job. Please try again.');
        }
    }
}
