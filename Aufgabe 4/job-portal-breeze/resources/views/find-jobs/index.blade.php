<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Find Jobs
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('find-jobs.search') }}" method="GET" class="mb-6">
                        <table class="w-full">
                            <tr>
                                <td class="pr-2" style="width: 40%;">
                                    <input type="text" name="search" placeholder="Search for jobs..."
                                           class="border p-2 w-full rounded"
                                           value="{{ $search ?? '' }}">
                                </td>
                                <td class="px-1" style="width: 25%;">
                                    <select name="company" class="border p-2 w-full rounded">
                                        <option value="">All Companies</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}"
                                                {{ ($selectedCompany ?? '') == $company->id ? 'selected' : '' }}>
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-1" style="width: 25%;">
                                    <select name="category" class="border p-2 w-full rounded">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ ($selectedCategory ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="pl-2" style="width: 10%;">
                                    <button type="submit"
                                            class="w-full bg-gray-800 text-white p-2 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Search
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>

                    <div class="job-listings">
                        @forelse($jobs as $job)
                            <div class="bg-gray-100 p-4 rounded mb-4">
                                <a href="{{ route('find-jobs.show', $job->id) }}"><h3 class="text-xl font-semibold">{{ $job->title }}</h3></a>
                                <p class="text-gray-600">{{ $job->company->name }} - {{ $job->location }}</p>
                                <p class="mt-2">{{ Str::limit($job->description, 150) }}</p>
                                <div class="mt-2">
                                    <span class="text-sm text-gray-500">Posted: {{ $job->created_at->diffForHumans() }}</span>
                                </div>
                                <a href="{{ route('find-jobs.show', $job->id) }}" class="mt-2 inline-block bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">View Details</a>
                            </div>
                        @empty
                            <p>No jobs found.</p>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $jobs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
