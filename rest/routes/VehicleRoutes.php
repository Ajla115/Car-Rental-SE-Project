<?php

/**
 * @OA\Get(path="/vehicles", tags={"vehicles"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all vehicles from the API. ",
 *         @OA\Response( response=200, description="List of vehicles.")
 * )
 */

//works
//get information about all vehicles
Flight::route('GET /vehicles', function () {
    Flight::json(Flight::vehicleService()->get_all());
});



 /**
* @OA\Post(
*     path="/vehicles", security={{"ApiKeyAuth": {}}},
*     description="Add vehicle",
*     tags={"vehicles"},
*     @OA\RequestBody(description="Add new vehicle", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="location_id", type="int", example="1",	description="Vehicle's location"),
*    				@OA\Property(property="model", type="string", example="SUV",	description="Vehicle's model" ),
*                   @OA\Property(property="year", type="int", example="2014",	description="Vehicle's year" ),
*                   @OA\Property(property="color", type="string", example="red",	description="Vehicle's color" ),
*                   @OA\Property(property="mileage", type="string", example="156608",	description="Vehicle's mileage" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Vehicle has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

/*works*/
Flight::route('POST /vehicles', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::vehicleService()->add($data));
});



 /**
 * @OA\Delete(
 *     path="/vehicles/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete vehicle",
 *     tags={"vehicles"},
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

//works
Flight::route('DELETE /vehicles/@id', function ($id) {
    Flight::vehicleService()->delete($id);
});


 /**
  * @OA\Get(path="/vehicles/{id}", tags={"vehicles"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="id", example=1, description="Vehicle ID"),
  *     @OA\Response(response="200", description="Fetch individual vehicle")
  * )
  */

//works
Flight::route('GET /vehicles/@id', function ($id) {
    Flight::json(Flight::vehicleService()->get_by_id($id));
});



/**
 * @OA\Put(
 *     path="/vehicles/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Edit vehicle",
 *     tags={"vehicles"},
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

//works
Flight::route("PUT /vehicles/@id", function($id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Vehicle info edited succesfully', 'data' => Flight::vehicleService()->update($data, $id)]); 
    //-> converts the results to the JSON form
    //This array we could have created above, store it in a variable, and then call that variable or do it directly like this
});


 /**
  * @OA\Get(path="/vehicles/year/{year}", tags={"vehicles"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="year", example=2014, description="Vehicle's year"),
  *     @OA\Response(response="200", description="Fetch individual vehicle based on year of production")
  * )
  */

//works
Flight::route('GET /vehicles/year/@year', function ($year) {
    Flight::json(Flight::vehicleService()->getCarsProducedInCertainYear($year));
});
?>
