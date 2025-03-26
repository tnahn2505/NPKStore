<?php
    if(isset($_GET['id'])) {

        try {
            $AddressModel->delete_address($_GET['id']);
            header('Location: index.php?url=them-dia-chi');
        } catch (\Throwable $th) {
            throw $th;
        }
    
    }
?>