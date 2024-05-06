<?php
require_once __DIR__ . '/BaseDao.class.php';


class VehicleDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("vehicles");  
        //name of the table in DB is written with lower-case letter, so I wrote it like that in every class
    }


    // custom function, which is not present in BaseDao
    // query_unique -> returns only 1 result if multiple are present
    //function to get a name and last name of the employee based on its id and location_id
    function getCarsProducedInCertainYear($year)
    {
        return $this->query("SELECT *
        FROM vehicles
        WHERE year = :year", ["year" => $year]);
    }
    
}
?>
