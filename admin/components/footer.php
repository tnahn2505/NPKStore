<!-- Conntent end -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Nhóm 2 SGUER</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            
                            Designed By <a href="#1">VU THANH KIET</a>
                        </br>
                        <a class="border-bottom" href="#1" target="_blank"></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public_admin/lib/chart/chart.min.js"></script>
    <script src="public_admin/lib/easing/easing.min.js"></script>
    <script src="public_admin/lib/waypoints/waypoints.min.js"></script>
    <script src="public_admin/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="public_admin/lib/tempusdominus/js/moment.min.js"></script>
    <script src="public_admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="public_admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <!--  CKEditor CDN -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <script>

        if(document.getElementById('categories-list')) {
            const dataTableSearch = new DataTable("#categories-list", {
                responsive: true,
                searchable: true,
                fixedHeight: false,
                lengthMenu: [5, 10, 15, 20, 25],
                pageLength: 5
            });
        }

        if(document.getElementById('orders-list')) {
            const dataTableSearch = new DataTable("#orders-list", {
                responsive: true,
                searchable: true,
                fixedHeight: false,
                lengthMenu: [5, 10, 15, 20, 25],
                pageLength: 5
            });
        }

        if(document.getElementById('comments-list')) {
            const dataTableSearch = new DataTable("#comments-list", {
                responsive: true,
                searchable: true,
                fixedHeight: false,
                lengthMenu: [5, 10, 15, 20, 25],
                pageLength: 5
            });
        }

        if(document.getElementById('post-list')) {
            const dataTableSearch = new DataTable("#post-list", {
                responsive: true,
                searchable: true,
                fixedHeight: false,
                lengthMenu: [5, 10, 15, 20, 25],
                pageLength: 5
            });
        }

        if(document.getElementById('users-list')) {
            const dataTableSearch = new DataTable("#users-list", {
                responsive: true,
                searchable: true,
                fixedHeight: false,
                lengthMenu: [5, 10, 15, 20, 25],
                pageLength: 5
            });
        }

        if(document.getElementById('khohang-list')) {
            const dataTableSearch = new DataTable("#khohang-list", {
                responsive: true,
                searchable: true,
                fixedHeight: false,
                lengthMenu: [5, 10, 15, 20, 25],
                pageLength: 5
            });
        }

        ClassicEditor
            .create(document.querySelector('#short_description'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

        // Tạo trình soạn thảo cho #product_details
        ClassicEditor
            .create(document.querySelector('#product_details'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });    
    </script>

    <script>
        function confirmDeletion() {
        return confirm("Bạn có chắc muốn xóa? Sau khi xóa sẽ không thể khôi phục!   ");
    
        }

        function confirmDeletionTemp() {
        return confirm("Bạn có chắc muốn đưa sản phẩm vào thùng rác?");
    
        }
    </script>

    <!-- Template Javascript -->
    <script src="public_admin/js/main.js"></script>
</body>

</html>