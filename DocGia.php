<?php
    include "connection.php";
    $method = $_SERVER['REQUEST_METHOD'];
    header('Content-Type: application/json');
    switch ($method) {
    case 'GET':
        // Xử lý yêu cầu GET để lấy danh sách người dùng
        $result =  mysqli_query($conn, "Select * from docgia");
        $users= array();
        while ($row = mysqli_fetch_assoc($result)){
            $users[] = $row;
        }
        echo json_encode($users);
        break;
    case 'POST':
        // Xử lý yêu cầu POST để thêm người dùng mới
        $data = json_decode(file_get_contents('php://input'), true);    

        // Xác thực dữ liệu (trong thực tế, bạn nên kiểm tra xác thực mạnh mẽ hơn)
        if (!isset($data['MaDG']) || !isset($data['TenDG']) || !isset($data['NgaySinh']) || !isset($data['GioiTinh'])) {
            http_response_code(400); // Bad Request
            echo json_encode(array('error' => 'Dữ liệu không hợp lệ.'));
            exit;
        }
        
        $query = "insert into docgia values('{$data['MaDG']}', '{$data['TenDG']}', '{$data['NgaySinh']}',
            '{$data['GioiTinh']}', '{$data['DienThoai']}', '{$data['Email']}', '{$data['HanDung']}')";
        $result = mysqli_query($conn, $query);

        http_response_code(201); // Created
        echo json_encode(array('message' => 'Người dùng đã được tạo thành công.'));
        break;
    case 'PUT':
        // Xử lý yêu cầu PUT để cập nhật thông tin người dùng
        $data = json_decode(file_get_contents('php://input'), true);

        // Xác thực dữ liệu (trong thực tế, bạn nên kiểm tra xác thực mạnh mẽ hơn)
        if (!isset($data['MaDG']) || !isset($data['TenDG']) || !isset($data['NgaySinh']) || !isset($data['GioiTinh'])) {
            http_response_code(400); // Bad Request
            echo json_encode(array('error' => 'Dữ liệu không hợp lệ.'));
            exit;
        }
        
        $query = "Update docgia Set TenDG = '{$data['TenDG']}', NgaySinh = '{$data['NgaySinh']}',
            GioiTinh = '{$data['GioiTinh']}', DienThoai = '{$data['DienThoai']}',
             Email = '{$data['Email']}', HanDung = '{$data['HanDung']}' Where MaDG = '{$data['MaDG']}'";
        $result = mysqli_query($conn, $query);

        http_response_code(200); // OK
        echo json_encode(array('message' => 'Thông tin người dùng đã được cập nhật.'));
        break;
    case 'DELETE':
        // Xử lý yêu cầu DELETE để xóa người dùng
        $data = json_decode(file_get_contents('php://input'), true);

        // Xác thực dữ liệu (trong thực tế, bạn nên kiểm tra xác thực mạnh mẽ hơn)
        if (!isset($data['MaDG'])) {
            http_response_code(400); // Bad Request
            echo json_encode(array('error' => 'Dữ liệu không hợp lệ.'));
            exit;
        }

        // Xóa người dùng từ cơ sở dữ liệu
        $query = "DELETE FROM docgia WHERE MaDG = '{$data['MaDG']}'";
        $result = mysqli_query($conn, $query);

        http_response_code(204); // No Content
        break;
    default:
        // Phương thức không được hỗ trợ
        http_response_code(405); // Method Not Allowed
        echo json_encode(array('error' => 'Phương thức không được hỗ trợ.'));
        break;
}
$conn->close();
