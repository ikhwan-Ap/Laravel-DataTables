@extends('layout_login.structure')
@section('content_login')
 <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
            <img src="{{asset('')}}/img/RSDK.jpeg" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
            <h4 class="text-dark font-weight-normal">Selamat Datang Pada <span class="font-weight-bold">Halaman Admin</span></h4>
            <p class="text-muted">Sebelum Memasuki Halaman, Anda harus melakukan login.</p>
            <form method="POST" action="#" id="form-login" class="needs-validation" novalidate="">
              @csrf
              <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="username" class="form-control"  name="username" tabindex="1" required  autofocus>
                <div class="invalid-feedback">

                </div>
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control"  name="password" required tabindex="2" >
                <div class="invalid-feedback">

                </div>
              </div>
              <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                  Login
                </button>
              </div>
            </form>

            <div class="text-center mt-5 text-small">
              Copyright &copy;  Made with by Remanua
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{asset('')}}/img/background-deteksi.jpg">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-5 pb-3">
                <h5 class="font-weight-normal text-muted-transparent">Purwokerto, Indonesia</h5>
              </div>
              Created by <a class="text-light bb" href="#">Remanua</a>
            </div>
          </div>
        </div>
      </div>
  </section>
@stop