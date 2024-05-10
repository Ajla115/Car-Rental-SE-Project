<?php
/**
 * @OA\Get(path="/tests", tags={"testemonials"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all testemonials from the API. ",
 *         @OA\Response( response=200, description="List of all testemonials.")
 * )
 */

Flight::route('GET /tests', function(){
  Flight::json(Flight::testemonialsService()->get_all());
});


 /**
  * @OA\Get(path="/tests/{id}", tags={"testemonials"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="id", example=1, description="Testemonial ID"),
  *     @OA\Response(response="200", description="Fetch individual comment based on a testemonial ID")
  * )
  */
  
Flight::route('GET /tests/@id', function($id){
  Flight::json(Flight::testemonialsService()->get_by_id($id));
});


/**
* @OA\Post(
*     path="/tests", security={{"ApiKeyAuth": {}}},
*     description="Add booking",
*     tags={"tests"},
*     @OA\RequestBody(description="Add new testimonials", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="customer_id", type="int", example="1",	description="Customer ID"),
*    				@OA\Property(property="vehicle_id", type="int", example="1",	description="Vehicle ID" ),
*                   @OA\Property(property="date_of_booking", type="date", example="2020-07-20",	description="Date of booking" ),
*                   @OA\Property(property="location_id", type="int", example="1",	description="Location ID" ),
*                   @OA\Property(property="employee_id", type="int", example="1",	description="Employee ID" ),
*                   @OA\Property(property="paid", type="tinyint", example="1",	description="Paid or not" ),
*                   @OA\Property(property="date_of_payment", type="date", example="2020-01-19",	description="Date of payment" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Booking has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

Flight::route('POST /tests', function () {
  $data = Flight::request()->data->getData();
  Flight::json(Flight::testemonialsService()->add($data));
});

 /**
 * @OA\Delete(
 *     path="/tests/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete Testimonial",
 *     tags={"tests"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Vehicle ID"),
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

Flight::route('DELETE /tests/@id', function ($id) {
  Flight::testemonialsService()->delete($id);
});

/**
 * @OA\Put(
 *     path="/tests/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Edit tests",
 *     tags={"tests"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Vehicle ID"),
 *     @OA\RequestBody(description="Vehicle info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *                  @OA\Property(property="location_id", type="int", example="1",	description="Vehicle's location"),
*    				@OA\Property(property="model", type="string", example="SUV",	description="Vehicle's model" ),
*                   @OA\Property(property="year", type="int", example="2014",	description="Vehicle's year" ),
*                   @OA\Property(property="color", type="string", example="red",	description="Vehicle's color" ),
*                   @OA\Property(property="mileage", type="string", example="156608",	description="Vehicle's mileage" ),
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Vehicle has been edited"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */

Flight::route("PUT /tests/@id", function($id){
  $data = Flight::request()->data->getData();
  Flight::json(['message' => 'Testimonial info edited succesfully', 'data' => Flight::testemonialsService()->update($data, $id)]); 
  //-> converts the results to the JSON form
  //This array we could have created above, store it in a variable, and then call that variable or do it directly like this
});


?>
