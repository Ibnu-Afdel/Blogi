<x-layout>
    @section('title', 'Detail')
    @section('heading', $post->topic)

    <div class="py-6 px-4 bg-white shadow sm:rounded-lg relative">
        <h1 class="text-2xl font-bold mb-4">Have a Nice Reading</h1>
        <hr class="mb-4">

        <div class="flex items-start space-x-4 mb-4">
            @if($post->image)
                <img
                    alt="Post Image"
                    src="{{ asset($post->image) }}"
                    class="h-56 w-48 object-cover rounded-lg border border-gray-300"
                />
            @endif

            <div class="flex-1">
                <p class="text-gray-700">
                    {{ $post->description }}
                </p>
            </div>
        </div>

        <div class="mb-6 flex justify-between items-center">
            <div>
                <div class="font-light text-sm text-gray-500">
                    <span class="font-semibold">Blogger:</span> {{ $post->user->email }}
                </div>
                <div class="font-light text-sm text-gray-500">
                    <span class="font-semibold"></span> {{$post->created_at->format('jS M Y') }}
                </div>
            </div>

         
        </div>

        @can('edit-post', $post)
        <div class="flex space-x-2 mb-6">
            <x-button href="{{ route('posts.edit', $post) }}" class="bg-blue-600 hover:bg-blue-700">
                Edit
            </x-button>

            <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-3 mt-6 rounded">
                    Delete
                </button>
            </form>
        </div>
    @endcan
    
        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                &larr; Back to posts
            </a>
            @if($post->updated_at != $post->created_at)
                <div class="text-right font-light text-sm text-gray-500 ">
                    <span class="font-semibold">edited:</span> {{ $post->updated_at->format('h:i A, F Y') }}
                </div>
            @endif
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-bold mb-4">Comments</h2>
    
        @if (auth()->check())
            <form method="POST" action="{{ route('comment.store', $post) }}" class="mb-6">
                @csrf
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Add a comment:</label>
                    <textarea name="content" id="content" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">
                    Add Comment
                </button>
            </form>
        @else
        <div class="text-red-500 font-bold mb-2 hover:text-red-900">
            <a href="{{ route('register') }}">Create account to give comment</a>
        </div>
        @endif
    
        @if ($post->comments->count() > 0)
            <ul class="space-y-4">
                @foreach ($post->comments as $comment)
                    <li class="bg-gray-100 p-4 rounded-lg">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="font-semibold">{{ $comment->user->name }}</span>
                                <span class="text-sm text-gray-500 ml-2">{{ $comment->created_at->format('jS M Y, h:i A') }}</span>
                            </div>
                            @can('edit-comment', $comment)
                                <div class="flex space-x-2">
                                    <a href="{{ route('comment.edit', $comment) }}" class="text-blue-600 hover:text-blue-800 text-sm mt-1">Edit</a>
                                    <form method="POST" action="{{ route('comment.destroy', $comment) }}" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                        <div class="text-gray-700 mt-2">{{ $comment->content }}</div>
                    </li>
                    <hr>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No comments yet.</p>
        @endif
    
        <x-error name="content" />
    
        <div class="mt-4">
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800">
                &larr; Back to Posts
            </a>
        </div>
    </div>
    


</x-layout>
