<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

 <script>

// $(":input").inputmask();

$(document).ready(function () {

 // $("#start_date").datepicker({  format: 'dd/mm/yyyy', autoclose: true });
 
 // $('#search_retailer_form').on('submit', function (e) {
       
 //       var name = $("#name").val();
 //       var type_date = $("#type_id").val();
 //       var region_id = $("#region_id").val();

 //       if(name == "" && type_date == "" && region_id == "")
 //       {
 //         e.preventDefault();
 //       }

 //    });

    $('#feedback_form').on('submit', function (e) {
            e.preventDefault();    

            resetResponse();
            
            $('.btn').attr('disabled', true);

            $form = $(this);

            $.ajax({
                url : $(this).attr('action'),
                type: $(this).attr('method'),
                data: new FormData(this),                     
                contentType: false,
                processData: false
            })
            .done(function() {            

                window.location.href = "{{url('/feedbacks')}}";

            })
            .fail(function(errors) {
                $('#validation_errors').addClass('alert alert-danger')
                $.each(errors.responseJSON.errors, function (indexInArray, value) {
                    $("#validation_errors").append("<p>"+value+"</p>")
                });
                $('.btn').attr('disabled', false);
              
            }) 
            .always(function() {
                                               
            });
        });
        
    });

    function resetResponse() {
        $('#validation_errors').html("");
        $('#validation_errors').removeClass('alert alert-success');
        $('#validation_errors').removeClass('alert alert-danger');
        $('.btn').attr('disabled', false);
    }

</script>