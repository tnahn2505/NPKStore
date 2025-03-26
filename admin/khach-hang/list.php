<?php
    $list_users = $CustomerModel->select_all_users();

?>

<!-- LIST PRODUCTS -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Danh sách tài khoản</h6>

        </div>

        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0" id="users-list">
                <thead>
                    <tr class="text-dark">

                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th> 
                        <th scope="col">Họ tên</th> 
                        <th scope="col">Email</th> 
                        <th scope="col">Số điện thoại</th>   
                        <th scope="col">Vai trò</th>
                        <th scope="col">Thao tác</th>      
                        <!-- <th scope="col">Chỉnh sửa</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($list_users as $value) {
                        extract($value);
                        $i++;
                    
                    ?>
                    <tr>
                        <td><?=$i?></td>
                        <td>
                            <img style="max-width: 50px;" src="../upload/<?=$image?>" alt="">
                        </td>
                        <td><?=$full_name?></td>
                        <td>
                            <?=$email?>
                        </td>
                        <td> <?=$phone?> </td>
                        <td> <?php
                            if($role == 0) {
                                echo "Khách hàng";
                            }elseif($role == 1) {
                                echo "Nhân viên";
                            }
                            ?> 
                        </td>
                        <td>
                        <a href="<?= $CustomerModel->ViewAccount($user_id) ?>" class="btn btn-primary btn-sm">Xem</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    
                    
                </tbody>
            </table>
            
        </div>
    </div>
</div>
<!-- LIST PRODUCTS END -->
<style>
    td {
        height: 50px;
    }
</style>