<?php
/**
 * @OA\Get(path="/carinfo", tags={"car info"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return car information. ",
 *         @OA\Response( response=200, description="List of car details.")
 * )
 */

Flight::route('GET /carinfo', function(){
    Flight::json(Flight::carinfoService()->get_all());
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
  


?>
