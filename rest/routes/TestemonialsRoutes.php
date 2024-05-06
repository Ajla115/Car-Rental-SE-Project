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



?>
