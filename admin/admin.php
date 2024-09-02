<?php

@include 'config.php';

if(isset($_POST['add_product'])){
    $u_date = $_POST['u_date'];
    $u_name = $_POST['u_name'];
    $u_phone = $_POST['u_phone'];
    $u_lokasi = $_POST['u_lokasi'];
    $u_parlimen = $_POST['u_parlimen'];
    $u_dun = $_POST['u_dun'];
    $u_keterangan = $_POST['u_keterangan'];

    // Define the image variables correctly
    $u_image = $_FILES['u_image']['name'];
    $u_image_tmp_name = $_FILES['u_image']['tmp_name'];
    $u_image_folder = 'uploaded_img/'.$u_image;

    $insert_query = mysqli_query($conn, "INSERT INTO 'users' (tarikh, nama, phone, lokasi, parlimen, dun, keterangan, gambar) VALUES ('$u_date','$u_name','$u_phone','$u_lokasi','$u_parlimen','$u_dun,'$u_keterangan','$u_image)") or die('query failed');

    if($insert_query){
      // Move the uploaded image to the desired folder
        move_uploaded_file($u_image_tmp_name, $u_image_folder);
        $message[] = 'report send succesfully';
    }else{
        $message[] = 'could not sent the report';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Aduan Form || JPS Perlis</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/style.css">

   <style>
      body {
         background-image: url('https://i.pinimg.com/564x/c6/d0/25/c6d025e4851471a55ed1f645c087048e.jpg');
         background-repeat: no-repeat;
         background-attachment: fixed;
         background-size: cover;
      }
   </style>
</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<div class="container">

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>Aduan | JPS Perlis</h3>
   <input type="text" name="u_date" placeholder="Masukkan tarikh (example: 28.8.2024)" class="box" required>
   <input type="text" name="u_name" placeholder="Masukkan nama" class="box" required>
   <input type="text" name="u_phone" placeholder="Masukkan no. tel" class="box" required>
   <input type="text" name="u_lokasi" placeholder="Masukkan lokasi" class="box" required>
    
   <!-- Dropdown selection -->
    <select name="u_parlimen" class="box" required>
      <option value="" disabled selected>Pilih Parlimen</option>
            <option value="tititinggi">Titi Tinggi</option>
            <option value="beseri">Beseri</option>
            <option value="chuping">Chuping</option>
            <option value="mataayer">Mata Ayer</option>
            <option value="santan">Santan</option>
            <option value="bintong">Bintong</option>
            <option value="sena">Sena</option>
            <option value="inderakayangan">Indera Kayangan</option>
            <option value="kualaperlis">Kuala Perlis</option>
            <option value="kayang">Kayang</option>
            <option value="pauh">Pauh</option>
            <option value="tambuntulang">Tambun Tulang</option>
            <option value="guarsanji">Guar Sanji</option>
            <option value="simpangempat">Simpang Empat</option>
            <option value="sanglang">Sanglang</option>
   </select>

   <select name="u_dun" class="box" required>
      <option value="" disabled selected>Pilih Dun</option>
            <option value="kangar">Kangar</option>
            <option value="padangbesar">Padang Besar</option>
            <option value="arau">Arau</option>
   </select>

   <textarea name="u_keterangan" placeholder="Keterangan" class="box" required></textarea>

   <input type="file" name="u_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="Submit" name="add_product" class="btn">
   <input type="reset" value="Clear" class="btn">
</form>

</section>
</div>
</body>
</html>