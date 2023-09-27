<div class="form-group">
    <label for="receiver">Galang dana tersebut diperutukan kepada ?</label>
    
    <div class="custom-control custom-radio">
      <input type="radio" name="receiver" id="saya" class="custom-control-input" value="Saya Sendiri" {{ isset($campaign) && $campaign->receiver == 'Saya Sendiri' ? 'checked' : '' }}>
      <label for="saya" class="custom-control-label font-weight-normal">Saya Sendiri</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" name="receiver" id="keluarga" class="custom-control-input" value="Keluarga / Kerabat" {{ isset($campaign) && $campaign->receiver == 'Keluarga / Kerabat' ? 'checked' : '' }}>
      <label for="keluarga" class="custom-control-label font-weight-normal">Keluarga / Kerabat</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" name="receiver" id="organisasi" class="custom-control-input" value="Organisasi / Lembaga" {{ isset($campaign) && $campaign->receiver == 'Organisasi / Lembaga' ? 'checked' : '' }}>
      <label for="organisasi" class="custom-control-label font-weight-normal">Organisasi / Lembaga</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" name="receiver" id="lainnya" class="custom-control-input" value="Lainnya" {{ isset($campaign) && $campaign->receiver == 'Lainnya' ? 'checked' : '' }}>
      <label for="lainnya" class="custom-control-label font-weight-normal">Lainnya</label>
    </div>
  </div>
  <div class="alert alert-primary">
    Saya setuju dengan <strong>Syarat & ketentuan</strong> donasi di {{ $setting->company_name }}
  </div>
  <div class="form-group">
    <button type="button" class="btn btn-outline-primary" onclick="stepper.previous()">Sebelumnya</button>
    <button class="btn btn-primary">Selesai</button>
</div>