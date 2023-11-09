<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/pahweg5762tm0n1nbp116a341iryx559w2y0fdu3w2833ev8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script type="text/javascript">

    function VoteFun(id, feedback_id)
    {
       $(function(){            

        // Check if the checkbox with id "myCheckbox" is checked
            var isChecked = $("#cbVote"+id).prop("checked");
            var reqUrl = $("#hdVoteUrl").val();
            var stringValue = $("#voteCount"+id).text();

            if (isChecked)
            {
                $("#cbVote"+id).prop("checked", false);
                $("#btnVote"+id).css("color", "#858796");
                reqUrl += "/delete/"+feedback_id

                var intValue = parseInt(stringValue, 10); 

                if (!isNaN(intValue)) 
                {
                    intValue = intValue - 1; 
                    var resultString = intValue.toString(); 
                    $("#voteCount"+id).text(resultString)
                } 
            }
            else 
            {
                $("#cbVote"+id).prop("checked", true);
                $("#btnVote"+id).css("color", "#007bff");
                reqUrl += "/add/"+feedback_id

                var intValue = parseInt(stringValue, 10); 

                if (!isNaN(intValue)) 
                {
                    intValue = intValue + 1; 
                    var resultString = intValue.toString(); 
                    $("#voteCount"+id).text(resultString)
                } 
            }

      $.ajax({
                url : reqUrl,
                type: "GET",                    
                contentType: false,
                processData: false
            })
            .done(function() {            

                //window.location.href = "{{url('/')}}";

            })
            .fail(function(errors) {
            }) 
            .always(function() {
                                               
            });
            
       });
       return false;
    }

    function CommentFun(id, feedback_id)
    {
       $("#hdCommentCounter").val(id);
       $("#hdFeedbackID").val(feedback_id);
       return false;
    }

    $(document).ready(function () {


        $('#comment_form').on('submit', function (e) {
            e.preventDefault();    
        
            if($("#txtComment").val().trim() == "")
            {
                return false;
            }
            $form = $(this);

            $.ajax({
                url : $(this).attr('action'),
                type: $(this).attr('method'),
                data: new FormData(this),                     
                contentType: false,
                processData: false
            })
            .done(function(data) {            

                //window.location.href = "{{url('/feedbacks')}}";               
                var id = $("#hdCommentCounter").val();
                $("#noComment"+id).hide();
                $("#noCommentSec"+id).hide();

                var stringValue = $("#commentCount"+id).text();

                var intValue = parseInt(stringValue, 10); 

                if (!isNaN(intValue)) 
                {
                    intValue = intValue + 1; 
                    var resultString = intValue.toString(); 
                    $("#commentCount"+id).text(resultString);
                    var userName = $("#hdUserName").val();
                    var CommentText = $("#txtComment").val();
                    var commentDate = data.date;
                    var NewCommentID = data.comentID;

                    if($("#hdIsAdmin").val() == "1")
                    {
                        $("#commentMainDiv"+id).append('<div class="comment-container your-comment-container"><div class="row"><div class="col-md-12"><div style="text-align: right;margin-top: -8px;"><span style="font-size: 09px;color:#007bff;">'+commentDate+'</span></div><div class="user-info" style="color:#007bff;margin-top: -18px;">'+userName+'</div><div class="comment-text">'+CommentText+'</div><div style="text-align: right;"><div class="form-check form-switch" style="font-size: 12px;color:red;"><input class="form-check-input" type="checkbox" id="commentSwitch'+NewCommentID+'" onclick="disableCommentFun('+NewCommentID+')" style="margin-top: 2px;"><label class="form-check-label" id="lblcommentSwitch'+NewCommentID+'">Disable</label></div></div></div></div></div>');
                    }
                    else
                    {
                        $("#commentMainDiv"+id).append('<div class="comment-container your-comment-container"><div class="row"><div class="col-md-12"><div style="text-align: right;margin-top: -8px;"><span style="font-size: 09px;color:#007bff;">'+commentDate+'</span></div><div class="user-info" style="color:#007bff;margin-top: -18px;">'+userName+'</div><div class="comment-text">'+CommentText+'</div></div></div></div>');
                    }
                    



                    //$("#txtComment").text("");
                    var tinymceTextareaId = "txtComment";

                    // Use the setContent method to set the content of the TinyMCE editor to an empty string
                    tinymce.get(tinymceTextareaId).setContent('');

                    $("#hdFeedbackID").val("");
                    $("#modalCloseBtn").click();
                } 

            })
            .fail(function(errors) {
              
            }) 
            .always(function() {
                                               
            });
        });

    });


    function disableCommentFun(id)
    {
        $(function(){            

        // Check if the checkbox with id "myCheckbox" is checked
            var isChecked = $("#commentSwitch"+id).prop("checked");
            var reqUrl = $("#hdCommentUrl").val();
            var status = "";

            if (isChecked)
            {               
                status = "0";
            }
            else 
            {                           
                status = "1";
            }

            reqUrl += "/update/"+id+"/"+status;

      $.ajax({
                url : reqUrl,
                type: "GET",                    
                contentType: false,
                processData: false
            })
            .done(function() {            

                //window.location.href = "{{url('/')}}";

            })
            .fail(function(errors) {
            }) 
            .always(function() {
                                               
            });
            
       });
       
    }

tinymce.init({
                selector: 'textarea[name="txtComment"]',
                plugins: 'wordcount',
                branding: false,
                force_br_newlines: true,
                force_p_newlines: false,
                forced_root_block: '',              
             });
</script>