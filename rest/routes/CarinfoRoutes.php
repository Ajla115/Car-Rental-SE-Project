<?php




/**
 * @OA\Get(path="/carinfo", tags={"car info"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return car information. ",
 *         @OA\Parameter(
 *             name="car_type",
 *             in="query",
 *             description="Type of the car",
 *             required=false,
 *             @OA\Schema(type="string")
 *         ),
 *         @OA\Response( response=200, description="List of car details.")
 * )
 */
Flight::route('GET /carinfo', function(){
  $car_type = Flight::request()->query['car_type'];
  if ($car_type) {
      Flight::json(Flight::carinfoService()->get_by_type($car_type));
  } else {
      Flight::json(Flight::carinfoService()->get_all());
  }
});


   /**
  * @OA\Get(path="/carinfo/{id}", tags={"carinfo"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="id", example=1, description="Car info ID"),
  *     @OA\Response(response="200", description="Fetch individual car info")
  * )
  */

  Flight::route('GET /carinfo/@id', function($id){
    Flight::json(Flight::carinfoService()->get_by_id($id));
  });

  

  /**
  * @OA\Post(path="/carinfo", tags={"car info"}, security={{"ApiKeyAuth": {}}},
  *     @OA\RequestBody(description="Add new car info", required=true,
  *         @OA\MediaType(mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(property="car_name", type="string", example="Golf 7", description="Name of the car"),
  *                 @OA\Property(property="price", type="string", example="100 BAM", description="Price of the car"),
  *                 @OA\Property(property="age", type="integer", example=2, description="Age of the car"),
  *                 @OA\Property(property="mileage", type="string", example="50000 km", description="Mileage of the car"),
  *                 @OA\Property(property="fuel", type="string", example="Diesel", description="Fuel type of the car"),
  *                 @OA\Property(property="fuel_usage", type="string", example="5.5 L/100 km", description="Fuel usage of the car"),
  *                 @OA\Property(property="gearbox", type="string", example="Automatic", description="Gearbox type of the car"),
  *                 @OA\Property(property="max_passengers", type="integer", example=5, description="Maximum passengers"),
  *                 @OA\Property(property="car_type", type="string", example="hatchback", description="Type of the car")
  *             )
  *         )
  *     ),
  *     @OA\Response(response="200", description="Car info added successfully")
  * )
  */

  // carinforoutes.php
Flight::route('POST /carinfo', function(){
  $data = Flight::request()->data->getData();
  Flight::carinfoService()->add($data);
  Flight::json(['message' => 'Car added successfully']);
});

/**
 * @OA\Put(path="/carinfo/{id}", tags={"car info"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Car ID"),
 *     @OA\RequestBody(description="Car info to update", required=true,
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="car_name", type="string", example="Golf 7", description="Name of the car"),
 *                 @OA\Property(property="price", type="string", example="100 BAM", description="Price of the car"),
 *                 @OA\Property(property="age", type="integer", example=2, description="Age of the car"),
 *                 @OA\Property(property="mileage", type="string", example="50000 km", description="Mileage of the car"),
 *                 @OA\Property(property="fuel", type="string", example="Diesel", description="Fuel type of the car"),
 *                 @OA\Property(property="fuel_usage", type="string", example="5.5 L/100 km", description="Fuel usage of the car"),
 *                 @OA\Property(property="gearbox", type="string", example="Automatic", description="Gearbox type of the car"),
 *                 @OA\Property(property="max_passengers", type="integer", example=5, description="Maximum passengers"),
 *                 @OA\Property(property="car_type", type="string", example="hatchback", description="Type of the car")
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="Car info updated successfully")
 * )
 */
Flight::route('PUT /carinfo/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::carinfoService()->update($data, $id);
  Flight::json(['message' => 'Car updated successfully']);
});

/**
* @OA\Delete(path="/carinfo/{id}", tags={"car info"}, security={{"ApiKeyAuth": {}}},
*     @OA\Parameter(in="path", name="id", example=1, description="Car ID"),
*     @OA\Response(response="200", description="Car deleted successfully")
* )
*/
Flight::route('DELETE /carinfo/@id', function($id){
  Flight::carinfoService()->delete($id);
  Flight::json(['message' => 'Car deleted successfully']);
});



?>
