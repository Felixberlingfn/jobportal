<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $request->user()->fill($request->validated());

        if ($request->filled('myCompany')) {
            $company = Company::firstOrCreate(
                ['name' => $request->input('myCompany')],
                ['created_by' => $user->id]
            );
            $user->company_id = $company->id;
        } else {
            $user->company_id = null;
        }

        // Set is_recruiter to false if myCompany is not filled, otherwise use the request input
        $validatedData['is_recruiter'] = !$request->filled('myCompany') ? false : $request->input('is_recruiter');

        $user->is_recruiter = $validatedData['is_recruiter'];

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
