@extends('layouts.app')

@section('title','Update Feedback')

@section('content')

@include('feedbacks.partials.css')
    

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Update Feedback</h1>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
        </div>
        <div class="card-body">
             
                @include('feedbacks.partials.form')
            
        </div>
    </div>


@include('feedbacks.partials.js')

@endsection