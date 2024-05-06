<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/ReviewDao.class.php";


class ReviewService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new ReviewDao);
    }


    function getCarsWithCertainScores($review_score)
    {
        return $this->dao->getCarsWithCertainScores($review_score);
    }
}
?>
