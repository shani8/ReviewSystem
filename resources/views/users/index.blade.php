@extends('layouts.app')
@section('title','users List')
@section('content')
@include('users.partials.css')

    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
        
    </div>
 
    @include('flash_messages')

    @if(session()->has('message'))
    <div class="alert alert-info">
       {{ session()->get('message') }}
    </div>
    @endif 

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

        </div>
        <div class="card-body">
            <div class="table-responsive">     
                     
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>

                     <th>Name</th>                    
                     <th>Email</th>
                     <th>Created Time</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($users as $row)

                  <tr>
                     <td>{{$row->name}}</td>
                     <td>{{$row->email}}</td>                      
                     <td>{{to_date($row->created_at, true)}}</td>    
    
                     <td class="text-center">
                      
                      <a href="{{ url('/users') }}">  
                       
                       <span class="text-danger" onclick="delete_fun(<?php echo $row->id; ?>)" ><i class="fa fa-trash" aria-hidden="true"></i>
                       </span> 
                      
                      </a>

                      <form id="delete-form{{$row->id}}" method="POST" action="{{ url('users/'.$row->id.'') }}"  >
                       @method('DELETE')
                       @csrf
                      </form>

                     </td>       
                  </tr>
                  @endforeach 
               </tbody>
            </table>
            

            <p>Showing {!! $users->firstItem() !!} to {!! $users->lastItem() !!} of {!! $users->total() !!}</p>    

                     <div class="d-flex justify-content-center">
                     
                            {!! $users->appends(request()->except('page'))->links() !!}
                     
                     </div>
         </div>
        </div>
    </div>
@include('users.partials.js')
@endsection

