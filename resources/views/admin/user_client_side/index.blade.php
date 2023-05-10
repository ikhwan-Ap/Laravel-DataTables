@extends('layout.structure')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>Data Aturan</h1>
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
                <h4>Tabel Aturan</h4>
                <div class="card-header-form">
                  <div class="input-group-btn">
                    <button class="btn btn-primary btnAdd">
                      Tambah Aturan
                    </button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-aturan" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Jika</th>
                        <th>Nilai</th>
                        <th>Dan</th>
                        <th>Nilai</th>
                        <th>Dan</th>
                        <th>Nilai</th>
                        <th>Maka</th>
                      </tr>
                    <thead>
                    <tbody id="data-aturan">

                    </tbody>
        
                  </table>
                </div>
            </div>
          </div>
        </div>
    </div>
  </div>

  <div class="modal fade" data-backdrop="false"  tabindex="-1" role="dialog" id="tambah-aturan">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="#" id="form-tambah-aturan">
          <div class="modal-header">
            <h5 class="modal-title">Form Tambah Aturan</h5>
            <button type="button btn-danger" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group col-12">
              @foreach ($kriteria as $item)
                @php
                  if($item->id == '1'){
                    $text = 'Jika';
                  }else{
                    $text = 'Maka';
                  }
                @endphp
                <label for="kode_kriteria">{{$text .' '.$item->nama_kriteria}}</label>
                <select class="form-control" name="{{$item->kode_kriteria}}" id="{{$item->id}}">
                  @foreach($item->gejala as $val)
                  @foreach($val->tingkatan as $key)
                    <option value="" hidden></option>
                    <option value="{{$val->id}}">{{$key->nama_tingkatan}}</option>
                  @endforeach
                  @endforeach
                </select>
              @endforeach
            </div>
            <div class="form-group col-12">
                  <label for="hasil_aturan">Hasil Aturan</label>
                  <select name="hasil_aturan" id="hasil_aturan" class="form-control">
                    <option value="" hidden>Pilih Hasil</option>
                    <option value="Terdeteksi">Terdeteksi</option>
                    <option value="Tidak Terdeteksi">Tidak Terdeteksi</option>
                  </select>
                  <div class="invalid-feedback"></div>    
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

  <div class="modal fade" data-backdrop="false"  tabindex="-1" role="dialog" id="update-kriteria">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="#" id="form-update-kriteria">
          <input type="hidden" name="id_kriteria" id="id_kriteria_up">
          <div class="modal-header">
            <h5 class="modal-title">Form Update Kriteria</h5>
            <button type="button btn-danger" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group col-12">
              <label for="kode_kriteria_up">Kode Kriteria</label>
              <input id="kode_kriteria_up" type="text" class="form-control" placeholder="Masukan Kode Kriteria"  name="kode_kriteria"  required>
              <div class="invalid-feedback">

              </div> 
            </div>
            <div class="form-group col-12">
                <label for="nama_kriteria_up">Nama Kriteria</label>
                <input id="nama_kriteria_up" type="text" class="form-control" placeholder="Masukan Nama Kriteria"  name="nama_kriteria"  required>
                <div class="invalid-feedback">

                </div> 
             </div>

             <div class="form-group col-12">
                <label for="hasil_kriteria_up">Hasil Gejala</label>
                <select name="hasil_kriteria" id="hasil_kriteria_up" class="form-control">
                  <option value="" hidden>Pilih Hasil</option>
                  <option value="Y">Ya</option>
                  <option value="N">Tidak</option>
                </select>
                <div class="invalid-feedback"></div>    
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
