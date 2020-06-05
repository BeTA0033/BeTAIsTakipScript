<?php 
include 'header.php';
if (yetkikontrol()!="yetkili") {
  header("location:index.php?durum=izinsiz");
  exit;
}
?>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<!-- Begin Page Content -->
<div class="container">
  <form id="ekle" action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>İsim Soyisim</label>
        <input  class="form-control" required name="musteri_isim" placeholder="Müşteri İsim Soyisim" value="">
      </div>
      <div class="form-group col-md-6">
      <label>Sipariş Numarası</label>
        <input type="text" class="form-control" required name="sip_baslik" placeholder="İş-Sipariş Numarası" value="">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Telefon Numarası</label>
        <input type="number" class="form-control" required name="musteri_telefon" placeholder="Müşteri Telefon Numarası" value="">
      </div>
      <div class="form-group col-md-6">
      <label>Aciliyet</label>
        <select required name="sip_aciliyet" class="form-control">
          <option>Acil</option>
          <option>Normal</option>
          <option>Acelesi Yok</option>
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
      <label>Sipariş Teslim Tarihi</label>
        <input type="date" class="form-control" required name="sip_teslim_tarihi" placeholder="Teslim Tarihi" >
      </div>
      <div class="form-group col-md-6">
      <label>Sipariş Durumu</label>
        <select required name="sip_durum" class="form-control">
          <option>Yeni Başladı</option>
          <option>Devam Ediyor</option>
          <option>Bitti</option>
        </select>
      </div>
    </div>
    <br>
    <hr>
    <br>
    <div class="form-row">
      <div class="form-group col-md-3">
      <label>Halı Büyüklüğü</label>
        <input id="sip_hali_buyukluk" type="number" class="form-control"  name="sip_hali_buyukluk" placeholder="m²">
      </div>
      <div class="form-group col-md-3">
      <label>Ücret</label>
      <input id="sip_hali_ucret" type="number" class="form-control"  name="sip_hali_ucret" placeholder="₺">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
      <label>Kilim Büyüklüğü</label>
        <input id="sip_kilim_buyukluk" type="number" class="form-control"  name="sip_kilim_buyukluk" placeholder="m²">
      </div>
      <div class="form-group col-md-3">
      <label>Ücret </label>
      <input id="sip_kilim_ucret" type="number" class="form-control"  name="sip_kilim_ucret" placeholder="₺">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
      <label>Yorgan </label>
        <input id="sip_yorgan_tane" type="number" class="form-control"  name="sip_yorgan_tane" placeholder="Birim/Tane">
      </div>
      <div class="form-group col-md-3">
      <label>Ücret </label>
      <input id="sip_yorgan_ucret" type="number" class="form-control"  name="sip_yorgan_ucret" placeholder="₺">
      </div>
    </div> 
    <div class="form-row">
      <div class="form-group col-md-3">
      <label>Battaniye</label>
        <input id="sip_battaniye_tane" type="number" class="form-control"  name="sip_battaniye_tane" placeholder="Birim/Tane">
      </div>
      <div class="form-group col-md-3">
      <label>Ücret </label>
      <input id="sip_battaniye_ucret" type="number" class="form-control"  name="sip_battaniye_ucret" placeholder="₺">
      </div>
    </div>  
    <div class="form-row">
      <div class="form-group col-md-3">
      <label>Store Perde</label>
        <input id="sip_store_tane" type="number" class="form-control"  name="sip_store_tane" placeholder="Birim/Tane">
      </div>
      <div class="form-group col-md-3">
      <label>Ücret</label>
      <input id="sip_store_ucret" type="number" class="form-control"  name="sip_store_ucret" placeholder="₺">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
      <label>Koltuk </label>
        <input id="sip_koltuk_tane" type="number" class="form-control"  name="sip_koltuk_tane" placeholder="Birim/Tane">
      </div>
      <div class="form-group col-md-3">
      <label>Ücret</label>
      <input id="sip_koltuk_ucret" type="number" class="form-control"  name="sip_koltuk_ucret" placeholder="₺">
      </div>
    </div>
    <br><br>
    <small> Not: Ücretler Birim/Tane veya m²</small> <b>başına</b> <small>fiyatları içermektedir. </small>
    <br><br>
    <button id="ucrethesapla" type="button" name="ucrethesapla" class="btn btn-warning">Toplam Ücreti Hesapla</button>
    <br><br>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label>Toplam Ücret (₺)</label>
        <input id="sip_toplam_ucret" type="text" class="form-control" required name="sip_toplam_ucret" value="">
    </div>
    </div>
    <script>
    $(document).ready(function() {
        $("#ucrethesapla").on("click",function(){
          var sip_hali_buyukluk = Number($("#sip_hali_buyukluk").val());
          var sip_hali_ucret = Number($("#sip_hali_ucret").val());
          var sip_kilim_buyukluk = Number($("#sip_kilim_buyukluk").val());
          var sip_kilim_ucret = Number($("#sip_kilim_ucret").val());
          var sip_yorgan_tane = Number($("#sip_yorgan_tane").val());
          var sip_yorgan_ucret = Number($("#sip_yorgan_ucret").val());
          var sip_battaniye_tane = Number($("#sip_battaniye_tane").val());
          var sip_battaniye_ucret = Number($("#sip_battaniye_ucret").val());
          var sip_store_tane = Number($("#sip_store_tane").val());
          var sip_store_ucret = Number($("#sip_store_ucret").val());
          var sip_koltuk_tane = Number($("#sip_koltuk_tane").val());
          var sip_koltuk_ucret = Number($("#sip_koltuk_ucret").val());
          var toplam=(sip_hali_buyukluk*sip_hali_ucret)+(sip_kilim_buyukluk*sip_kilim_ucret)+(sip_yorgan_tane*sip_yorgan_ucret)+(sip_battaniye_tane*sip_battaniye_ucret)+(sip_store_tane*sip_store_ucret)+(sip_koltuk_tane*sip_koltuk_ucret);
          $("#sip_toplam_ucret").val(toplam);
        });
      });
    </script>
    <br>
    <hr>
    <br>
    <div class="form-row">
      <div class="form-group col-md-12">
        <label>Adres</label>
        <br>
        <textarea class="ckeditor" id="musteri_adres" name="musteri_adres" ></textarea>
</div>
</div>
<br>
    <div class="form-row">
      <div class="form-group col-md-12">
      <label>Not</label>
        <br>
        <textarea class="ckeditor" name="sip_detay" id="editor"></textarea>
      </div>
    </div>
    <br>
    <div class="form-row d-flex justify-content-center mb-3">
      <div class="col-md-6">
        <div class="file-loading">
          <input class="form-control" id="sip_dosya" name="sip_dosya" type="file">
        </div>
      </div>
    </div>
    <button id="siparisekle" type="submit" name="siparisekle" class="btn btn-primary">Kaydet</button>
  </form>
</div>
<!-- End of Main Content -->
<?php include 'footer.php' ?>
<script src="ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'editor' );
</script>
<!--İşlem sonucu açılan bildirim pop up unu otomatik kapatma giriş-->
<script type="text/javascript">
  $('#islemsonucu').modal('show');
  setTimeout(function() {
    $('#islemsonucu').modal('hide');
  }, 3000);
</script>
<!--İşlem sonucu açılan bildirim pop up unu otomatik kapatma çıkış-->
<script>
  $(document).ready(function () {
    $("#sip_dosya").fileinput({
      'theme': 'explorer-fas',
      'showUpload': false,
      'showCaption': true,
      showDownload: true,
      allowedFileExtensions: ["jpg", "png", "jpeg","mp4","zip","rar"],
    });
  });
</script>