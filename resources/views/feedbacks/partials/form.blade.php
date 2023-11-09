<form id="feedback_form" action="{{$form_action}}" method="POST" class="" enctype="multipart/form-data">
    {{csrf_field()}}
       
    <input type="hidden"  id="" name="_method" value="{{$form_method}}" placeholder="">    
        
    <div class="form-row">

    <div class=" col-lg-6">
        <div class="form-group">
            <label for="" class="col-form-label">Title<span>*</span></label>
            <div>
                <input type="text" class="form-control" id="title" name="title" value="{{@$feedback->title}}" placeholder="" required>
            </div>
        </div>
    </div>

    <div class=" col-lg-6">
        <div class="form-group" >
            <label for="" class="col-form-label">Type<span>*</span></label>
            <div class="dropdown">
                <select id="category_id" name="category_id" class="form-control"  value="" required>
                        
                        <option value="" selected>--Select--</option> 
                        <@foreach($category_type as $type)

                        <option value="{{$type->id}}" @if(isset($feedback) && $feedback->category_id == $type->id) selected  @endif>{{$type->category}}</option>

                     @endforeach
                     
                </select>
            </div>
        </div>
    </div>
        
    <div class="col-lg-12">
        <div class="form-group">
            <label for="" class="col-form-label">Description<span>*</span></label>
                       
                <textarea class="form-control" style="min-height: 150px;" id="description" name="description" placeholder="" required>{{@$feedback->description}}</textarea>
                        
            
        </div>    
    </div>
    
  
  </div>

    <div id="validation_errors"></div>   
    <div class="form-group ">

        <button type="submit" class="btn btn-success {{ $submit_btn_class }}">{{$submit_btn}}</button>

    </div>

         
    
</form>