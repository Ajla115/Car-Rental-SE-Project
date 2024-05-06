<?php
/**
 * @OA\Get(path="/locations", tags={"locations"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all locations from the API. ",
 *         @OA\Response( response=200, description="List of locations.")
 * )
 */

//works
//get all information about all locations
Flight::route('GET /locations', function () {
    Flight::json(Flight::locationService()->get_all());
});


 /**
* @OA\Post(
*     path="/locations", security={{"ApiKeyAuth": {}}},
*     description="Add location",
*     tags={"locations"},
*     @OA\RequestBody(description="Add new location", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name_point", type="string", example="MD Sarajevo",	description="Location's name"),
*    				@OA\Property(property="address", type="string", example="Halilovici 13",	description="Location's address" ),
*                   @OA\Property(property="town", type="string", example="Sarajevo",	description="Location's town" ),
*                   @OA\Property(property="email", type="string", example="mds@gmail.com",	description="Location's email" ),
*                   @OA\Property(property="phone", type="int", example="62421745",	description="Location's phone" ),                      
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Location has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/


//works
//add a new location
Flight::route('POST /locations', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::locationService()->add($data));
});


 /**
 * @OA\Delete(
 *     path="/locations/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete location",
 *     tags={"locations"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Location ID"),
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
Flight::route('DELETE /locations/@id', function ($id) {
    Flight::locationService()->delete($id);
});


 /**
  * @OA\Get(path="/locations/{id}", tags={"locations"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="id", example=1, description="Location ID"),
  *     @OA\Response(response="200", description="Fetch individual location")
  * )
  */
//works
Flight::route('GET /locations/@id', function ($id) {
    Flight::json(Flight::locationService()->get_by_id($id));
});


/**
 * @OA\Put(
 *     path="/locations/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Edit location",
 *     tags={"locations"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Location ID"),
 *     @OA\RequestBody(description="Location info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="name_point", type="string", example="MD Sarajevo",	description="Location's name"),
*    				@OA\Property(property="address", type="string", example="Halilovici 13",	description="Location's address" ),
*                   @OA\Property(property="town", type="string", example="Sarajevo",	description="Location's town" ),
*                   @OA\Property(property="email", type="string", example="mds@gmail.com",	description="Location's email" ),
*                   @OA\Property(property="phone", type="int", example="62421745",	description="Location's phone" ),
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Locations has been edited"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */

//works
Flight::route("PUT /locations/@id", function($id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Location edited succesfully', 'data' => Flight::locationService()->update($data, $id)]); 
    //-> converts the results to the JSON form
    //This array we could have created above, store it in a variable, and then call that variable or do it directly like this
});

?>
