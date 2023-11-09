@extends('layouts.app')

@section('title','Dashboard')

@section('content')

@include('home.partials.css')


<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Home
</h2>

<div style="text-align:right;margin-top: 10px;margin-bottom: 10px;">

    <a href="{{ url('/feedbacks/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user-plus fa-sm text-white-50"></i> Add Feedback</a>

</div>

<div class="container">
    <div class="row">
    
            <input type="text" id="hdCommentUrl" name="hdCommentUrl" value="{{url('comments')}}" style="display: none;" >   
            <input type="text" id="hdVoteUrl" name="hdVoteUrl" value="{{url('votes')}}" style="display: none;" >      
            <input type="text" id="hdCommentCounter" name="hdCommentCounter" style="display: none;" >
            <input type="text" id="hdUserName" name="hdUserName" value="{{ $userName }}" style="display: none;" >
            <input type="text" id="hdIsAdmin" name="hdIsAdmin" value="{{ IsAdmin('admin') }}" style="display: none;" >

    @php

        $message = 1;
        
    @endphp
    
    @if($feedbacks->count() > 0)

    @foreach($feedbacks as $data)

        <div class="col-md-12">
                <div class="feedback-item">
                    <div style="text-align: right;margin-top: -8px;"><span style="font-size: 12px;color:#007bff;">{{ to_date($data->created_at, true) }}</span></div>
                    <div style="display: flex;"><div class="feedback-title">{{ $data->title }}</div><span style="margin: 7px;">({{ $data->user->name }})</span></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div style="background-color: white;border-radius: 8px;padding: 10px 14px 12px 14px;margin-top: 5px;min-height: 115px;max-height: 400px;overflow-y: auto;">
                            <div class="feedback-category" style="margin-bottom:10px">{{ $data->category->category }}</div>
                            <div class="feedback-description">{{$data->description}}</div>
                            </div>
                            <div style="font-size: 13px;margin:5px;color:#007bff;">
                                <span style="margin:3px;">Votes (<span id="voteCount{{$message}}">{{$data->votes->count()}}</span>)</span>
                                <span style="margin:3px;">Comments (<span id="commentCount{{$message}}">@if(IsAdmin("admin")){{$data->comments->count()}}@else{{getCommentsCountForUser($data->id)}}@endif</span>)</span>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-default comment-button" id="btnVote{{$message}}" name="btnVote{{$message}}" onclick="VoteFun('{{$message}}','{{$data->id}}')" @if(IsVote($data->id, auth()->id())) style="color: #007bff;" @endif >Vote <i class="vote-button fas fa-thumbs-up"></i></button>
                                    <!-- style="display: none" -->
                                    <input type="checkbox" @if(IsVote($data->id, auth()->id())) checked @endif id="cbVote{{$message}}" style="display: none;"  />
                                </div>
                                <div class="col-md-5">
                                    <button class="btn btn-default comment-button" onclick="CommentFun('{{$message}}','{{$data->id}}')" id="btnComment{{$message}}" name="btnComment{{$message}}" data-toggle="modal" data-target="#myModal">Comments <i class="fa fa-comments" aria-hidden="true"></i></button>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div style="background-color: white;border-radius: 8px;padding: 10px 14px 12px 14px;margin-top: 5px;min-height: 200px;max-height: 347px;overflow-y: auto;">
                                
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12" id="commentMainDiv{{$message}}">
                                    @if($data->comments->count() > 0)
                                        
                                        
                                        @php
                                            $commentsCount = $data->comments->count();
                                            $userCommentsCount = 0;
                                            $loopCount = 0;

                                        @endphp

                                        @foreach($data->comments as $row)

                                            
                                            @php
                                                $loopCount = $loopCount + 1;
                                            
                                            @endphp                                 

                                            @if(IsAdmin("admin"))
                                                <div @if($row->user_id == auth()->id()) class="comment-container your-comment-container" @else class="comment-container other-comment-container" @endif>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div style="text-align: right;margin-top: -8px;"><span style="font-size: 09px;color:#007bff;">{{ to_date($row->created_at, true) }}</span></div>

                                                            <div class="user-info" style="color:#007bff;margin-top: -18px;">{{$row->user->name}}</div>
                                                            
                                                            <div class="comment-text">
                                                                {!! $row->content !!}
                                                            </div>

                                                            <div style="text-align: right;">
                                                                <div class="form-check form-switch" style="font-size: 12px;color:red;">
                                                                  <input class="form-check-input" type="checkbox" id="commentSwitch{{$row->id}}" onclick="disableCommentFun('{{$row->id}}')" style="margin-top: 2px;" @if(!$row->status) checked  @endif>
                                                                  <label class="form-check-label" id="lblcommentSwitch{{$row->id}}">Disable</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                     
                                                </div>
                                            @else

                                                @if($row->status)

                                                    
                                                     @php

                                                        $userCommentsCount = $userCommentsCount + 1;
                                                    
                                                    @endphp
                                                    
                                                    <div @if($row->user_id == auth()->id()) class="comment-container your-comment-container" @else class="comment-container other-comment-container" @endif>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div style="text-align: right;margin-top: -8px;"><span style="font-size: 09px;color:#007bff;">{{ to_date($row->created_at, true) }}</span></div>

                                                                <div class="user-info" style="color:#007bff;margin-top: -18px;">{{$row->user->name}}</div>
                                                                
                                                                <div class="comment-text">
                                                                    {!! $row->content !!}
                                                                </div>

                                                            </div>
                                                        </div>
                                                         
                                                    </div>

                                                @endif

                                                

                                                   @if($commentsCount == $loopCount && $userCommentsCount == 0)
                                                   
                                                        <span id="noComment{{$message}}">No Comments...<span>

                                                   @endif
                                                    
                                                

                                            @endif

                                        @endforeach

                                    @else

                                    <span id="noCommentSec{{$message}}">No Comments...<span>

                                    @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
        </div>
        @php

            $message++;

        @endphp

        @endforeach

    @else
    <div style="height:50vh;width: 100vw;display: flex;justify-content: center;align-items: center;">
       <div style="font-size: 28px;">No Feedbacks</div>
   </div>
    @endif


    </div>
</div>            
         


<!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="comment_form" action="{{url('comments')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    
                    <input type="text" id="hdFeedbackID" name="hdFeedbackID" style="display: none;" >
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Comment</h4>
                        <button type="button" class="close" id="modalCloseBtn" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="" class="col-form-label">Comment</label>                                       
                                    <textarea style="min-height: 150px;" id="txtComment" name="txtComment"></textarea>
                                                                    
                            </div>    
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                
                </form>

            </div>
        </div>
    </div>

@include('home.partials.js')
@endsection
