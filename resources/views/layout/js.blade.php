  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{asset('')}}js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="{{ asset('')}}node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
  <script src="{{ asset('')}}node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="{{ asset('')}}node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
  <script src="{{ asset('')}}node_modules/summernote/dist/summernote-bs4.js"></script>
  <script src="{{ asset('')}}node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  {{-- SweetAlert --}}
  <script src="{{asset('')}}node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Template JS File -->
  <script src="{{asset('')}}js/scripts.js"></script>
  <script src="{{asset('')}}js/custom.js"></script>
  
  <!-- Page Specific JS File -->
  {{-- <script src="{{asset('')}}js/page/index.js"></script> --}}
  {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}

  <script src="{{asset('')}}node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('')}}node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{asset('')}}node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
  <script src="{{asset('')}}js/page/modules-datatables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>


  @if ($title == 'Data User')
     <?php  include '../public/js/admin_js/ajax_user.blade.php'; ?>
  @elseif ($title == 'Data User Client Side')
     <?php  include '../public/js/admin_js/ajax_user_client_side.blade.php'; ?>  
  @endif


  <script>
   $(document).on('click','.logout',function (e) {  
      e.preventDefault();
      Swal.fire({
         title: 'Apakah Kamu Yakin?',
         text: "Kamu Akan Logout?",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, Logout'
         }).then((result) => {
            if (result.isConfirmed) {
            $.ajaxSetup({
                  headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
            });
            $.ajax({
               type: "POST",
               url: `login/logout`,
               dataType: "json",
               success: function (response) {   
                  if(response.status =='success'){
                     Swal.fire(
                        'Success!',
                        `${response.message}`,
                        'success'
                     )
                  }
                  window.location.href = '/';               
               }
            });
         }
      })
   })
   $(document).on('click','.updatePasword',function (e) {  
      e.preventDefault();
      $('#update-pasword').modal('show');
   })
   $(document).on('submit','#form-update-password',function (e) { 
      e.preventDefault();
      id = {{Session::get('id')}};
      $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      $.ajax({
         type: "PUT",
         url: "update_password/"+id,
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
         },
      });
   })
   function handling_success(response) {
      return  Swal.fire({
         title: `${response.status}`,
         text: `${response.message}`,
         icon: 'success',
         confirmButtonColor: '#3085d6',
         confirmButtonText: 'ok'
         }).then((result) => {
         if (result.isConfirmed) {
         $('#update-pasword').modal('hide');
         $('#form-update-pasword')[0].reset()
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
  </script>