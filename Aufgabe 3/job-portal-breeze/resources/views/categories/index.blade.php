<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Find Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('categories.index') }}" method="GET" class="mb-6">
                        <table class="w-full">
                            <tr>
                                <td class="pr-2" style="width: 90%;">
                                    <input type="text" name="search" placeholder="Search for categories..."
                                           class="border p-2 w-full rounded"
                                           value="{{ $search ?? '' }}">
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

                    <div class="category-listings">
                        @forelse($categories as $category)
                            <div class="bg-gray-100 p-4 rounded mb-4">
                                <h3 class="text-xl font-semibold">{{ $category->name }}</h3>
                                <div class="mt-2">
                                    <span class="text-sm text-gray-500">Jobs Posted: {{ $category->jobAds->count() }}</span>
                                </div>
                                <a href="{{ route('categories.show', $category->id) }}" class="mt-2 inline-block bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">View Details</a>
                            </div>
                        @empty
                            <p>No categories found.</p>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
