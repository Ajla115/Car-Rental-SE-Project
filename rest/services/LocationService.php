<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/LocationDao.class.php";


class LocationService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new LocationDao);
    }



     
}
?>
