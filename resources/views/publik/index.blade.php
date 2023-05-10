<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>RSDK &mdash; {{$title}}</title>
  <link rel="icon" href="{{ url('css/favicon.jpeg') }}">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('')}}/node_modules/selectric/public/selectric.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <link
   rel="stylesheet"
   href="{{asset('')}}node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css"/>
  <link
   rel="stylesheet"
   href="{{asset('')}}node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css" />

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('')}}css/components.css">
  <link rel="stylesheet" href="{{asset('')}}css/style.css">
</head>
<style>
  .toast-info {
    background-color: #2F96B4 !important;
  }

  .toast-error {
    background-color: #BD362F !important
  }

  .toast-warning {
    background-color: #F89406 !important
  }

  .toast-success {
    background-color: #51A351 !important
  }
  #toast-container > .toast:before {
      position: fixed;
      font-family: FontAwesome;
      font-size: 24px;
      line-height: 18px;
      float: left;
      color: #FFF;
      padding-right: 0.5em;
      margin: auto 0.5em auto -1.5em;
  }        
  #toast-container > .toast-warning:before {
      content: "\f003";
  }
  #toast-container > .toast-error:before {
      content: "\f001";
  }
  #toast-container > .toast-info:before {
      content: "\f005";
  }
  #toast-container > .toast-success:before {
      content: "\f002";
  }

</style>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="{{asset('')}}/img/RSDK.jpeg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>{{$title}}</h4></div>
              <div class="d-flex justify-content-center">
                <p>Pada Proses Pengecekan Anda Diharuskan Mengisi 4 Kriteria Yang tersedia   </p>
              </div>
              <div class="card-body">
                <form action="#" id="form-publik">
                  @foreach ($kriteria as $item)
                  <div class="form-group">
                    <label>{{$item->nama_kriteria}}</label>
                    <input type="text" class="form-control" name="{{'kriteria'.$item->id}}">
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  @endforeach
                  <div class="form-group">
                    <label for="">Untuk Mendapatkan Nilai IPSS anda dapat membuka 
                      <a href="https://www.uptodate.com/contents/calculator-international-prostatism-symptom-score-ipss" target="_blank" style="text-decoration: none;">LINK INI</a>
                    </label>
                  </div>
                  <div class="form-group">
                    <label>Tindakan</label>
                    <select name="kronis" id="kronis" class="form-control">
                      <option value="" hidden>Pilih Tindakan</option>
                      <option value="1">Pernah Melakukan Operasi</option>
                      <option value="2">Pengobatan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Proses
                    </button>
                  </div>
                </form>
                <div class="table-responsive d-none">
                  <table class="table table-striped" id="table-publik" style="width: 100%">
                    <thead>
                      <tr>
                        <th>Jika</th>
                        <th>Tingkatan</th>
                        <th>Dan</th>
                        <th>Tingkatan</th>
                        <th>Dan</th>
                        <th>Tingkatan</th>
                        <th>Dan</th>
                        <th>Tingkatan</th>
                        <th>Hasil Inferensi</th>
                      </tr>
                    </thead>
                    <tbody id="data-publik">

                    </tbody>
                  </table>
                </div>

                <div class="form-group dataFuzy">
                  <label for="">Nilai Fuzyfikasi</label>
                    <input type="text" class="form-control" id="hasil_fuzy" readonly>
                </div>

                <div class="form-group dataFuzy">
                  <label for="">Hasil dari perhitungan</label>
                  <textarea name="kronis_fuzy" id="kronis_fuzy" cols="50" rows="10" class="form-control" readonly>

                  </textarea>
                </div>  
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Remanua 2022
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{asset('')}}js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="{{asset('')}}/node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="{{asset('')}}/node_modules/selectric/public/jquery.selectric.min.js"></script>

  <!-- Template JS File -->
  <script src="{{asset('')}}js/scripts.js"></script>
  <script src="{{asset('')}}js/custom.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  {{-- Data tables --}}
  <script src="{{asset('')}}node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('')}}node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{asset('')}}node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
  <script src="{{asset('')}}js/page/modules-datatables.js"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('')}}/js/page/auth-register.js"></script>
</body><script>
  var csrf = $('meta[name="csrf-token"]').attr('content');
  var table;
  $(document).ready(function() {
      $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': csrf
          }
      });
      $('#table-publik').hide();
      $('.dataFuzy').hide();
      table = $('#table-kriteria').DataTable({
                  "processing": true,
                  "serverSide": true,
                  'destroy': true,
                  "order": [],
                  "ajax": {
                      "url": "/kriteria",
                      "type": "POST",
                  },
                  "columnDefs": [{
                      "targets": [0],
                  }, ],
      });
      $(document).on('click','.btnAdd',function (e) {
        e.preventDefault();
        $('#tambah-kriteria').modal('show');
      })
      $(document).on('submit','#form-publik',function (e) {
          e.preventDefault();
          $.ajax({
              type: "POST",
              url: "publik/create",
              data: $(this).serialize(),
              dataType: "json",
              success: function (response) {
              status = response.status;
              message = response.message;
              if (status == 'error_validation') {
                  message.forEach(text => {
                      return  toastr['error'](text);
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
              url: `kriteria/${id}`,
              dataType: "json",
              success: function (response) {
                  data = response.data;
                  $('#id_kriteria_up').val(data.id);
                  $('#nama_kriteria_up').val(data.nama_kriteria);
                  $('#kode_kriteria_up').val(data.kode_kriteria);
                  $('#hasil_kriteria_up').val(data.hasil_kriteria);
                  $('#update-kriteria').modal('show');
              }
          });
      })
      $(document).on('submit','#form-update-kriteria',function (e) {
          e.preventDefault();
          id = $('#id_kriteria_up').val();
          $.ajax({
              type: "PUT",
              url: `kriteria/${id}`,
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
                  url: `kriteria/${id}`,
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
        $('#table-publik').show();
        $('.dataFuzy').show();
        $('#data-publik').children().remove();
        return  Swal.fire({
          title: `Data Berhasil Di proses`,
          text: `Proses Berhasil Di lakukan`,
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'ok'
          }).then((result) => {
            if (result.isConfirmed) {
            nilai_inferensi = [];
            nilai_bagi = [];
            response.forEach(item=>{
                kronis = item.kronis;
                $('#data-publik').append(`<tr>`);
                    item.gejala.forEach(val=>{
                        nilai_min = Math.min(val.hasil);
                        $('#data-publik').append(`
                                <td>
                                    ${val.nama_kriteria}
                                </td>
                                <td>
                                    ${val.nama_tingkatan}
                                </td>
                                <td>
                                    ${val.hasil}
                                </td>
                        `);
                })
                nilai_data = nilai_min * 3;
                nilai_rumus = 3 - nilai_data;
                hasil_rumus = (nilai_rumus * nilai_min) + nilai_rumus*nilai_min;
                nilai_bagi.push(nilai_min);
                nilai_inferensi.push(hasil_rumus);
                $('#data-publik').append(`
                    <td>${nilai_min}</td>   
                    <td>${nilai_rumus}</td>
                    <td>${item.hasil_aturan}</td>
                `);
                $('#data-publik').append('</tr>')
            })
            const hasil_inferensi = nilai_inferensi.reduce((accumulator, value) => {
                return accumulator + value;
            }, 0);
            const hasil_min = nilai_bagi.reduce((number,value) =>{
                return number+value;
            }, 0);
            nilai_defuzifikasi = hasil_inferensi / hasil_min;
            if(isNaN(nilai_defuzifikasi)){
                nilai_defuzifikasi = 0;
            }
            if(nilai_defuzifikasi < 0){
                nilai_defuzifikasi = 0;
            }
            if(nilai_defuzifikasi > 10){
                nilai_defuzifikasi = 10;
            }
            if(kronis == 1){
                if(nilai_defuzifikasi < 5 ){
                    $('#kronis_fuzy').html('Tidak Terdeteksi Kanker Prostat, silahkan periksakan lebih lanjut');
                }else if(nilai_defuzifikasi < 8){
                    $('#kronis_fuzy').html('Terdeteksi Kanker Prostat Sedang Jika anda merasakan gejala ini tidak kunjung sembuh, silahkan periksakan lebih lanjut');
                }else if(nilai_defuzifikasi < 10){
                    $('#kronis_fuzy').html('Terdeteksi Kanker Prostat Sangat Tinggi Sebaiknya Melakukan Pemeriksaan Lebih Lanjut Ke Doker Specialist'); 
                }
            }else{
                if(nilai_defuzifikasi < 5 ){
                    $('#kronis_fuzy').html('Tidak Terdeteksi Prostat, silahkan periksakan lebih lanjut');
                }else if(nilai_defuzifikasi < 8){
                    $('#kronis_fuzy').html('Terdeteksi Prostat Sedang Jika anda merasakan gejala ini tidak kunjung sembuh, silahkan periksakan lebih lanjut');
                }else if(nilai_defuzifikasi < 10){
                    $('#kronis_fuzy').html('Terdeteksi Kanker Prostat Sangat Tinggi Sebaiknya Melakukan Pemeriksaan Lebih Lanjut Ke Doker Specialist'); 
                }
            }
            $('#hasil_fuzy').val(Math.round(nilai_defuzifikasi) *10 +'%');
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
</html>
