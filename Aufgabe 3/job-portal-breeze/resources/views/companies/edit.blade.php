<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit {{ $company->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold">Edit Company Details</h3>
                    <form action="{{ route('companies.update', $company->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name">Company Name:</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $company->name) }}" class="border p-2 w-full">
                            @error('name')
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" class="border p-2 w-full">{{ old('description', $company->description) }}</textarea>
                            @error('description')
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="location">Location:</label>
                            <input type="text" id="location" name="location" value="{{ old('location', $company->location) }}" class="border p-2 w-full">
                            @error('location')
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Update Company</button>
                        </div>
                    </form>

                    <div style="margin-top:20px">
                        <a href="{{ route('companies.index') }}" class="mt-6 inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to Companies</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
