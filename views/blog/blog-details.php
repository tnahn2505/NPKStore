<?php
    if(isset($_GET['id']) && ($_GET['id'] > 0)) {
        $post_id = $_GET['id'];
        
    }
    $post_details = $PostModel->select_post_by_id($post_id);

    // Sidebar
    $list_post_catgories = $PostModel->select_post_category();
    $list_posts = $PostModel->select_all_posts();
?>
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="trang-chu"><i class="fa fa-home"></i> Trang chủ</a>
                    <a href="bai-viet">Bài viết</a>
                    <span><?=$post_details['title']?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="blog__details__content">
                    <div class="blog__details__item">
                        <img src="upload/<?=$post_details['image']?>" alt="">
                        <div class="blog__details__item__title">
                            <span class="tip"><?=$post_details['cate_name']?></span>
                            <h3><?=$post_details['title']?></h3>
                            <ul>
                                <li>by <span><?=$post_details['author']?></span></li>
                                <li><?=$post_details['created_at']?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="blog__details__desc">
                        <?=$post_details['content']?>
                        
                    </div>
                    <div class="blog__details__quote">
                        <div class="icon"><i class="fa fa-quote-left"></i></div>
                        
                    </div>
                    <div class="blog__details__desc">
                        <p class="text-center">Hết cảm ơn đã đọc bài viết</p>
                    </div>
                    
                    
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
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
</section>
<!-- Blog Details Section End -->

<style>
    .blog__details__item__title h3 {
        color: #111111;
        font-weight: 600;
        line-height: 39px;
        margin-top: 10px;
        margin-bottom: 5px;
    }
</style>