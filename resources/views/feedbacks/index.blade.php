@extends('layouts.app')
@section('title','feedbacks List')
@section('content')
@include('feedbacks.partials.css')

    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Feedbacks</h1>
        <a href="{{ url('/feedbacks/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user-plus fa-sm text-white-50"></i> Add Feedback</a>
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

                     <th>Title</th>                    
                     <th>Category</th>
                     <th>Description</th>
                     <th>Votes</th>
                  @if(IsAdmin("admin"))
                     <th>Created By</th>
                  @endif
                     <th>Created Time</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($feedbacks as $row)

                  <tr>
                     <td>{{$row->title}}</td>
                     <td>{{$row->category->category}}</td>
                     <td>{{$row->description}}</td>    
                     <td>{{$row->votes->count()}}</td> 
                  @if(IsAdmin("admin"))
                     <td>{{$row->user->name}}</td> 
                  @endif                           
                     <td>{{to_date($row->created_at, true)}}</td>    
    
                     <td class="text-center">
                      
                      <a href="{{ url('feedbacks/'.$row->id.'/edit') }}" >
                     
                       <span class="">
                          
                          <i class="fas fa-edit"></i>
                       
                       </span>

                      </a>
                      &ensp;
                      <a href="{{ url('/feedbacks') }}">  
                       
                       <span class="text-danger" onclick="delete_fun(<?php echo $row->id; ?>)" ><i class="fa fa-trash" aria-hidden="true"></i>
                       </span> 
                      
                      </a>

                      <form id="delete-form{{$row->id}}" method="POST" action="{{ url('feedbacks/'.$row->id.'') }}"  >
                       @method('DELETE')
                       @csrf
                      </form>

                     </td>       
                  </tr>
                  @endforeach 
               </tbody>
            </table>
            

            <p>Showing {!! $feedbacks->firstItem() !!} to {!! $feedbacks->lastItem() !!} of {!! $feedbacks->total() !!}</p>    

                     <div class="d-flex justify-content-center">
                     
                            {!! $feedbacks->appends(request()->except('page'))->links() !!}
                     
                     </div>
         </div>
        </div>
    </div>
@include('feedbacks.partials.js')
@endsection

