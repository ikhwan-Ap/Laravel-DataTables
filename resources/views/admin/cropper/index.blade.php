@extends('layout.structure')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>Data User</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="/">Dashboard</a>
      </div>
      <div class="breadcrumb-item">{{$title}}</div>
    </div>
  </div>

  <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Tabel User</h4>
                <div class="card-header-form">
                  <div class="input-group-btn">
                    <button class="btn btn-primary btnAdd">
                      Tambah User
                    </button>
                  </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-user" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>username</th>
                        <th>Email</th>
                        <th>Aksi</th>
                      </tr>
                    <thead>
        
                  </table>
                </div>
            </div>
          </div>
        </div>
    </div>
  </div>

  <div class="modal fade" data-backdrop="false"  tabindex="-1" role="dialog" id="tambah-user">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="#" id="form-tambah-user">
          <div class="modal-header">
            <h5 class="modal-title">Form Tambah User</h5>
            <button type="button btn-danger" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group col-12">
              <label for="username">Username</label>
              <input id="username" type="text" class="form-control" placeholder="Masukan Username"  name="username"  required>
              <div class="invalid-feedback">

              </div> 
            </div>
            <div class="form-group col-12">
                <label for="email">Email</label>
                <input id="email" type="text" class="form-control" placeholder="Masukan Email"  name="email"  required>
                <div class="invalid-feedback">

                </div> 
             </div>

            <div class="form-group col-12">
              <label for="password">Password</label>
              <input id="password" type="password" class="form-control" placeholder="Masukan Password"  name="password"  required>
              <div class="invalid-feedback">

              </div> 
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

  <div class="modal fade" data-backdrop="false"  tabindex="-1" role="dialog" id="update-user">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="#" id="form-update-user">
          <div class="modal-header">
            <h5 class="modal-title">Form Update User</h5>
            <button type="button btn-danger" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="id">
            <div class="form-group col-12">
              <label for="username_up">Username</label>
              <input id="username_up" type="text" class="form-control" placeholder="Masukan Username"  name="username"  required>
              <div class="invalid-feedback">

              </div> 
            </div>
            <div class="form-group col-12">
                <label for="email_up">Email</label>
                <input id="email_up" type="text" class="form-control" placeholder="Masukan Email"  name="email"  required>
                <div class="invalid-feedback">

                </div> 
             </div>

            <div class="form-group col-12">
              <label for="password_up">Password</label>
              <input id="password_up" type="password" class="form-control" placeholder="Masukan Password"  name="password">
              <div class="invalid-feedback">

              </div> 
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

</section>

@stop
