@props(['active' => false])

<a class="{{ $active ? 'bg-cyan-600 text-white' :  'text-gray-300 hover:bg-cyan-800 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium "
{{$attributes}}
>{{ $slot }}</a>



