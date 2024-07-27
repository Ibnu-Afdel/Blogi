<x-layout>
    @section('title', 'Edit Comment')

    <div class="py-6 px-4 bg-white shadow sm:rounded-lg relative">
        <h1 class="text-2xl font-bold mb-4">Edit Comment</h1>
        <form method="POST" action="{{ route('comment.update', $comment) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Comment:</label>
                <textarea name="content" id="content" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>{{ $comment->content }}</textarea>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">
                Update Comment
            </button>
        </form>
    </div>

    <div class="mt-4">
        <a href="{{ route('posts.show', $comment->post_id) }}" class="text-blue-600 hover:text-blue-800">
            &larr; Back to Post
        </a>
    </div>
</x-layout>
