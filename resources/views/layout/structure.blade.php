
@include('layout.head')
<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg" style="background: rgb(39, 58, 98);"></div>
      @include('layout.navbar')
      @include('layout.sidebar')
    

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <div class="modal fade" data-backdrop="false"  tabindex="-1" role="dialog" id="update-pasword">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="#" id="form-update-password">
              <div class="modal-header">
                <h5 class="modal-title">Form Update Password</h5>
                <button type="button btn-danger" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group col-12">
                    <label for="kode_kriteria">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="Submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              </div>
           </form>
          </div>
        </div>
      </div>
    @include('layout.footer')
    </div>
  </div>
@include('layout.js')
  <!-- General JS Scripts -->
  
</body>
</html>
