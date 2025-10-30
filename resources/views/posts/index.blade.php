<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Posts') }}
        </h2>
        <a href="{{ route('posts.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Create Post
            </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                @foreach($posts as $post)
                    <article class="mb-6">
                        <h2 class="text-2xl font-semibold">
                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="text-sm text-gray-600">
                            By {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
                        </p>
                        <p>{{ \Illuminate\Support\Str::limit($post->content, 150) }}</p>
                    </article>
                    <hr>
                @endforeach

                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
