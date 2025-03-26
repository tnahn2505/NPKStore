<?php
    require_once "export-library.php";

    $listOrders = $OrderModel->select_list_orders_admin();

    //File name exel
    $fileName = "Đơn-hàng_" . date('m-d-Y') . ".xlsx"; 

    // Define column names 
    $excelData[] = array('Thứ tự', 'Tên khách hàng','Email','Số điện thoại', 'Ngày đặt', 'Tổng tiền', 'Trạng Thái'); 

    $i = 0;
    foreach ($listOrders as $value) {
        extract($value);

        // Định dạng lại ngày đặt hàng
        $formatted_date = $BaseModel->date_format($order_date, '');
        $i++;
        if($status == 1) {
            $status = 'Chưa xác nhận';
        }elseif($status == 2) {
            $status = 'Đã xác nhận';
        }elseif($status == 3) {
            $status = 'Đang giao';
        }elseif($status == 4) {
            $status = 'Giao thành công';
        }


        $lineData = array($i, $full_name, $email, $user_phone, $formatted_date, $total, $status); 
        $excelData[] = $lineData; 
    }
    

    $excelData[] = $lineData; 

    // Export data to excel and download as xlsx file 
    $xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
    $xlsx->downloadAs($fileName); 
 
exit; 
?>