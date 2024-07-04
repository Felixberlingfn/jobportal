<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold">{{ $category->name }}</h3>
                    <div class="mt-6">
                        <h4 class="text-lg font-medium text-gray-900">Job Listings</h4>
                        <ul class="list-disc list-inside mt-2">
                            @forelse($category->jobAds as $jobAd)
                                <li>
                                    <a href="{{ route('find-jobs.show', $jobAd->id) }}" class="text-blue-500 hover:underline">{{ $jobAd->title }}</a>
                                </li>
                            @empty
                                <li>No job listings available.</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Conditional Edit and Create Buttons -->
                    @if(Auth::check() && Auth::user()->id == 1)
                        <div class="mt-6">
                            <a href="{{ route('categories.edit', $category->id) }}" class="mt-6 inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Edit Category</a>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('categories.create') }}" class="mt-6 inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Create Category</a>
                        </div>
                    @endif

                    <div style="margin-top:20px">
                        <a href="{{ route('categories.index') }}" class="mt-6 inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to Categories</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
