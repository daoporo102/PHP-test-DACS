<?php
include 'includes/header.php';
require_once '../functions/myfunctions.php';
include '../config/connectdb.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <h1 style="text-align: center;height: 50px; margin-top: 5px;">
                    DANH SÁCH CÔNG TY
                </h1>
                <button type="button" class="btn btn-success float-end  w-15"><a href="add-corporation.php">Add</a></button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" style="text-align: center;">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Field</th>
                        <th>Image</th>
                        <!-- <th>Description</th> -->
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php

                        if (isset($_GET['trang'])) {
                            $page = $_GET['trang'];
                        } else {
                            $page = 1;
                        }
                        if ($page == '' || $page == 1) {
                            $begin = 0;
                        } else {
                            $begin = ($page * 3) - 3;
                        }

                        $query = "SELECT `id_corp`, `corp_name`, `corp_field`, `image`
                         FROM `corporation`  LIMIT $begin,3 ";
                        $query_run = mysqli_query($conn, $query);


                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $item) {

                        ?>
                                <tr>
                                    <td><?= $item['id_corp'] ?></td>
                                    <td><?= $item['corp_name'] ?></td>
                                    <td><?= $item['corp_field'] ?></td>
                                    <td>
                                        <img style="width: 100px;height:100px;" src="../images/<?= $item['image']; ?>">
                                    </td>

                                    <td>
                                        <a href="edit-list-corporation.php?id_corp=<?= $item['id_corp'] ?>" class="btn btn-primary">Edit</a>

                                        <form action="code-list-corporation.php" method="post">
                                            <input type="hidden" name="id_corp" value="<?= $item['id_corp'] ?>">
                                            <button type="submit" class="btn btn-danger" name="delete_corporation_btn"> Delete</button>
                                        </form>

                                    </td>
                                </tr>

                        <?php
                            }
                        } else {
                            echo "No records found";
                        }
                        ?>
                        <tr >
                            <td style="margin-left: 200px;padding-left: 100px;">
                                <style type="text/css">
                                    ul.list-trang {
                                        padding: 0;
                                        margin: 0;
                                        
                                        list-style: none;
                                    }

                                    ul.list-trang li {
                                        float: left;
                                        padding: 5px 13px;
                                        margin: 3px;
                                        background-color: burlywood;
                                        display: block;
                                    }

                                    ul.list-trang li a {
                                        color: #000;
                                        text-align: center;
                                        text-decoration: none;

                                    }
                                </style>
                                <!-- <p>Trang : </p> -->
                                <?php
                                $sql_trang = "SELECT * FROM `corporation`";
                                $sql_trang_run = mysqli_query($conn, $sql_trang);
                                $row_count = mysqli_num_rows($sql_trang_run);
                                 $trang = ceil($row_count / 3);


                                ?>
                                <ul class="list-trang">
                                    <?php
                                    for ($i = 1; $i <= $trang; $i++) {
                                    ?>
                                        <li
                                        <?php if ($i == $page) {
                                                    echo 'style="background:brown;"';
                                                } else {
                                                    echo '';
                                                }
                                                ?> 
                                        ><a href="list-corporation.php?trang=<?= $i ?>"><?= $i ?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
</div>

<?php include 'includes/footer.php'; ?>