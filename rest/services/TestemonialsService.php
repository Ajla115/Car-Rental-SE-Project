<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/TestemonialsDao.class.php";

class TestemonialsService extends BaseService{

    public function __construct()
    {
        parent::__construct(new TestemonialsDao);
    }


  
}

