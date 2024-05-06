<?php
Flight::route('GET /connection-check', function(){
  /*Coonection check to see if deployed database works*/
    new BookingService();
});


/**
 * @OA\Get(path="/bookings", tags={"bookings"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all bookings from the API. ",
 *         @OA\Response( response=200, description="List of bookings.")
 * )
 */

//works
//get all bookings from database
Flight::route('GET /bookings', function () {
    Flight::json(Flight::bookingService()->get_all());
}); 





/**
 * @OA\Delete(
 *     path="/bookings/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete booking",
 *     tags={"bookings"},
 *     @OA\Parameter(in="path", name="id", example=1, description="booking ID"),
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
//delete all information regarding one booking based upon its id
Flight::route('DELETE /bookings/@id', function ($id) {
    Flight::bookingService()->delete($id);
});


 /**
  * @OA\Get(path="/bookings/{id}", tags={"bookings"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="id", example=1, description="Booking ID"),
  *     @OA\Response(response="200", description="Fetch individual booking")
  * )
  */


//works
//get all regarding one booking based on its id as parameter
Flight::route('GET /bookings/@id', function ($id) {
    Flight::json(Flight::bookingService()->get_by_id($id));
});


/**
 * @OA\Put(
 *     path="/bookings/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Edit booking",
 *     tags={"bookings"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Booking ID"),
 *     @OA\RequestBody(description="Booking info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *                  @OA\Property(property="customer_id", type="int", example="1",	description="Customer ID"),
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
 *         description="Booking has been edited"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */

//works
//update an existing booking
Flight::route("PUT /bookings/@id", function($id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Booking edited succesfully', 'data' => Flight::bookingService()->update($data, $id)]); 
    //-> converts the results to the JSON form
    //This array we could have created above, store it in a variable, and then call that variable or do it directly like this
});
 /**
* @OA\Post(
*     path="/bookings", security={{"ApiKeyAuth": {}}},
*     description="Add booking",
*     tags={"bookings"},
*     @OA\RequestBody(description="Add new booking", required=true,
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

//works
//add a new booking
Flight::route('POST /bookings', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::bookingService()->add($data));
});

?>
