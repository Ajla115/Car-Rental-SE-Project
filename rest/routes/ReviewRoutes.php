<?php
/**
 * @OA\Get(path="/reviews", tags={"reviews"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all reviews from the API. ",
 *         @OA\Response( response=200, description="List of reviews.")
 * )
 */

//works
//get all information regarding all reviews
Flight::route('GET /reviews', function () {
    Flight::json(Flight::reviewService()->get_all());
});

 /**
* @OA\Post(
*     path="/reviews", security={{"ApiKeyAuth": {}}},
*     description="Add review",
*     tags={"reviews"},
*     @OA\RequestBody(description="Add new review", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*                   @OA\Property(property="booking_id", type="int", example="1",	description="Booking ID"),
*    				@OA\Property(property="review_score", type="double", example="6",	description="Review score" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="review has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

//works
//add a new review
Flight::route('POST /reviews', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reviewService()->add($data));
});

 /**
  * @OA\Get(path="/reviews/reviewscores/{review_score}", tags={"reviews"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="review_score", example=5, description="Review score"),
  *     @OA\Response(response="200", description="Fetch individual review based on review score")
  * )
  */


//works, and returns all results that satisfy the condition
//get all reviews with a certain review score
Flight::route('GET /reviews/reviewscores/@review_score', function ($review_score) {
    Flight::json(Flight::reviewService()->getCarsWithCertainScores($review_score));
});


 /**
 * @OA\Delete(
 *     path="/reviews/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete review",
 *     tags={"reviews"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Review ID"),
 *     @OA\Response(
 *         response=200,
 *         description="Note deleted"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */

//works
Flight::route('DELETE /reviews/@id', function ($id) {
    Flight::reviewService()->delete($id);
});


 /**
  * @OA\Get(path="/reviews/{id}", tags={"reviews"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="id", example=1, description="Review ID"),
  *     @OA\Response(response="200", description="Fetch individual review")
  * )
  */

//works
Flight::route('GET /reviews/@id', function ($id) {
    Flight::json(Flight::reviewService()->get_by_id($id));
});


/**
 * @OA\Put(
 *     path="/reviews/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Edit review",
 *     tags={"reviews"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Review ID"),
 *     @OA\RequestBody(description="review info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="booking_id", type="int", example="1",	description="Booking ID"),
*    				@OA\Property(property="review_score", type="double", example="6",	description="Review score"),
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="review has been edited"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */

//works
Flight::route("PUT /reviews/@id", function($id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Review edited succesfully', 'data' => Flight::reviewService()->update($data, $id)]); 
    //-> converts the results to the JSON form
    //This array we could have created above, store it in a variable, and then call that variable or do it directly like this
});


?>
