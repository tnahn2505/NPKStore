<?php
$html_forgot_password = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light dark" />
    <meta name="supported-color-schemes" content="light dark" />
    <title>Đặt lại mật khẩu</title>
    <style type="text/css" rel="stylesheet" media="all">
      /* Nội dung CSS giống như bạn đã viết */
    </style>
  </head>
  <body>
    <span class="preheader">Bạn đã yêu cầu đặt lại mật khẩu. Nhấn vào liên kết bên dưới để thực hiện.</span>
    <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
      <tr>
        <td align="center">
          <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
              <td class="email-masthead">
                <h2>NPK Store</h2>
              </td>
            </tr>
            <tr>
              <td class="email-body" width="570" cellpadding="0" cellspacing="0">
                <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                  <tr>
                    <td class="content-cell">
                      <div class="f-fallback">
                        <h1>Xin chào quý khách,</h1>
                        <p>Bạn đã yêu cầu đặt lại mật khẩu. Nhấn vào nút bên dưới để tiếp tục.</p>
                        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                          <tr>
                            <td align="center">
                              <a href="http://localhost/index.php?url=khoi-phuc-mat-khau&email=' . urlencode($email) . '&token=' . urlencode($token) . '" class="f-fallback button button--green" target="_blank">Đặt lại mật khẩu</a>
                            </td>
                          </tr>
                        </table>
                        <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này hoặc liên hệ với chúng tôi để được hỗ trợ.</p>
                        <p>Trân trọng,<br>Đội ngũ NPK Store</p>
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                  <tr>
                    <td class="content-cell" align="center">
                      <p class="f-fallback sub align-center">
                        [NPK Store]<br>
                   
                      </p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
';

?>
