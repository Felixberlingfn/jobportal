<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Job Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-xl font-semibold mb-2">{{ $job->title }}</h1>

                    <p class="text-gray-600 mb-2">Company: {{ $job->company->name }}</p>
                    <p class="text-gray-600 mb-2">Category: {{ $job->category->name }}</p>
                    <p class="text-gray-600 mb-2">Location: {{ $job->location }}</p>
                    @if($job->salary)
                        <p class="text-gray-600 mb-4">Salary: ${{ number_format($job->salary, 2) }}</p>
                    @endif
                    <div class="mt-4">
                        <h2 class="text-xl font-semibold mb-2">Job Description</h2>
                        <p>{{ $job->description }}</p>
                    </div>
                    <div class="mt-4">
                        <h2 class="text-xl font-semibold mb-2">Contact Information</h2>
                        <p>Name: {{ $job->contact_name }}</p>
                        <p>Email: <a href="mailto:{{ $job->contact_email }}" style="color:steelblue">{{ $job->contact_email }}</a></p>
                    </div>
                    <div class="mt-6">
                        <span class="text-sm text-gray-500">Posted: {{ $job->created_at->diffForHumans() }} by {{ $job->creator->name }}</span>
                    </div>
                    <a href="{{ route('find-jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Back to Job Listings
                    </a>
                    @if(Auth::id() == $job->created_by)
                        <a href="{{ route('edit-jobs.edit', $job->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Edit Job
                        </a>

                        <form action="{{ route('edit-jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job posting?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="margin-top: 20px" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Delete Job
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
