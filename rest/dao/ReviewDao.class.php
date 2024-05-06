<?php
require_once __DIR__ . '/BaseDao.class.php';


class ReviewDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("reviews");  
        //name of the table in DB is written with lower-case letter, so I wrote it like that in every class
    }


    // custom function, which is not present in BaseDao
    // query_unique -> returns only 1 result if multiple are present
    //function to get a name and last name of the employee based on its id and location_id
    function getCarsWithCertainScores($review_score)
    {
        return $this->query("SELECT *
        FROM reviews
        WHERE review_score = :review_score", ["review_score" => $review_score]);
    }
    
}
?>
