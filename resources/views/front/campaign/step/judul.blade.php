<div class="form-group">
    <label for="categories">Kategori apa yang tepat untuk penggalangan dana ini ?</label>
    <select name="categories[]" id="categories" class="select2" multiple required>
        @foreach ($category as $key => $item)
            <option value="{{ $key }}">{{ $item }}</option>
        @endforeach            
    </select>
</div>
<div class="form-group">
    <label for="title">Apa judul untuk penggalangan dana ini ?</label>
    <input type="text" name="title" class="form-control" placeholder="Contoh: bantu Kafi melawan kanker">
  </div>
<div class="form-group">
    <button type="button" class="btn btn-primary" onclick="stepper.next()">Selanjutnya</button>
</div>