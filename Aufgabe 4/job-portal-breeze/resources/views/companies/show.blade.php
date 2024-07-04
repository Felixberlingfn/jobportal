<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ $company->name }}
</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h3 class="text-xl font-semibold">{{ $company->name }}</h3>
                <p class="text-gray-600">Created by: {{ $company->creator->name }}</p>

                <p class="text-gray-600">Description: {{ $company->description ?? 'No description available.' }}</p>
                <p class="mt-2">Location: {{ $company->location ?? 'Location not specified' }}</p>
                <p class="mt-2">Jobs Posted: {{ $company->jobAds->count() }}</p>
                <div class="mt-2">
                    <span class="text-sm text-gray-500">Created: {{ $company->created_at->diffForHumans() }}</span>
                </div>

                <div class="mt-6">
                    <h4 class="text-lg font-medium text-gray-900">Job Listings</h4>
                    <ul class="list-disc list-inside mt-2">
                        @forelse($company->jobAds as $jobAd)
                            <li>
                                <a href="{{ route('find-jobs.show', $jobAd->id) }}" class="text-blue-500 hover:underline">{{ $jobAd->title }}</a>
                            </li>
                        @empty
                            <li>No job listings available.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Conditional Edit Button -->
                @if(Auth::check() && (Auth::id() == $company->created_by || Auth::user()->id == 1))
                    <div class="mt-6">
                        <a href="{{ route('companies.edit', $company->id) }}" class="mt-6 inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Edit Company</a>
                    </div>
                @endif

                <div style="margin-top:20px">
                    <a href="{{ route('companies.index') }}" class="mt-6 inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to Companies</a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
