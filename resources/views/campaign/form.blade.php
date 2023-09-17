{{-- jika variable gunakan :size, jk string biasa tidak perlu --}}
<x-modal size="modal-xl" data-backdrop="static" data-keyboard="false"> 
    <x-slot name="title">
      Tambah
    </x-slot>

    @method('post')
  
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="title">Judul</label>
          <input type="text" name="title" class="form-control">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="categories">Kategori</label>
          <select name="categories[]" id="categories" class="select2" multiple>         
            @foreach ($category as $key => $item)
                <option value="{{ $key }}">{{ $item }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  
    <div class="form-group">
      <label for="short_description">Deskripsi Singkat</label>
      <textarea name="short_description" id="short_description" rows="3" class="form-control"></textarea>
    </div>
    
    <div class="form-group">
      <label for="body">Konten</label>
      <textarea name="body" id="body" rows="3" class="form-control summernote"></textarea>
    </div>
  
    <div class="row">
      <div class="col-lg-6">
        <!-- Date and time -->
        <div class="form-group">
          <label>Tanggal publish:</label>
          <div class="input-group datetimepicker" id="datetimepicker1" data-target-input="nearest">
              <input type="text" name="publish_date" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
              <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="status">Status</label>
          <select name="status" id="status" class="custom-select">
              <option disabled selected>Pilih salah satu</option>
              <option value="Publish">Publish</option>
              <option value="Archived">Archived</option>
          </select>
        </div>
      </div>
      
    </div>
  
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="goal">Goal</label>
          <input type="number" name="goal" id="goal" class="form-control">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">        
            <label for="end_date">Tanggal Selesai:</label>
            <div class="input-group datetimepicker" id="end_date" data-target-input="nearest">
                <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#end_date"/>
                <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>    
        </div>
      </div>
    </div>
  
    <div class="form-group">
      <label for="note">Tulis ajakan</label>
      <textarea name="note" id="note" cols="30" rows="10" class="form-control"></textarea>
    </div>
  
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="receiver">Penerima</label>
          
          <div class="custom-control custom-radio">
            <input type="radio" name="receiver" id="saya" class="custom-control-input" value="Saya Sendiri">
            <label for="saya" class="custom-control-label font-weight-normal">Saya Sendiri</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="receiver" id="keluarga" class="custom-control-input" value="Keluarga / Kerabat">
            <label for="keluarga" class="custom-control-label font-weight-normal">Keluarga / Kerabat</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="receiver" id="organisasi" class="custom-control-input" value="Organisasi / Lembaga">
            <label for="organisasi" class="custom-control-label font-weight-normal">Organisasi / Lembaga</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" name="receiver" id="lainnya" class="custom-control-input" value="Lainnya">
            <label for="lainnya" class="custom-control-label font-weight-normal">Lainnya</label>
          </div>
        </div>
      </div>
    
      <div class="col-lg-6">
        <div class="form-group">
          <label for="path_image">Gambar</label>
          <div class="custom-file">
            <input type="file" name="path_image" class="custom-file-input" id="path_image" onchange="preview('.preview-path_image', this.files[0])">
            <label class="custom-file-label" for="path_image">Choose file</label>
          </div>
        </div>
        <img src="" class="img-thumbnail preview-path_image" style="display: none;">
      </div>
    </div>    
  
    <x-slot name="footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">Save</button>
    </x-slot>
  </x-modal>