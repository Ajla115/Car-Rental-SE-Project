<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/CarinfoDao.class.php";

class CarinfoService extends BaseService{

    public function __construct()
    {
        parent::__construct(new CarinfoDao);
    }

    public function add($car) {
        return $this->dao->add($car);
    }

    public function get_by_type($car_type) {
        return $this->dao->get_by_type($car_type);
    }

   // Ensure the method signature matches the parent class
   public function update($entity, $id, $id_column = 'id') {
    return $this->dao->update($entity, $id, $id_column);
}

    public function delete($id) {
        return $this->dao->delete($id);
    }
    
   
}

