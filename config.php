<?php
class Database {
    // định nghĩa các hằng số để kết nối csdl
    private const DB_SERVER = 'localhost';
    private const DB_USERNAME = 'root';
    private const DB_PASSWORD = '';
    private const DB_NAME = 'php_basic';
    public $connect;
    // mở kết nối DB
    public function openConnect()
    {
        try {
            $connect = mysqli_connect(self::DB_SERVER, self::DB_USERNAME, self::DB_PASSWORD, self::DB_NAME);
            if ( !$this->connect ) {
                throw new Exception("Lỗi: Không thể kết nối đến server!" . mysqli_connect_error());
            }
            print_r($connect);
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $connect;
    }
    // đóng kết nối
    public function closeConnect()
    {
        $connect = '';
    }
}



