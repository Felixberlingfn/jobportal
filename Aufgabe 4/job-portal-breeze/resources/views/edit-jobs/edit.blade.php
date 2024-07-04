<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Job Posting
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <main>
                        @if(session('success'))
                            <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('edit-jobs.update', $job->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="title">Job Title:</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $job->title) }}" class="border p-2 w-full">
                                @error('title')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="description">Job Description:</label>
                                <textarea id="description" name="description" class="border p-2 w-full">{{ old('description', $job->description) }}</textarea>
                                @error('description')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <label for="category_id">Category:</label>
                            <select name="category_id" class="border p-2 w-full rounded">
                                <option value="">Choose a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ ($selectedCategory ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="mt-4">
                                <label for="location">Location:</label>
                                <input type="text" id="location" name="location" value="{{ old('location', $job->location) }}" class="border p-2 w-full">
                                @error('location')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="salary">Salary (optional):</label>
                                <input type="text" id="salary" name="salary" value="{{ old('salary', $job->salary) }}" class="border p-2 w-full">
                                @error('salary')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="contact_name">Contact Name:</label>
                                <input type="text" id="contact_name" name="contact_name" value="{{ old('contact_name', $job->contact_name) }}" class="border p-2 w-full">
                                @error('contact_name')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="contact_email">Contact Email:</label>
                                <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $job->contact_email) }}" class="border p-2 w-full">
                                @error('contact_email')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Update Job</button>
                            </div>
                        </form>
                            <form action="{{ route('edit-jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job posting?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="margin-top: 20px" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Delete Job
                                </button>
                            </form>
                    </main>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
