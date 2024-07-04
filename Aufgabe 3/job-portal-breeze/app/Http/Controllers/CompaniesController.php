<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $companies = Company::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10);

        return view('companies.index', compact('companies', 'search'));
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.show', compact('company'));
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        if (Auth::id() !== $company->created_by && Auth::user()->id != 1) {
            return redirect()->route('companies.index')->with('error', 'You are not authorized to edit this company.');
        }
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        if (Auth::id() !== $company->created_by  && Auth::user()->id != 1) {
            return redirect()->route('companies.index')->with('error', 'You are not authorized to edit this company.');
        }
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:10255',
            'location' => 'nullable|max:255',
        ]);

        $company->update($validatedData);

        return view('companies.show', compact('company'));
    }
}
