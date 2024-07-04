<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Posted Jobs
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <main>
                        @if(session('success'))
                            <div>{{ session('success') }}</div>
                        @endif
                        <ul>
                            @foreach($jobs as $job)
                                <li>
                                    <h2>{{ $job->title }}</h2>
                                    <p>{{ $job->description }}</p>
                                    <p><strong>Company:</strong> {{ $job->company }}</p>
                                    <p><strong>Location:</strong> {{ $job->location }}</p>
                                    @if($job->salary)
                                        <p><strong>Salary:</strong> ${{ $job->salary }}</p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </main>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

