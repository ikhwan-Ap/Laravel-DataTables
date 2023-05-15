<script>
  var csrf = $('meta[name="csrf-token"]').attr('content');
  var table;
  $(document).ready(function() {
      $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': csrf
          }
      });
       table = $('#table-cropper').DataTable({
                  "processing": true,
                  "serverSide": true,
                  'destroy': true,
                  "order": [],
                  "ajax": {
                      "url": "/cropper",
                      "type": "POST",
                      "data":{
                        status:'all'
                      }
                  },
                  "columnDefs": [{
                      "targets": [0],
                  }, ],
        });
      $(document).on('click','.btnAdd',function (e) { 
          e.preventDefault();
          $('#tambah-cropper').modal('show');
      })
      $(document).on('submit','#form-tambah-cropper',function (e) { 
          e.preventDefault();
          $.ajax({
              type: "POST",
              url: "cropper/create",
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
              url: `cropper/${id}`,
              dataType: "json",
              success: function (response) {
                  data = response.data;
                  $('#id').val(data.id);
                  $('#name_up').val(data.name);
                  $('#desc_up').val(data.description);
                  $('#image').val(data.image);
                  $('#update-cropper').modal('show');
              }
          });
      })
      $(document).on('submit','#form-update-cropper',function (e) {  
          e.preventDefault();
          id = $('#id').val();
          $.ajax({
              type: "PUT",
              url: `cropper/${id}`,
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

      let cropper;
      let modal = $('#modal');
      let image = document.getElementById('image');
      $(document).on('change','#image',function (e) {  
        e.preventDefault();
        const tempUrl = URL.createObjectURL(e.target.files[0]);
        let type = e.target.files[0].type;
        let size = e.target.files[0].size;
        var files = event.target.files;
        let handling =  handlingTypeFile(type,size);
        if(handling == false){
            return false;
        }
        $('#img').attr('src', tempUrl);
        URL.revokeObjectURL(e.target.files[0]);
        var done = function(url) {
            image.src = url;
            modal.modal('show');
        };

        if (files && files.length > 0) {
            reader = new FileReader();
            reader.onload = function(event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
      })
      modal.on('shown.bs.modal', function() {
          cropper = new Cropper(image, {
              aspectRatio: 216 / 121,
              viewMode: 1,
              preview: '.preview'
          });
      }).on('hidden.bs.modal', function() {
          cropper.destroy();
          cropper = null;
      });

      $('#crop').click(function() {
          canvas = cropper.getCroppedCanvas({
              width: 1500,
              height: 1500
          });
          $("#thumbnail").val('');
          $('#cover').val('');
          canvas.toBlob(function(blob) {
              const img = document.querySelector('#img_thumbnail');
              img.src = URL.createObjectURL(blob);
              var reader = new FileReader();
              reader.readAsDataURL(blob);
              reader.onloadend = function() {
                  var base64data = reader.result;
                  upload = $("#cover").val(base64data);
              };
              modal.modal('hide');
          });
      });
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
                  url: `cropper/${id}`,
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
          $('#tambah-cropper').modal('hide');
          $('#form-tambah-cropper')[0].reset()
          $('#update-cropper').modal('hide');
          $('#form-update-cropper')[0].reset()
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
      function handlingTypeFile(type,size) {
        const allowedFileTypes = [
            'image/jpg', 'image/jpeg', 'image/png', 'image/JPG','image/JPEG','image/PNG'
        ];
        const maxSize = 10485760;
        if (!allowedFileTypes.includes(type)) {
            Swal.fire({
            icon: 'error',
            title: 'Terjadi kesalahan',
            text: 'Harap upload file gambar ber-ekstensi jpg, jpeg atau png!',
            });
            return false;
        }
        if (size > maxSize) {
          Swal.fire({
            icon: 'error',
            title: 'Terjadi kesalahan',
            text: 'Ukuran maksimal file adalah 10MB!',
          });

          return false;
        }
        return true;
    }
  })
</script>