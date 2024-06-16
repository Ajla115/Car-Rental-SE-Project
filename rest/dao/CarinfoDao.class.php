<?php
require_once __DIR__ . '/BaseDao.class.php';
class CarinfoDao extends BaseDao {
  

  public function __construct()
    {
        parent::__construct("carinfo");
    }

    public function get_by_type($car_type) {
      $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE car_type = :car_type");
      $stmt->execute(['car_type' => $car_type]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}


