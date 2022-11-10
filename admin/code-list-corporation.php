<?php
session_start();


include '../config/connectdb.php';
include '../functions/myfunctions.php';

//////// list corporation
if (isset($_POST['add_corporation_btn'])) {
    $id_corp    = $_POST['id_corp'];
    $corp_name = $_POST['corp_name'];

    $corp_field = $_POST['corp_field'];
    $corp_mail = $_POST['corp_mail'];
    $website = $_POST['website'];
    $address = $_POST['address'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    $query = "INSERT INTO `corporation`
            (`id_corp`, `corp_name`, `corp_field`, `corp_mail`, `image`, `description`, `website`, `address`) 
    VALUES ('$id_corp','$corp_name','$corp_field','$corp_mail','$image','$description','$website','$address')";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        move_uploaded_file($image_tmp, '../images/' . $image);
        redirect("list-corporation.php", "Corporation Added Successfully");
    } else {
        redirect("add-corporation.php", "Something Went Wrong");
    }
} else if (isset($_POST['edit_user_corporation_btn'])) {
    $id_corp  = $_POST['id_corp'];
    $corp_name = $_POST['corp_name'];
    $corp_field = $_POST['corp_field'];
    $description = $_POST['description'];
    $corp_mail = $_POST['corp_mail'];
    $website = $_POST['website'];
    $address = $_POST['address'];

    if ($_FILES['image']['name'] == '') {
        $image = $row_update['image'];
    } else {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, '../images/' . $image);
    }

    $query = "UPDATE `corporation` SET 
            `corp_name`='$corp_name',`corp_field`='$corp_field',`corp_mail`='$corp_mail',`image`='$image',`description`='$description',`website`='$website',`address`='$address' 
            WHERE `id_corp`='$id_corp'
            ";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        redirect("list-corporation.php", "Corporation Update Successfully");
    } else {
        redirect("list-corporation.php", "Something Went Wrong");
    }
} elseif (isset($_POST['delete_corporation_btn'])) {

    $id_corp = mysqli_real_escape_string($conn, $_POST['id_corp']);

    $query = "SELECT * FROM corporation WHERE id_corp='$id_corp'";
    $query_run = mysqli_query($conn, $query);
    $ata = mysqli_fetch_array($query_run);
    $image = $data['image'];

    $delete_query = "DELETE FROM corporation WHERE id_corp='$id_corp '";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../images/" . $image)) {
            unlink("../images/" . $image);
        }
        redirect("list-corporation.php", "Category Deleted Successfully");
    } else {
        redirect("list-corporation.php", "Something Went Wrong !");
    }
}

      