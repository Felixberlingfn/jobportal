<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Your Job Postings (Total: {{ $jobCount }})</h3>

                    @if($jobs->count() > 0)
                        @foreach($jobs as $job)
                            <div class="bg-gray-100 p-4 rounded mb-4">
                                <a href="{{ route('find-jobs.show', $job->id) }}"><h4 class="text-xl font-semibold">{{ $job->title }}</h4></a>
                                <p>Company: {{ $job->company->name }}</p>
                                <p>Location: {{ $job->location }}</p>
                                <p>Posted: {{ $job->created_at->diffForHumans() }}</p>
                                <a href="{{ route('find-jobs.show', $job->id) }}" class="text-blue-500 hover:underline">View Details</a>
                                <a href="{{ route('edit-jobs.edit', $job->id) }}" class="text-green-500 hover:underline ml-4">Edit</a>
                            </div>
                        @endforeach

                        {{ $jobs->links() }}
                    @else
                        <p>You haven't posted any jobs yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
