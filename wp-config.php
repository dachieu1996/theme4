<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'theme4' );

/** Username của database */
define( 'DB_USER', 'dachieu' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', 'hieuthao123' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'I$)lE%#u0#Dge<=;Lu)Juxr$H:HI p&lBmfRTGmAFKA-#HK2X(-q%>I!n%N*5~Oi' );
define( 'SECURE_AUTH_KEY',  '.159(Q8*Ga$JCM!4@O<!$<D-$|vXOaK#9l^{:-Jw,<i(va`]]!#D:)lsN7wI:TWX' );
define( 'LOGGED_IN_KEY',    '^{sxA8mV?+)XI9=>(1QH(hich:!<+]&+Y4V0s9tZ)IFi#XM{{IlTgN-Db=uvdXuv' );
define( 'NONCE_KEY',        '3Ap53Q0}TXi*-vCPrEe@VuYnn|+x1iskEzX!LfR7o){*Zmj$3Vg9sB(DT,k)1*IK' );
define( 'AUTH_SALT',        'Yn-wv?$yCFB->S`66^XA }:AAS-w.4+%>js74xFL%NK;g}D-lYWUxSx!s1]2|uDo' );
define( 'SECURE_AUTH_SALT', ':-0K4;Q5F^|?85BM!mxC=#_}+!pF1p|^948`6gWn0 d)`g:zwHc?ai(s[(Xtxmz@' );
define( 'LOGGED_IN_SALT',   'i(E3<Ls.& /2yi@3XnC?>Y`scsT34@*@r_x7%>AcX89hbd~?<({ZY{8Q>]O})q#N' );
define( 'NONCE_SALT',       'i4%+eCs>.:`-=|Udh1K_RVyLcWcj>PAv%0c9[ah=]C1#M%mC3.=12JbO[(x/r=nb' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
