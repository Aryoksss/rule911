<div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md">
    {{-- Header: Dropdown dan Search --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
        {{-- Dropdown Pilihan Jumlah Baris --}}
        <div class="mb-2 md:mb-0">
            <label for="paginate" class="block text-sm font-medium text-gray-900 dark:text-white">
                Show rows:
            </label>
            <select wire:model.live="now_page" id="paginate"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-md focus:ring-blue-500 focus:border-blue-500">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
        </div>

        {{-- Search Bar --}}
        <div class="relative">
            <input type="text" wire:model.live="search"
                class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-md focus:ring-blue-500 focus:border-blue-500"
                placeholder="Search...">
            <svg class="absolute left-3 top-3 w-4 h-4 text-gray-500 dark:text-gray-400" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"></path>
                <circle cx="10" cy="10" r="7"></circle>
            </svg>
        </div>
    </div>
    <div>
        <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Post</button>

        @if($isOpen)
            @include('livewire.create')
        @endif
    </div>

    {{-- Tabel Data --}}
    <div class="relative overflow-x-auto rounded-lg border border-gray-300 dark:border-gray-700">
        <table class="w-full text-sm text-left text-gray-900 dark:text-gray-400">
            <thead class="text-xs uppercase bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3 w-1/4">Name</th>
                    <th scope="col" class="px-6 py-3 w-1/2">Desc</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 transition">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white w-1/4">{{ $post->title }}</td>
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300 w-1/2">{{ $post->body }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 flex justify-center">
        {{ $posts->links() }}
    </div>
</div>
