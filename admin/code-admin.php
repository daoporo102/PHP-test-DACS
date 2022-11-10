<?php
session_start();

include '../config/connectdb.php';
include '../functions/myfunctions.php';

//////////// tài khoản admin
if (isset($_POST['add_user_admin_btn'])) {

    $username = $_POST['username'];
    $pass = $_POST['password'];
    $re_password   = $_POST['re_password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    //check if email already registered
    $check_email_query = "SELECT `email`FROM `admin` WHERE `email` = '$email' ";
    $check_email_query_run = mysqli_query($conn, $check_email_query);
    if (mysqli_num_rows($check_email_query_run) > 0) {
        redirect("add-user-admin.php", "Email đã tồn tại ! Vui lòng nhập email khác !");
    } else {
        //check $pass == $re_pass
        if ($pass == $re_password) {
            if (!(preg_match(' /^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/', $pass))) {
                redirect("add-user-admin.php", "mk cần 6 đến 32 kí tự : 1 chữ thường, 1 chữ hoa , 1 số và 1 kí tự đặc biệt");
            } else {
                $password = md5($pass);
                //Insert user data
                $query = "INSERT INTO `admin`( `username`, `password`,`email`, `phone`,  `address` ,`image`)
                                    VALUES ('$username','$password','$email','$phone','$address','$image')";
                $query_run = mysqli_query($conn, $query);
                if ($query_run) {
                    move_uploaded_file($image_tmp,'../images/'.$image);
                    
                    redirect("user-admin.php", "User Admin Added Successfully");
                } else {
                    redirect("user-admin.php", "Something Went Wrong");
                }
            }
        } else {
            redirect("add-user-admin.php", "Passwords and Re-Password do not match !");
        }
    }
} else if (isset($_POST['edit_user_admin_btn'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $re_password   = $_POST['re_password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if ($_FILES['image']['name'] == '') {
        $image = $row_update['image'];
    } else {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp,'../images/'.$image);     
    }

    //check $pass == $re_pass
    if ($pass == $re_password) {
        if (!(preg_match(' /^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/', $pass))) {
            redirect("add-user-admin.php", "mk cần 6 đến 32 kí tự : 1 chữ thường, 1 chữ hoa , 1 số và 1 kí tự đặc biệt");
        } else {
            $password = md5($pass);
            //Insert user data
            $query = "UPDATE `admin` SET username='$username' , password='$password',email='$email',phone='$phone',address='$address',image='$image' WHERE id='$id'";
            $query_run = mysqli_query($conn, $query);
            if ($query_run) {
                redirect("user-admin.php", "User Admin Update Successfully");
            } else {
                redirect("user-admin.php", "Something Went Wrong");
            }
        }
    } else {
        redirect("edit-user-admin.php", "Passwords and Re-Password do not match !");
    }
} elseif (isset($_POST['delete_user_admin_btn'])) {
    $id = $_POST['id'];

    $query = "SELECT * FROM admin WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($query_run);
    $image = $data['image'];

    $delete_query = "DELETE FROM `admin` WHERE id='$id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../images/" . $image)) {
            unlink("../images/" . $image);
        }
        redirect("user-admin.php", "User Admin Deleted Successfully");
    } else {
        redirect("user-admin.php", "Something Went Wrong !");
    }
}
///////// mau cv
// if (isset($_POST['add_mau_cv_btn'])) {
//     $name = $_POST['name'];

//     $image = $_FILES['image']['name'];

//     $path = "../uploads";

//     $image_ext = pathinfo($image, PATHINFO_EXTENSION);
//     $filename = time() . '.' . $image_ext;

//     $cate_query = "INSERT INTO `mau_cv`(`name`, `image`) 
//                                     VALUES ('$name','$filename')";
//     $cate_query_run = mysqli_query($conn, $cate_query);
//     if ($cate_query_run) {
//         move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
//         redirect("add-mau-cv.php", "Mẫu CV Added Successfully");
//     } else {
//         redirect("add-mau-cv.php", "Something Went Wrong");
//     }
// } else if (isset($_POST['update_mau_cv_btn'])) {
//     $id = $_POST['id'];
//     $name = $_POST['name'];

//     $new_image = $_FILES['image']['name'];
//     $old_image = $_POST['old_image'];

//     if ($new_image != "") {
//         // $update_filename = $new_image;
//         $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
//         $update_filename = time() . '.' . $image_ext;
//     } else {
//         $update_filename = $old_image;
//     }
//     $path = "../uploads";

//     $update_query = "UPDATE mau_cv SET 
//     name='$name',image='$update_filename' WHERE id='$id'";




//     $update_query_run = mysqli_query($conn, $update_query);

//     if ($update_query_run) {
//         if ($_FILES['image']['name'] != "") {
//             move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
//             if (file_exists("../uploads/" . $old_image)) {
//                 unlink("../uploads/" . $old_image);
//             }
//         }
//         redirect("edit-mau-cv.php?id=$id", "Mẫu CV Update Successfully");
//     } else {
//         redirect("edit-mau-cv.php?id=$id", "Something Went Wrong");
//     }
// } elseif (isset($_POST['delete_mau_cv_btn'])) {

//     $id = mysqli_real_escape_string($conn, $_POST['id']);

//     $query = "SELECT * FROM mau_cv WHERE id='$id'";
//     $query_run = mysqli_query($conn, $query);
//     $data = mysqli_fetch_array($query_run);

//     $image = $data['image'];


//     $delete_query = "DELETE FROM mau_cv WHERE id='$id'";
//     $delete_query_run = mysqli_query($conn, $delete_query);

//     if ($delete_query_run) {
//         if (file_exists("../uploads/" . $image)) {
//             unlink("../uploads/" . $image);
//         }
//         redirect("mau-cv.php", "Mẫu cv Deleted Successfully");
//     } else {
//         redirect("mau-cv.php", "Something Went Wrong !");
//     }
// }
///////////////// tài khoản users -tk thường

// if (isset($_POST['add_user_admin_btn'])) {
//     $username = $_POST['username'];
//     $pass = $_POST['password'];
//     $re_password   = $_POST['re_password'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $address = $_POST['address'];

//     //check if email already registered
//     $check_email_query = "SELECT `email`FROM `admin` WHERE `email` = '$email' ";
//     $check_email_query_run = mysqli_query($conn, $check_email_query);
//     if (mysqli_num_rows($check_email_query_run) > 0) {
//         redirect("add-user-admin.php", "Email đã tồn tại ! Vui lòng nhập email khác !");
//     } else {
//         //check $pass == $re_pass
//         if ($pass == $re_password) {
//             if (! (preg_match(' /^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/',$pass)) ) {
//                 redirect("add-user-admin.php", "mk cần 6 đến 32 kí tự : 1 chữ thường, 1 chữ hoa , 1 số và 1 kí tự đặc biệt");
//             } else {
//                 $password = md5($pass);
//                 //Insert user data
//                 $query = "INSERT INTO `admin`( `username`, `password`,`email`, `phone`,  `address` )
//                                     VALUES ('$username','$password','$email','$phone','$address')";
//                 $query_run = mysqli_query($conn, $query);
//                 if ($query_run) {
//                     redirect("user-admin.php", "User Admin Added Successfully");
//                 } else {
//                     redirect("user-admin.php", "Something Went Wrong");
//                 }
//             }
//         } else {
//             redirect("add-user-admin.php", "Passwords and Re-Password do not match !");
//         }
//     }
// } 

///////sửa xóa người dùng
// else if (isset($_POST['edit_user_admin_btn'])) {
//     $id = $_POST['id'];
//     $username = $_POST['username'];
//     $pass = $_POST['password'];
//     $re_password   = $_POST['re_password'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $address = $_POST['address'];
//         //check $pass == $re_pass
//         if ($pass == $re_password) {
//             if (! (preg_match(' /^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/',$pass)) ) {
//                 redirect("add-user-admin.php", "mk cần 6 đến 32 kí tự : 1 chữ thường, 1 chữ hoa , 1 số và 1 kí tự đặc biệt");
//             } else {
//                 $password = md5($pass);
//                 //Insert user data
//                 $query = "UPDATE `admin` SET username='$username' , password='$password',email='$email',phone='$phone',address='$address' WHERE id='$id'";
//                 $query_run = mysqli_query($conn, $query);
//                 if ($query_run) {
//                     redirect("user-admin.php", "User Admin Update Successfully");
//                 } else {
//                     redirect("user-admin.php", "Something Went Wrong");
//                 }
//             }
//         } else {
//             redirect("edit-user-admin.php", "Passwords and Re-Password do not match !");
//         }
// } elseif (isset($_POST['delete_users_btn'])) {
//     $id = $_POST['id'];
//     $delete_query = "DELETE FROM `admin` WHERE id='$id'";
//     $delete_query_run = mysqli_query($conn, $delete_query);

//     if ($delete_query_run) {
//         redirect("user-admin.php", "User Admin Deleted Successfully");
//     } else {
//         redirect("user-admin.php", "Something Went Wrong !");
//     }
// }