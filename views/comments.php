<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send_comment"])) {
        $user_id = $_POST["user_id"];
        $product_id = $_POST["product_id"];
        $content = $_POST["content"];

        if(isset($_GET['id_dm'])) {
            $catgory_id = $_GET['id_dm'];
        }else {
            $catgory_id = '';
        }
        $CommentModel->insert_comment($user_id, $product_id, $content);

        $link = 'index.php?url=chitietsanpham&id_sp='.$product_id.'&id_dm='.$catgory_id;
        Header("Location: $link");

    }

?>


<div class="tab-pane" id="tabs-2" role="tabpanel">
    <h6>Bình luận ( <?=count($list_comments)?> )</h6>

    <div class="row">
        <?php if(count($list_comments) > 0) {?>
        <div class="col-md-6">
            <?php foreach ($list_comments as $value) {
            ?>
            <div class="media mb-4">
                <img src="upload/<?=$value['image']?>" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                <div class="media-body">
                    <h6 class="mb-2 mt-1"><?=$value['full_name']?><small>  -  <?=$value['date']?></small></h6>

                    <p><?=$value['content']?></p>
                </div>
            </div>
            <hr>
            <?php 
            }
            ?>
        </div>
        <?php }else{?>
        <div class="col-md-6">
            <sapn>Chưa có bình luận</sapn>
        </div>
        <?php }?>

        <div class="col-md-6">
        <?php 
            if(isset($_SESSION['user'])) {
        ?>
            <h4 class="mb-4">Để lại bình luận</h4>


            <form action="" method="post">
                <div class="form-group">
                    <label class="text-dark" for="message">Nội dung *</label>
                    <input type="hidden" name="user_id" value="<?=$_SESSION['user']['id']?>">
                    <input type="hidden" name="product_id" value="<?=$product_id?>">
                    <textarea id="message" name="content" required cols="30" rows="5" class="form-control"></textarea>
                </div>

                <div class="form-group mb-0">
                    <input type="submit" name="send_comment" value="Gửi bình luận" class="btn btn-primary px-3">
                </div>
            </form>
        </div>
        <?php 
            }else {
        ?>
            <h4 class="mb-4">Vui lòng đăng nhập để có thể bình luận</h4>
            <div class="form-group mb-0">
                <a class="btn btn-primary px-3" href="index.php?url=dang-nhap">Đăng nhập ngay</a>
            </div>
        <?php 
            }
        ?>
    </div>

</div>