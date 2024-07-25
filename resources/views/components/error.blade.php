@props(['name'])

<div class=" text-sm text-red-500 p-2 ">
@error($name)
{{ $message }}
@enderror
</div>