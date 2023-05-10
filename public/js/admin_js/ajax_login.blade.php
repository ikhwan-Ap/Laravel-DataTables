<script>
$(document).ready(function () {
  $(document).on('submit','#form-login',function (e) {
    e.preventDefault();
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
      type: "POST",
      url: "/login",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        status = response.status;
        if (status == 'error') {
        message = response.message;
        handling_error(message);
      }else{
        handling_success(response);
        }
      }
    });
  })

  function handling_success(response) {
    Swal.fire({
      title: `${response.status}`,
      text: `${response.message}`,
      icon: 'success',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'ok'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/";        
      } 
    })
  }

  function handling_error(message) {
    if(Array.isArray(message)){
        message.forEach(function(text) {
        return  toastr['error'](text);
      });
    }else{
      return toastr['error'](message);
    }
  }
})
</script>
