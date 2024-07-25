<x-layout>
    @section('title' , 'Detail')
    @section('heading', $post->topic )


<h1 class="font-bold text-lg">Have a nice reading</h1><hr>
<p>
    {{ $post->description }}
</p>
<br>
<div class="flex space-x-2">
<x-button href="{{ route('posts.edit', $post) }}" >Edit</x-button>
<form method="POST" action="{{ route('posts.destroy', $post) }}">
    @csrf
    @method('DELETE')
    <input type="hidden" name="_method" value="DELETE">
    <button class="mt-6 inline-block rounded bg-red-500 px-5 py-3 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring cursor-pointer">Delete</button>
</form>
</div>
</x-layout>