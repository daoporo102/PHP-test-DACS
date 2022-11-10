<?php
include 'includes/header.php';
require_once '../functions/authcode.php';
include '../config/connectdb.php';
?>

<div class="container">
    <div class="row">

        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $query = "SELECT * FROM `admin` WHERE id='$id'";
                $list = mysqli_query($conn,$query);
                // $list = getByID("admin", $id);
                if (mysqli_num_rows($list) > 0) {
                    $data = mysqli_fetch_array($list);
            ?>
                    <div class="card">
                        <!-- card-header -->
                        <div class="card-header">
                            <h4>Edit User admin</h4>
                        </div>
                        <!-- card-body -->
                        <div class="card-body">
                            <form action="code-admin.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id"value="<?=$data['id']?>">
                                        <label for="">Username</label>
                                        <input type="text" name="username" value="<?=$data['username']?>" placeholder="Enter User Name" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Email</label>
                                        <input type="email" name="email" value="<?=$data['email']?>" placeholder="Enter Email" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Password</label>
                                        <input type="password" name="password"value="<?=$data['password']?>"  placeholder="Enter Password" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Re-Password</label>
                                        <input type="password" name="re_password"value="<?=$data['password']?>"  placeholder="Enter Password" class="form-control">
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="">Upload Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <label for="">Current Image</label>
                                        <input type="hidden" name="old_image" value="<?=$data['image']?>">
                                        <img src="../images/<?=$data['image']?>" height="200px" width="200px">
                                    </div>
                                    

                                    <div class="col-md-6">
                                        <label for="">Phone</label>
                                        <input type="number" name="phone" value="<?=$data['phone']?>" placeholder="Enter phone number" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Address</label>
                                        <input type="text" name="address" value="<?=$data['address']?>" placeholder="Enter Address" class="form-control">
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="edit_user_admin_btn">Update</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>

            <?php }
            else {
                echo "Category not found";
            }
            } else {
                echo "ID missing from url";
            }
            ?>




        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>