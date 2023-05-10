<script>
  var csrf = $('meta[name="csrf-token"]').attr('content');
  var table;
  $(document).ready(function() {
      $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': csrf
          }
      });
      table = $('#table-user').DataTable({
                  "processing": true,
                  "serverSide": true,
                  'destroy': true,
                  "order": [],
                  "ajax": {
                      "url": "/user",
                      "type": "POST",
                  },
                  "columnDefs": [{
                      "targets": [0],
                  }, ],
          });
          $(document).on('click','.btnAdd',function (e) { 
          e.preventDefault();
          $('#tambah-user').modal('show');
      })
      $(document).on('submit','#form-tambah-user',function (e) { 
          e.preventDefault();
          $.ajax({
              type: "POST",
              url: "user/create",
              data: $(this).serialize(),
              dataType: "json",
              success: function (response) {
              status = response.status;
              message = response.message;
              if (status == 'error_validation') {
                  message.forEach(text => {
                    return console.log(text);
                  });
              }else if(status =='error'){
                  handling_error(response);
              }else{
                  handling_success(response);
              }
              }
          })
      })
      $(document).on('click','.btnEdit',function (e) {  
          e.preventDefault();
          id = $(this).data('id');
          $.ajax({
              type: "GET",
              url: `user/${id}`,
              dataType: "json",
              success: function (response) {
                  data = response.data;
                  $('#id').val(data.id);
                  $('#username_up').val(data.username);
                  $('#email_up').val(data.email);
                  $('#update-user').modal('show');
              }
          });
      })
      $(document).on('submit','#form-update-user',function (e) {  
          e.preventDefault();
          id = $('#id').val();
          $.ajax({
              type: "PUT",
              url: `user/${id}`,
              data: $(this).serialize(),
              dataType: "json",
              success: function (response) {
                status = response.status;
                message = response.message;
                if(status ==='success'){
                  handling_success(response);
                }else if(status ==='error_validation'){
                  message.forEach(text => {
                      return  toastr['error'](text);
                  });
                }else{
                  handling_error(response);
                }
              }
          });
      })
      $(document).on('click','.btnDel',function (e) { 
          e.preventDefault();
          id = $(this).data('id');
          if(id){
              deleteData(id);
          }
      })
      function deleteData(id) {
          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
              if (result.isConfirmed) {
              $.ajax({
                  type: "DELETE",
                  url: `user/${id}`,
                  dataType: "json",
                  success: function (response) {   
                  if(response.status === 'success'){
                      Swal.fire(
                      'Deleted!',
                      `${response.message}`,
                      'success'
                      )   
                      table.ajax.reload(null, false);
                  }else{
                      Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: `${response.message}`,
                      })
                  }
                  }
              });
              }
          })
      }
      function handling_success(response) {
        return  Swal.fire({
          title: `${response.status}`,
          text: `${response.message}`,
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'ok'
          }).then((result) => {
          if (result.isConfirmed) {
          $('#tambah-user').modal('hide');
          $('#form-tambah-user')[0].reset()
          $('#update-user').modal('hide');
          $('#form-update-user')[0].reset()
          table.ajax.reload(null, false);
          } 
          })
      }
      function handling_error(response) {  
         return Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: `${response.message}`,
          })
      }
  })
</script>