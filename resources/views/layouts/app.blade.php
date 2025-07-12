<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="120x120" href="image/logo.jpg">
    <link rel="icon" type="image/png" sizes="64x64" href="image/logo.jpg">
    <link rel="icon" type="image/png" sizes="32x32" href="image/logo.jpg">
    <link rel="stylesheet" href="css/VidScribe.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>VidScribe</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
 

 
<style>

    @media(max-width: 767px) {
    h1 {
        display: flex;
        justify-content: center;
        margin-bottom: 80px;
        font-size: 28px;
    }
}

    @media(max-width: 547px) {
    h1 {
        display: flex;
        justify-content: center;
        margin-bottom: 80px;
        font-size: 25px;
    }
}


@media(max-width: 493px) {
    h1 {
        display: flex;
        justify-content: center;
        margin-bottom: 80px;
        font-size: 22px;
    }
}


@media(max-width: 439px) {
    h1 {
        display: flex;
        justify-content: center;
        margin-bottom: 80px;
        font-size: 19px;
    }
}



div#offcanvasScrolling {
    width: 290px !important;
    top: 66px !important;
}
    ul {
    overflow: auto;
}

li.nav-item.menu-items.mb-2 {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
 .sidebar {
     min-height:0 !important;
 }

 .sidebar .nav {
    overflow: hidden;
    flex-wrap: nowrap;
    flex-direction: column;
    margin-bottom: 60px;
    padding-top: 70px;
    position: fixed;
    height: 100%;
    width: 250px;
}
    a.btn.btn-secondary.dropdown-toggle {
    background: #2d2d2d29;
    border: none;
}

    .sidebar .sidebar-brand-wrapper {z-index: 100000000000000000; background: none;}

            a.dropdown-item {
        color: white !important;
    }

        a.dropdown-item:hover {
        color: black !important;
    }
    
    span {
        padding: 4px 11px;
    }
    
    hr {
        margin-top: -1rem;
        margin-bottom: 0.5rem;
        border: 0;
        border-top: 1.8px solid white;
    }
 
   
    
    div#offcanvasTop {
        width: 50%;
        margin: auto;
    }
   
     @media (max-width: 500px) {
    
        div#offcanvasTop {
        width: 1000%;
        margin: auto;
    }
   
    }

    .brdr {
        border: 0;
        border-top: 1px solid rgb(68, 63, 63);
        margin-top: 4px;
        margin-bottom: 10px;
    }
    li.nav-item.menu-items.mb-2:hover {
    background: black;
    color: white !important;
 
}

a.nav-link:hover {
color: white !important;
    background: black !important;
}

a.nav-link {
    color: #4e4242d9;
}

ul.dropdown-menu.show {
    background: #212529 !important;
    color: white !important;
}

body.light-mode {
    background-color: #ffffff !important;
    color: #000 !important;
}

body.light-mode #app,
body.light-mode .sidebar,
body.light-mode nav,
body.light-mode .main-content {
    background-color: #ffffff !important;
    color: #000 !important;
}


body.dark-mode {
    background-color: #121212 !important;
    color: #ffffff !important;
}

body.dark-mode #app,
body.dark-mode .sidebar,
body.dark-mode nav,
body.dark-mode .main-content {
    background-color: #121212 !important;
    color: #ffffff !important;
}

.brdr-media {
    border: 1px solid #49454582;
    margin-top: 8px;
    margin-bottom: 9px;
    width: 100%;
}

.offcanvas-body{padding: 0;}



</style>


@php
use App\Models\theme;


$mode=theme::where("user_id" ,'=' , auth()->user()->id)->value("mode");


@endphp

<body class="{{ $mode === 'Light' ? 'light-mode' : 'dark-mode' }}">

        <div id="app">  


      


    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                        <a class="" href="{{route("home")}}">
                           
                            @if ($mode === 'Light')
            <img width="30" src="{{asset("image/logowhite.jpg")}}" alt="logo" />      
               @else
              <img width="30" src="{{asset("image/logo.jpg")}}" alt="logo" /> 

            @endif
</a>
            <span class=""> Video Assistant </span>
        </div>
        <ul id="nav" class="nav">
            <li class="nav-item profile">
                <div class="profile-desc">
                    <div class="profile-pic">
                        <div class="count-indicator">
                            <img class="img-xs rounded-circle " src="https://th.bing.com/th/id/R.4e9a9213eb6cacc05b42ead4c364aef8?rik=e%2frEilzC8bkv3g&pid=ImgRaw&r=0" alt="">

                        </div>

                        <div class="profile-name">
                            <h5 class="mb-1 font-weight-normal ">{{auth()->user()->name}}</h5>

                        </div>
                    </div>
                    <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>

                </div>

            </li>


            <li class="nav-item nav-category">
                <span class="nav-link"></span>
            </li>
            <li class="nav-item menu-items ">
                <a class="nav-link" href="{{route("home")}}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"/>
  <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z"/>
</svg>

                    <span class="menu-title">Upload Video</span>
                </a>
            </li>

            <li class="nav-item menu-items mt-6">
                <a class="nav-link" href="{{route("history")}}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
  <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
  <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
  <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
</svg>
                    <span class="menu-title">History</span>
                </a>
                
            </li>

            
                <div class="brdr">
                </div>
                <ul>

{{-- <li class="nav-item menu-items mb-2" style="list-style: auto;">
    <span class="nav-link disabled text-muted">Your Videos</span>
</li> --}}

@foreach ($userVideos ?? [] as $video)
    <li class="nav-item menu-items mb-2" style="list-style: auto;">
        <a class="nav-link" style="text-decoration: none;"
           href="{{ route('show', $video->id) }}">
            {{ $video->title ?? 'Untitled Video' }}
                  
                                       
                                      @method("delete")
                                    <a href="javascript:void(0);"  
                                    onclick="confirmDelete('{{ route('delete', $video->id) }}', '{{ addslashes($video->title) }}')"
                                    class="nav-link"
                                    >
                                    

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg>                                                                        </a>
                             </a>
        </a>

         

    </li>
@endforeach


                </ul>
        </ul>
    </nav>

    <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="" href="{{route("home")}}">
                
              @if ($mode === 'Light')
            <img width="30" src="{{asset("image/logowhite.jpg")}}" alt="logo" />      
              
            @else
              <img width="30" src="{{asset("image/logo.jpg")}}" alt="logo" /> 

            @endif
</a>
        </div>


        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch" style="justify-content:flex-end">
          

            <div class="dropdown d-flex align-items-center">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class=" rounded-circle " width="20px" src="https://th.bing.com/th/id/R.4e9a9213eb6cacc05b42ead4c364aef8?rik=e%2frEilzC8bkv3g&pid=ImgRaw&r=0" alt="">
                    <span> {{auth()->user()->name}} </span>

                </a>

                <ul style="margin: -18px 11px;" class="dropdown-menu" data-bs-popper="none">
                    <li>
                        <a class="dropdown-item" href="#"> <img width="30" src="https://th.bing.com/th/id/R.4e9a9213eb6cacc05b42ead4c364aef8?rik=e%2frEilzC8bkv3g&pid=ImgRaw&r=0" style="margin-left: -9px; border-radius: 50%;" />

                            <span>{{auth()->user()->name}}</span>
                        </a>
                        <span>

    
</span>

                    </li>
                    <hr>
                    <li style="margin-bottom: 2px;">

                        <a class="dropdown-item" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop" href="#"> <svg style="margin-left: -9px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
</svg>

                            <span>Setting</span>

                        </a>

                    </li>




                    <li><a class="dropdown-item" href="{{route("Logout")}}"><svg style="margin-left: -9px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg>
 
<span>Logout</span>
 
</a></li>
                </ul>
      
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>

 
        </div>
 

      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">           <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list-nested" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 0 1 5 11h10a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m-2-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m-2-4A.5.5 0 0 1 1 3h10a.5.5 0 0 1 0 1H1a.5.5 0 0 1-.5-.5"/>
</svg></button>



@if ($mode === 'Dark')

<style>

a.nav-link {
color: #ffffff !important;

}
div#offcanvasScrolling{
background: #1e1b1b;
    color: white !important;

}

</style>

@endif

<div class="offcanvas offcanvas-start" style="" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h5>Video Assistant </h5>
    <button type="button" class="btn-close float-right " data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">

    <ul id="nav" class="nav">
            <li class="nav-item profile">
                <div class="profile-desc">
                    <div class="profile-pic">
                        <div class="count-indicator">
                            <img class="img-xs rounded-circle " src="https://th.bing.com/th/id/R.4e9a9213eb6cacc05b42ead4c364aef8?rik=e%2frEilzC8bkv3g&pid=ImgRaw&r=0" alt="">

                        </div>

                        <div class="profile-name">
                            <h5 class="mb-1 font-weight-normal ">{{auth()->user()->name}}</h5>

                        </div>
                    </div>
                    <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>

                </div>

            </li>


            <li class="nav-item nav-category">
                <span class="nav-link"></span>
            </li>

            <li class="nav-item menu-items mt-6">
                <a class="nav-link" href="{{route("home")}}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"/>
  <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z"/>
</svg>

                    <span class="menu-title">Upload Video</span>
                </a>
            </li>


            <li class="nav-item menu-items mt-6">
                                    <a class="nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop" href="#"> <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
</svg>

                            <span>Setting</span>

                        </a>
                
            </li>


                     <li class="nav-item menu-items mt-6">
                <a class="nav-link" href="{{route("Logout")}}"><svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg>
 
                    <span class="menu-title">Logout</span>
                </a>
                
            </li>

            
                     <li class="nav-item menu-items mt-6">
                <a class="nav-link" href="{{route("history")}}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
  <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
  <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
  <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
</svg>
                    <span class="menu-title">History</span>
                </a>
                
            </li>

            
                <div class="brdr-media">
                </div>
                
                <ul>

{{-- <li class="nav-item menu-items mb-2" style="list-style: auto;">
    <span class="nav-link disabled text-muted">Your Videos</span>
</li> --}}

@foreach ($userVideos ?? [] as $video)
    <li class="nav-item menu-items mb-2" style="list-style: auto;">
        <a class="nav-link" style="text-decoration: none;"
           href="{{ route('show', $video->id) }}">
            {{ $video->title ?? 'Untitled Video' }}
                  
                                       
                                      @method("delete")
                                    <a href="javascript:void(0);"  
                                    onclick="confirmDelete('{{ route('delete', $video->id) }}', '{{ addslashes($video->title) }}')"
                                    class="nav-link"
                                    >
                                    

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg>                                                                        </a>
                             </a>
        </a>

         

    </li>
@endforeach


                </ul>
        </ul>

    
  </div>
</div>

</div>

        </nav>


    <div class="offcanvas offcanvas-top " style="background-color: #212530b7; color:#fff; border-radius:20px" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasTopLabel">Theme</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <form  action="{{route("Mode")}}"  method="POST">
                @csrf

            <select class="form-control" style="color:#fff; background: black; width: 95%;
    margin: auto;" name="mode">
                <option >Select Mode</option>
                <option value="Dark">Dark</option>
                <option value="Light">Light</option>

            </select>
            <button style="background-color: #9f9a9a94;
    border: 1px solid transparent;
    padding: 0.5rem 0.75rem;
    margin-top: 17px; margin-left:14px;" class="btn btn-black text-light">ChangeSystem</button>
        
        </form>
    </div>
    </div>
 
           


        <main class="py-4">
            @yield('content')
        </main>

    </div>

   <script>

function Menu(){
    
    var x = document.getElementById("nav");

    if (x.style.display === "none") {
        x.style.display = "block";
        } else {
            x.style.display = "none";
            }

           
}

   </script>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function confirmDelete(deleteUrl, userName) {
    Swal.fire({
        title: "Are you sure 😬?",
        html: "<span style='font-size: 20px;'>Do you want to delete the history: <b>" + userName + "</b>?</span>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete!", 
        cancelButtonText: "Cancel",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        width: '600px',  
        padding: '2em',  

    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = deleteUrl;
        } 

        
        else {
            Swal.fire("Cancelled", "The history is safe!😇", "error");
        }

    });




}


 


 
 
 
</script>
 

@if(session('success'))
    <script>
    window.onload = function() {
        Swal.fire({
            title: 'Success!',
             html: "<span style='font-size: 20px;'>{{ session('success') }}</span>",

            icon: 'success',

            confirmButtonText: 'OK',
            width: '600px',  
        padding: '2em',  

        });
    }

 

</script>
@endif
  
 

<style> 

button.swal2-confirm.btn.btn-success {
    margin-left: 7px;
  }

  button.swal2-confirm.swal2-styled.swal2-default-outline {
    padding: 9px 16px;
    font-size: 13px;
}

button.swal2-cancel.swal2-styled.swal2-default-outline
{

    padding: 9px 16px;
    font-size: 13px;
}

div#swal2-html-container {
    font-size: 17px;
}
</style>


<script>
@if(session('error'))
    window.onload = function() {
        Swal.fire({
            icon: "error",
            title: "Oops...🤨",
            html: "<span style='font-size: 20px;'>{{ session('error') }}</span>",
            width: '600px',  
            padding: '2em',
            confirmButtonText: 'OK'
        });
    }
@endif
</script>
 
 

</body>
</html>
