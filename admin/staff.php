<?php

@include 'config.php';

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `users` WHERE id = $delete_id ") or die('query failed: '. mysqli_error($conn));
    if($delete_query){
       header('location:staff.php');
       $message[] = 'report has been deleted';
    }else{
       header('location:staff.php');
       $message[] = 'report could not be deleted';
    };
 };
 
 if(isset($_POST['update_product'])){
    $update_u_id = $_POST['update_u_id'];
    $update_u_catatan = $_POST['update_u_catatan'];
    $update_u_department = $_POST['update_u_department'];
    $update_u_name_PIC = $_POST['update_u_name_PIC'];
    $update_u_status = $_POST['update_status'];
    
    $update_query = mysqli_query($conn, "UPDATE `users` SET catatan = '$update_u_catatan', department = '$update_u_department', nama_PIC = '$update_u_name_PIC', status = '$update_u_status' WHERE id = '$update_u_id'");
 
    if($update_query){
       move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
       $message[] = 'report updated succesfully';
       header('location:staff.php');
    }else{
       $message[] = 'report could not be updated';
       header('location:staff.php');
    }
 
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Staff panel || JPS Perlis</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/style.css">

</head>
<body>
<section class="display-product-table">

<table>

    <thead>
        <th>Date</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Parlimen</th>
        <th>Dun</th>
        <th>Keterangan</th>
        <th>Gambar</th>
        <th>Catatan</th>
        <th>Department</th>
        <th>Nama PIC</th>
        <th>Status</th>
        <th>Priority</th>
        <th>Action</th>
    </thead>


   <tbody>
      <?php
      
         $select_products = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed: ' . mysqli_error($conn));
         if(mysqli_num_rows($select_products) > 0){
            while($row = mysqli_fetch_assoc($select_products)){
      ?>

        <tr>
            <td><?php echo $row['tarikh']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['parlimen']; ?></td>
            <td><?php echo $row['dun']; ?></td>
            <td><?php echo $row['keterangan']; ?></td>
            <td><img src="uploaded_img/<?php echo $row['gambar']; ?>" height="100" alt=""></td>
            <td><?php echo $row['catatan']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td><?php echo $row['nama_PIC']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="staff.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this?');"> <i class="fas fa-trash"></i> Delete </a>
                <a href="staff.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> Update </a>
            </td>
        </tr>

      <?php
         };    
         }else{
            echo "<div class='empty'>No product added</div>";
         };
      ?>
   </tbody>
</table>

</section>

<section class="edit-form-container">

<?php

if(isset($_GET['edit'])){
   $edit_id = $_GET['edit'];
   $edit_query = mysqli_query($conn, "SELECT * FROM `users` WHERE id = $edit_id") or die('query failed: ' . mysqli_error($conn));
   if(mysqli_num_rows($edit_query) > 0){
      while($fetch_edit = mysqli_fetch_assoc($edit_query)){
?>

<form action="" method="post" enctype="multipart/form-data">
    <img src="./uploaded_img/<?php echo $fetch_edit['gambar']; ?>" height="200" alt="">
    <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
    <input type="text" class="box" required name="update_u_catatan" value="<?php echo $fetch_edit['catatan']; ?>">
    <input type="text" class="box" required name="update_u_department" value="<?php echo $fetch_edit['department']; ?>">
    <input type="text" class="box" required name="update_u_name_PIC" value="<?php echo $fetch_edit['nama_PIC']; ?>">
    <input type="text" class="box" required name="update_u_status" value="<?php echo $fetch_edit['status']; ?>">
    <input type="submit" value="Update the report" name="update_product" class="btn">
    <input type="reset" value="Cancel" id="close-edit" class="option-btn">
</form>

<?php
         };
      };
      echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
   };
?>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>