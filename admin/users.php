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
                DANH SÁCH TÀI KHOẢN USERS
                </h1>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead style="text-align: center;">
                        <th>ID_user</th>
                        <th>Username</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Role</th>
                    </thead>
                    <tbody>
                        <?php
                        $list = getAll("users");
                    
                        if (mysqli_num_rows($list) > 0) {
                            foreach ($list as $item) {
                        ?>
                                <tr style="text-align: center;">
                                    <td><?= $item['id_user'] ?></td>                             
                                    <td ><?= $item['username'] ?></td>
                                    
                                    <td>
                                 <img style="width: 100px;height:100px;" src="../images/<?=$item['image']; ?>">
                                    </td>

                                    <td ><?= $item['email'] ?></td>
                                    <td ><?= $item['address'] ?></td>
                                    <td ><?= $item['role'] ?></td>

                                
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