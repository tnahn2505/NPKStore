<?php
    $list_posts = $PostModel->select_all_posts();

    $list_post_catgories = $PostModel->select_post_category();
?>
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Bài viết</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <?php foreach ($list_posts as $value) {
                        extract($value);
                    ?>
                    <div class="col-lg-6 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <a href="chi-tiet-bai-viet&id=<?=$post_id?>">
                                <div class="blog__item__pic set-bg" data-setbg="upload/<?=$image?>"></div>
                            </a>
                            <div class="blog__item__text">
                                <h6><a href="chi-tiet-bai-viet&id=<?=$post_id?>"><?=$title?></a></h6>
                                <ul>
                                    <li>Tác giả <span><?=$author?></span></li>
                                    <li><?=$created_at?></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <?php 
                    }
                    ?>                
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="blog__sidebar">
                            <div class="blog__sidebar__item">
                                <div class="section-title">
                                    <h4>Chuyên mục</h4>
                                </div>
                                <ul>
                                    <li><a href="bai-viet">Tất cả</span></a></li>
                                    <?php
                                    foreach ($list_post_catgories as $value) {
                                        extract($value);                              
                                    ?>
                                    <li><a href="danh-muc-bai-viet&id=<?=$id?>"><?=$name?> <span>(<?=$qty_post?>)</span></a></li>
                                    <?php
                                    }
                                    ?>
                                    
                                </ul>
                            </div>
                            <div class="blog__sidebar__item">
                                <div class="section-title">
                                    <h4>Bài viết mới</h4>
                                </div>
                                <?php
                                foreach ($list_posts as $value) {
                                    extract($value);
                                
                                ?>
                                <a href="chi-tiet-bai-viet&id=<?=$post_id?>" class="blog__feature__item">
                                    <div class="blog__feature__item__pic">
                                        <img style="max-width: 110px;" src="upload/<?=$image?>" alt="">
                                    </div>
                                    <div class="blog__feature__item__text">
                                        <h6 class="text-truncate-2"><?=$title?></h6>
                                        <span><?=$created_at?></span>
                                    </div>
                                </a>
                                <?php
                                }
                                ?>
                                
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>







            <div class="col-lg-12 text-center">
                <a href="#" class="primary-btn load-btn">Xem thêm</a>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->