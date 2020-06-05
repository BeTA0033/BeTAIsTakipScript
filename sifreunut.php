<?php include 'islemler/baglan.php' ;
$ayarsor=$db->prepare("SELECT * FROM ayarlar");
$ayarsor->execute();
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $ayarcek['site_aciklama'] ?>">
  <meta name="author" content="<?php echo $ayarcek['site_sahibi'] ?>">
  <link rel="shortcut icon" type="image/png" href="<?php echo $ayarcek['site_logo'] ?>">

  <title><?php echo $ayarcek['site_baslik'] ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
  <div class="container align-items-center" style="margin-top: 7%">
    <div class="row justify-content-center align-content-center">
      <div class="card o-hidden border-0 shadow-md" style="min-width: 45%">
       <div class="p-5">
        <div class="text-center">
          <h2 class="h2 text-gray-900 mb-4">Doğrulama Sayfası</h2>
        </div>
        <p class="mb-6">E-posta adresinize gelen doğrulama kodunu giriniz.</p>
        <form class="user" action="islemler/islem.php" method="POST">
          <div class="form-group">
          <input name="dogrulamakodu" required type="text" class="form-control form-control-user" id="dogrulamakodu" aria-describedby="emailHelp" placeholder=" Doğrulama Kodu ">
          </div>
          <button name="dogrula" type="submit" class="btn text-white btn-primary btn-user btn-block">Doğrula</button>
          <hr>         
          <p class="text-muted text-center"><?php echo $ayarcek['site_baslik'] ?></p>
        </form>
      </div>
    </div>
  </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<?php
/*

$str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPUQRSTUVWXYZ';
$str_r = substr(str_shuffle($str), 0, 10);

include "class.phpmailer.php";
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->Username = 'berkedemel@gmail.com';
$mail->Password = 'beta68554257';
$mail->SetFrom($mail->Username, 'BeTA Technology');
$mail->AddAddress($kul_mail);
$mail->CharSet = 'UTF-8';
$mail->Subject = 'Doğrulama Kodu';
$mail->MsgHTML($str_r);
if($mail->Send()) {
    echo 'Mail gönderildi!';
} else {
    echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
}
*/

?>