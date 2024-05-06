<?php
require_once __DIR__ . '/BaseDao.class.php';


class BookingDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("bookings");  
        //name of the table in DB is written with lower-case letter, so I wrote it like that in every class
    }



    
}
    
    

?>
