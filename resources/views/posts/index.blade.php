<x-layout>
    @section('Posts' , 'Index')
    @section('heading')
    Post :
    @auth
        {{ Auth::user()->name }}
    @else
        Guest
    @endauth  
 
    @endsection
    @section('button')
    <x-button href="{{ route('posts.create') }}">Create</x-button>
    @endsection

    @forelse ($posts as $post )
       
      <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg flex">
        @if($post->image)
          <img
            alt=""
            src="{{  asset($post->image) }}"
            class="h-56 w-1/3 object-cover"
          />
        @endif

        <div class="bg-white p-4 sm:p-6 {{ $post->image ? 'w-2/3' : 'w-full' }}">
          <div class="flex justify-between items-start">
            <a href="{{ route('posts.show', $post) }}">
              <h3 class="text-lg font-bold text-gray-900">{{ $post->topic }}</h3>
            </a>
            <time class="text-xs text-gray-500">{{ $post->created_at->format('jS M Y') }}</time>
          </div>
      
          <p class="mt-2 text-sm text-gray-500">
            {{ Str::limit($post->description, 200, '...') }}
          </p>
        </div>
      </article>
      <br>
      {{ $posts->links() }}
      @empty

      <div class="grid h-screen place-content-top bg-white px-4">
        <div class="text-center">
          <h1 class="text-9xl font-black text-gray-200">NOTHING</h1>
      
          <p class="text-2xl font-bold tracking-tight text-gray-900 sm:text-4xl">Uh-oh!</p>
      
          <p class="mt-4 text-gray-500">We can't find any post.</p>
      
          <a
            href="{{ route('posts.create') }}"
            class="mt-6 inline-block rounded bg-indigo-600 px-5 py-3 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring"
          >
            Create one !
          </a>
        </div>
      </div>

      @endforelse

</x-layout>