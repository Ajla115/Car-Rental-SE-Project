<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/BookingDao.class.php";


class BookingService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new BookingDao);
    }


}
?>
