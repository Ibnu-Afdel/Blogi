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
            <a href="{{ $previousUrl }}" class="text-blue-600 hover:text-blue-800 text-sm">
                &larr; Back
            </a>
            @if($post->updated_at != $post->created_at)
                <div class="text-right font-light text-sm text-gray-500 ">
                    <span class="font-semibold">edited:</span> {{ $post->updated_at->format('h:i A, F Y') }}
                </div>
            @endif
        </div>
    </div>
</x-layout>
