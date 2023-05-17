@extends('layout.structure')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>Cropper</h1>
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
                <h4>Cropper Table</h4>
                <div class="card-header-form">
                  <div class="input-group-btn">
                    <button class="btn btn-primary btnAdd">
                      Add Cropper
                    </button>
                  </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-cropper" style="width: 100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    <thead>
        
                  </table>
                </div>
            </div>
          </div>
        </div>
    </div>
  </div>

  <div class="modal fade" data-backdrop="false"  tabindex="-1" role="dialog" id="tambah-cropper">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="#" id="form-tambah-cropper">
          <div class="modal-header">
            <h5 class="modal-title">Form Add Cropper</h5>
            <button type="button btn-danger" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group col-12">
              <label for="name">name</label>
              <input id="name" type="text" class="form-control" placeholder="Enter Name"  name="name"  required>
              <div class="invalid-feedback">

              </div> 
            </div>
            <div class="form-group col-12">
                <label for="Description">Description</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Enter Description" required></textarea>
                <div class="invalid-feedback">
                </div> 
            </div>
            <div class="form-group col-12">
              <label for="image">Image</label>
              <input id="image_cropper" type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" placeholder="Enter Image"  name="image" >
              <div class="invalid-feedback">

              </div> 
            </div>
            <input type="hidden" id="base_64_cropper" name="base_64_cropper">
            <div class="form-group" style="margin-bottom:10px;">
               <img src="" id="img" width="100%">
           </div>            
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="Submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
       </form>
      </div>
    </div>
  </div>

  <div class="modal fade" data-backdrop="false"  tabindex="-1" role="dialog" id="update-cropper">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="#" id="form-update-cropper">
          <div class="modal-header">
            <h5 class="modal-title">Form Update Cropper</h5>
            <button type="button btn-danger" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="id">
            <div class="form-group col-12">
              <label for="name_up">name</label>
              <input id="name_up" type="text" class="form-control" placeholder="Enter Name"  name="name"  required>
              <div class="invalid-feedback">

              </div> 
            </div>
            <div class="form-group col-12">
              <label for="description_up">Description</label>
              <textarea class="form-control" name="description" id="description_up" cols="30" rows="10" placeholder="Enter Description" required></textarea>
              <div class="invalid-feedback">

              </div> 
           </div>
           <div class="form-group col-12">
            <label for="image_up">Image</label>
            <input id="image_up" type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" placeholder="Enter Iamge"  name="image"  required>
            <div class="invalid-feedback">

            </div> 
          </div>

          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="Submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
       </form>
      </div>
    </div>
  </div>

  {{-- Form Modal Cropper --}}
  <div class="modal fade" data-backdrop="false" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="z-index: 9999">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sesuaikan Cover Sebelum Mengunggah</h5>
                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close" style="padding:0px;">
                    <span aria-hidden="true" style="font-size: 38px;position: absolute;right: 20px;top: 0px;">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10" style="max-height: 400px;">
                            <img src="" id="sample_image" style="max-height: 400px;" />
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Batal</button>
                <button type="button" id="crop" class="btn btn-primary">Pilih</button>
            </div>
        </div>
    </div>
</div>

</section>

@stop
