<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="w-full border-gray-300 rounded-md" required>
                        @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Content</label>
                        <textarea name="content" rows="6" class="w-full border-gray-300 rounded-md" required>{{ old('content') }}</textarea>
                        @error('content') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <x-primary-button>{{ __('Create') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
