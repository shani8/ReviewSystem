@extends('layouts.app')

@section('title','Update Users')

@section('content')
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

    <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-size: 30px;">
        {{ __('Profile') }}
    </h2>
   

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if(!IsAdmin("admin"))
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg col-md-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg col-md-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

        @if(!IsAdmin("admin"))
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg col-md-6">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        @endif
        </div>
    </div>

@endsection