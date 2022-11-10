<?php
include 'includes/header.php';
 require_once '../functions/myfunctions.php';
include '../config/connectdb.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <h1 style="text-align: center;height: 50px; margin-top: 25px;"> 
                DANH SÁCH TÀI KHOẢN ADMIN
                </h1>
                <button type="button"   class="btn btn-success float-end  w-15"><a href="add-user-admin.php">Add</a></button> 

            </div>
            <div class="card-body" style="text-align: center;">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Avatar</th>
                        <th>Phone</th>
                        <th>Address</th>
                    </thead>
                    <tbody>
                        <?php
                        $list = getAll("admin");
                    
                        if (mysqli_num_rows($list) > 0) {
                            foreach ($list as $item) {
                        ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>                             
                                    <td ><?= $item['username'] ?></td>
                                    <td ><?= $item['password'] ?></td>
                                   
                                    <td>
                                 <img style="width: 100px;height:100px;" src="../images/<?=$item['image']; ?>">
                                    </td>
                                   

                                    <td ><?= $item['phone'] ?></td>
                                    <td ><?= $item['address'] ?></td>

                                    <td>
                                        <a href="edit-user-admin.php?id=<?= $item['id'] ?>" class="btn btn-primary">Edit</a>
                                        <form action="code-admin.php" method="post">
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <button type="submit" class="btn btn-danger" name="delete_user_admin_btn"> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "No records found";
                        }
                        ?>

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
</div>

<?php include 'includes/footer.php'; ?>