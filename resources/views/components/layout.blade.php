<!DOCTYPE html>
<html lang="en"  class="h-full bg-gray-100" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?forms" ></script>
    <title>@yield('title')</title>
</head>
<body class="h-full" >

 

<div class="min-h-full">
    <nav class="bg-cyan-900">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          
          <div class="flex items-center justify-between">
            <div class="flex-shrink-0">
              <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <x-nav-link href="/" :active="request()->is('/')" >Home</x-nav-link>
                <x-nav-link href="/posts" :active="request()->is('posts')" >Posts</x-nav-link>
                <x-nav-link href="/contact" :active="request()->is('contact')" >Contact us</x-nav-link>
            
            </div>
            </div>
           
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center  md:ml-6">
                @auth
                <div class=" flex justify-center  ">
                  <form method="POST" action="{{ route('logout.destroy') }}">
                    @csrf
                  <x-obutton   :active="request()->is('logout')" >Log Out</x-obutton>
                </form>
                </div>
                @endauth
                @guest
                <div class=" flex justify-center space-x-2  ">
                  <x-onav-link  href="{{ route('register') }}" :active="request()->is('register')" >Register</x-onav-link>
                  <x-onav-link  href="{{ route('login') }}" :active="request()->is('login')" >Log In</x-onav-link>
                </div>
                @endguest
                
  
            
            </div>
          </div>
         
        </div>
      </div>
  
     
    </nav>
  
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between items-center">
          <h1 class="text-3xl font-bold tracking-tight text-gray-900">@yield('heading')</h1>
          <div class=" flex items-center">@yield('button')</div>
        </div>
      </header>
      
      
    
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{ $slot }}
      </div>
    </main>
  </div>
  
</body>
</html>