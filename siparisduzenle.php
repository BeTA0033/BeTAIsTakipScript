<?php 
include 'header.php' ;
if (yetkikontrol()!="yetkili") {
	header("location:index.php?durum=izinsiz");
	exit;
}
if (isset($_POST['sip_id'])) {
	$kayitsor=$db->prepare("SELECT * FROM siparis where sip_id=:id");
	$kayitsor->execute(array(
		'id' => guvenlik($_POST['sip_id'])
	));
	$kayitcek=$kayitsor->fetch(PDO::FETCH_ASSOC);
} else {
	header("location:siparisler");
} 

?>
<!--<script src="ckeditor/ckeditor.js"></script>-->
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary">Sipariş Düzenleme   
						<small>
							<?php 
							if (isset($_GET['islem'])) { 
								if (guvenlik($_GET['islem'])=="ok") {?> 
									<b style="color: green; font-size: 16px;">İşlem Başarılı</b>
								<?php } elseif (guvenlik($_GET['islem'])=="no") { ?> 
									<b style="color: red; font-size: 16px;">İşlem Başarısız</b>
								<?php } } ?>

							</small>
						</h5>
					</div>
					<div class="card-body">
						<form action="islemler/islem.php" method="POST"  enctype="multipart/form-data"  data-parsley-validate>
                        <div class="form-row">
      <div class="form-group col-md-6">
        <label>İsim Soyisim</label>
        <input type="text" class="form-control" required name="musteri_isim" value="<?php echo $kayitcek['musteri_isim'] ?>">
      </div>
      <div class="form-group col-md-6">
      <label>Sipariş Numarası</label>
        <input type="text" class="form-control" required name="sip_baslik" value="<?php echo $kayitcek['sip_baslik'] ?>">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Telefon Numarası</label>
        <input type="number" class="form-control" required name="musteri_telefon" value="<?php echo $kayitcek['musteri_telefon'] ?>">
      </div>
      <?php $aciliyet=$kayitcek['sip_aciliyet']; ?>
      <div class="form-group col-md-6">
      <label>Aciliyet</label>
      <select id="inputState" name="sip_aciliyet" class="form-control">
			<option <?php if($aciliyet == 'Acil'){echo("selected");}?> value="Acil">Acil</option>
			<option <?php if($aciliyet == 'Normal'){echo("selected");}?> value="Normal">Normal</option>
			<option <?php if($aciliyet == 'Acelesi Yok'){echo("selected");}?> value="Acelesi Yok">Acelesi Yok</option>
		</select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
      <label>Sipariş Teslim Tarihi</label>
        <input type="date" class="form-control" required name="sip_teslim_tarihi" value="<?php echo $kayitcek['sip_teslim_tarihi'] ?>">
      </div>
      <?php $durum=$kayitcek['sip_durum']; ?>
      <div class="form-group col-md-6">
      <label>Sipariş Durumu</label>
      <select id="inputState" name="sip_durum" class="form-control">
			<option <?php if($durum == 'Yeni Başladı'){echo("selected");}?> value="Yeni Başladı">Yeni Başladı</option>
			<option <?php if($durum == 'Devam Ediyor'){echo("selected");}?> value="Devam Ediyor">Devam Ediyor</option>
			<option <?php if($durum == 'Teslimine Son 1 Hafta Kaldı'){echo("selected");}?> value="Teslimine Son 1 Hafta Kaldı">Teslimine Son 1 Hafta Kaldı</option>
			<option <?php if($durum == 'Bitti'){echo("selected");}?> value="Bitti">Bitti</option>
	</select>
      </div>
    </div>
    <br>
    <hr>
    <br>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label>Halı Büyüklüğü (m²)</label>
        <input id="sip_hali_buyukluk" type="number" class="form-control"  name="sip_hali_buyukluk" value="<?php echo $kayitcek['sip_hali_buyukluk'] ?>">
      </div>
      <div class="form-group col-md-3">
      <label>Ücret (₺)</label>
      <input id="sip_hali_ucret" type="number" class="form-control"  name="sip_hali_ucret" value="<?php echo $kayitcek['sip_hali_ucret'] ?>">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
      <label>Kilim Büyüklüğü (m²)</label>
        <input id="sip_kilim_buyukluk" type="number" class="form-control"  name="sip_kilim_buyukluk" value="<?php echo $kayitcek['sip_kilim_buyukluk'] ?>">
      </div>
      <div class="form-group col-md-3">
      <label>Ücret (₺)</label>
      <input id="sip_kilim_ucret" type="number" class="form-control"  name="sip_kilim_ucret" value="<?php echo $kayitcek['sip_kilim_ucret'] ?>">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
      <label>Yorgan (Birim/Tane)</label>
        <input id="sip_yorgan_tane" type="number" class="form-control"  name="sip_yorgan_tane" value="<?php echo $kayitcek['sip_yorgan_tane'] ?>">
      </div>
      <div class="form-group col-md-3">
      <label>Ücret (₺)</label>
      <input id="sip_yorgan_ucret" type="number" class="form-control"  name="sip_yorgan_ucret" value="<?php echo $kayitcek['sip_yorgan_ucret'] ?>">
      </div>
    </div> 
    <div class="form-row">
      <div class="form-group col-md-3">
      <label>Battaniye (Birim/Tane)</label>
        <input id="sip_battaniye_tane" type="number" class="form-control"  name="sip_battaniye_tane" value="<?php echo $kayitcek['sip_battaniye_tane'] ?>">
      </div>
      <div class="form-group col-md-3">
      <label>Ücret (₺)</label>
      <input id="sip_battaniye_ucret" type="number" class="form-control"  name="sip_battaniye_ucret" value="<?php echo $kayitcek['sip_battaniye_ucret'] ?>">
      </div>
    </div>  
    <div class="form-row">
      <div class="form-group col-md-3">
      <label>Store Perde (Birim/Tane)</label>
        <input id="sip_store_tane" type="number" class="form-control"  name="sip_store_tane" value="<?php echo $kayitcek['sip_store_tane'] ?>">
      </div>
      <div class="form-group col-md-3">
      <label>Ücret (₺)</label>
      <input id="sip_store_ucret" type="number" class="form-control"  name="sip_store_ucret" value="<?php echo $kayitcek['sip_store_ucret'] ?>">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
      <label>Koltuk (Birim/Tane)</label>
        <input id="sip_koltuk_tane" type="number" class="form-control"  name="sip_koltuk_tane" value="<?php echo $kayitcek['sip_koltuk_tane'] ?>">
      </div>
      <div class="form-group col-md-3">
      <label>Ücret (₺)</label>
      <input id="sip_koltuk_ucret" type="number" class="form-control"  name="sip_koltuk_ucret" value="<?php echo $kayitcek['sip_koltuk_ucret'] ?>">
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
        <input id="sip_toplam_ucret" type="number" class="form-control" name="sip_toplam_ucret" value="<?php echo $kayitcek['sip_toplam_ucret'] ?>">
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
        <textarea class="ckeditor" id="musteri_adres" name="musteri_adres" ><?php echo $kayitcek['musteri_adres']?></textarea>
</div>
</div>
<br>
    <div class="form-row">
      <div class="form-group col-md-12">
      <label>Not</label>
        <br>
        <textarea class="ckeditor" name="sip_detay" id="editor"><?php echo $kayitcek['sip_detay']?></textarea></textarea>
      </div>
    </div>
    <br>
    <div class="form-row">
								<div class="col-md-6">
									<div class="file-loading">
										<input type="file" class="form-control" id="sipdosya" name="sip_dosya" >
									</div>
									<div class="custom-control custom-checkbox small mt-2">
										<input type="checkbox" class="custom-control-input" value="sil" id="dosya_sil" name="dosya_sil">
										<label class="custom-control-label" for="dosya_sil">Dosyaları Sil</label>
									</div>
								</div>
							</div>
							<br><br>			
							<input type="hidden" class="form-control" name="sip_id" value="<?php echo $kayitcek['sip_id'] ?>">
							<button type="submit" name="siparisguncelle" class="btn btn-success">Kaydet</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include 'footer.php' ?>
	<script src="ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'editor' );
	</script>
	<?php 
	if (strlen($kayitcek['dosya_yolu'])>10) {?>
		<script>
			$(document).ready(function () {
				var url1='<?php echo $kayitcek['dosya_yolu'] ?>';
				$("#sipdosya").fileinput({
					'theme': 'explorer-fas',
					'showUpload': false,
					'showCaption': true,
					'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
			initialPreview: [
			'<img src="<?php echo $kayitcek['dosya_yolu'] ?>" style="height:90px" class="file-preview-image" alt="Dosya" title="Dosya">'
			],
			initialPreviewConfig: [
			{downloadUrl: url1,
				showRemove: false,
			},
			],
		});

			});
		</script>
	<?php } else { ?>
		<script>
			$(document).ready(function () {
				var url1='<?php echo $kayitcek['dosya_yolu'] ?>';
				$("#sipdosya").fileinput({
					'theme': 'explorer-fas',
					'showUpload': false,
					'showCaption': true,
					'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
		});

			});
		</script>
	<?php } ?>
