<?php
    if(isset($_GET['id']) && $_GET['id'] > 0) {
        $category_id = $_GET['id'];
        $list_products = $ProductModel->select_products_by_cate($category_id);
    }else {
        header("Location: index.php");
    }

    $list_catgories = $CategoryModel->select_all_categories();
?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="index.php?url=cua-hang">
                            Sản phẩm
                        </a>
                        <span>
                            <?php foreach ($list_catgories as $value) {
                                if($value['category_id'] == $category_id) {
                                    echo $value['name'];
                                }
                            } ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="shop__sidebar">
                    <!-- Thanh tìm kiếm theo tên sản phẩm -->
                    <div class="sidebar__categories">
                        <div class="section-title">
                            <h4>TÌM KIẾM</h4>
                        </div>
                        <form action="index.php?url=cua-hang" method="get" class="search-form">
                            <input type="hidden" name="url" value="cua-hang">
                            <input type="text" name="search_query" placeholder="Nhập tên sản phẩm..." value="<?= isset($_GET['search_query']) ? $_GET['search_query'] : '' ?>" class="search-input">
                            <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    <!-- Danh mục sản phẩm -->
                    <div class="sidebar__categories">
                        <div class="section-title">
                            <h4>DANH MỤC</h4>
                        </div>
                        <div class="categories__accordion">
                            <div class="accordion" id="accordionExample">
                                <?php foreach ($list_catgories as $value) { extract($value); ?>
                                <div class="card">
                                    <div class="card-heading active">
                                        <a href="index.php?url=danh-muc-san-pham&id=<?=$category_id?>"><?=$name?></a>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <!-- Tìm theo giá -->
                    <div class="sidebar__filter">
                        <div class="section-title">
                            <h4>TÌM THEO GIÁ</h4>
                        </div>
                        <div class="filter-range-wrap">
                            <div class="range-slider">
                                <form action="index.php?url=cua-hang" method="get" class="filter-form">
                                    <input type="hidden" name="url" value="cua-hang">
                                    <input type="hidden" name="search_query" value="<?= isset($_GET['search_query']) ? $_GET['search_query'] : '' ?>">
                                    <div class="price-input">
                                        <p>Từ</p>
                                        <input type="number" name="min_price" value="<?= isset($_GET['min_price']) ? $_GET['min_price'] : '' ?>" placeholder="Min">
                                        <p>đến</p>
                                        <input type="number" name="max_price" value="<?= isset($_GET['max_price']) ? $_GET['max_price'] : '' ?>" placeholder="Max">
                                    </div>
                                    <button type="submit" class="filter-btn"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danh sách sản phẩm -->
<div class="col-lg-9 col-md-9">
    <div class="row">
        <?php foreach ($list_products as $value) {
            extract($value);
            $discount_percentage = $ProductModel->discount_percentage($price, $sale_price);
        ?>
        <div class="col-lg-4 col-md-6 col-6-rp-mobile">
            <div class="product__item sale">
                <div class="product__item__pic set-bg" data-setbg="upload/<?=$image?>">
                    <div class="label_right sale">-<?=$discount_percentage?></div>
                    <ul class="product__hover">
                        <li><a href="upload/<?=$image?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                        <li>
                            <a href="index.php?url=chitietsanpham&id_sp=<?=$product_id?>&id_dm=<?=$category_id?>"><span class="icon_search_alt"></span></a>
                        </li>
                        <li>
                        <?php if(isset($_SESSION['user'])) { ?>
                            <form action="index.php?url=gio-hang" method="post">
                                <input value="<?=$product_id?>" type="hidden" name="product_id">
                                <input value="<?=$_SESSION['user']['id']?>" type="hidden" name="user_id">
                                <input value="<?=$name?>" type="hidden" name="name">
                                <input value="<?=$image?>" type="hidden" name="image">
                                <input value="<?=$sale_price?>" type="hidden" name="price">
                                <input value="1" type="hidden" name="product_quantity">
                                <button type="submit" name="add_to_cart" id="toastr-success-top-right">
                                    <a><span class="icon_bag_alt"></span></a>
                                </button>
                            </form>
                        <?php } else { ?>
                            <button type="submit" onclick="alert('Vui lòng đăng nhập để thực hiện chức năng');" name="add_to_cart" id="toastr-success-top-right">
                                <a href="dang-nhap"><span class="icon_bag_alt"></span></a>
                            </button>
                        <?php } ?>
                        </li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6 class="text-truncate-1"><a href="index.php?url=chitietsanpham&id_sp=<?=$product_id?>&id_dm=<?=$category_id?>"><?=$name?></a></h6>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="product__price"><?=number_format($sale_price)."₫"?> <span><?=number_format($price)."đ"?> </span></div>
                </div>
            </div>
        </div>
        <?php } ?>

        <!-- Phân trang
        <?php if (isset($search_query) && $search_query !== '') {
            include 'search_pagination.php';
        } else {
            include 'pagination.php';
        } ?> -->
    </div>
</div>

        </div>
    </div>
</section>

<STYLE>
    .search-form {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search-input {
        width: 80%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 30px;
        font-size: 14px;
    }

    .search-btn {
        position: absolute;
        right: 10px;
        background: transparent;
        border: none;
        font-size: 16px;
        cursor: pointer;
    }

    .search-btn i {
        color: #333;
    }

    .filter-form {
        position: relative;
        display: flex;
        align-items: center;
    }

    .price-input {
        display: flex;
        align-items: center;
    }

    .price-input p {
        margin: 0 10px 0 0;
        font-size: 14px;
    }

    .price-input input {
        width: 80px;
        padding: 5px;
        margin: 0 5px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .filter-btn {
        position: absolute;
        right: 10px;
        background: transparent;
        border: none;
        font-size: 16px;
        cursor: pointer;
    }

    .filter-btn i {
        color: #333;
    }
</STYLE>
    <!-- Shop Section End -->