<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/CarinfoDao.class.php";

class CarinfoService extends BaseService{

    public function __construct()
    {
        parent::__construct(new CarinfoDao);
    }

   
}

