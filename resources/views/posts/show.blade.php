<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Post Content --}}
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <p class="text-gray-600 text-sm mb-4">
                    By {{ $post->user->name }} • {{ $post->created_at->toDayDateTimeString() }}
                </p>

                <div class="prose max-w-none mb-6">
                    {!! nl2br(e($post->content)) !!}
                </div>

                {{-- Edit / Delete for Post Owner --}}
                <div class="flex gap-4">
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}"
                           class="text-blue-600 hover:underline font-medium">
                            ✏️ Edit
                        </a>
                    @endcan

                    @can('delete', $post)
                        <form method="POST" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this post?')"
                                    class="text-red-600 hover:underline font-medium">
                                🗑️ Delete
                            </button>
                        </form>
                    @endcan
                </div>
            </div>

            {{-- Comments Section --}}
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Comments ({{ $post->comments->count() }})</h3>

                @forelse($post->comments as $comment)
                    <div class="mb-4 border-b pb-3">
                        <div class="flex justify-between items-center">
                            <strong>{{ $comment->user->name ?? $comment->name }}</strong>
                            <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mt-1 text-gray-800">{{ $comment->content }}</p>
                    </div>
                @empty
                    <p class="text-gray-500 italic">No comments yet. Be the first to say something!</p>
                @endforelse

                {{-- Add Comment --}}
                @auth
                    <h4 class="text-md font-semibold mt-6 mb-2">Leave a Comment</h4>
                    <form method="POST" action="{{ route('posts.comments.store', $post) }}" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" name="name" type="text"
                                value="{{ old('name', auth()->user()->name ?? '') }}"
                                class="block mt-1 w-full" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email"
                                value="{{ old('email', auth()->user()->email ?? '') }}"
                                class="block mt-1 w-full" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="content" value="Comment" />
                            <textarea id="content" name="content" rows="4"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <x-primary-button>Post Comment</x-primary-button>
                    </form>
                @else
                    <p class="text-sm text-gray-600 mt-4">
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Log in</a>
                        to leave a comment.
                    </p>
                @endauth
            </div>

        </div>
    </div>
</x-app-layout>
