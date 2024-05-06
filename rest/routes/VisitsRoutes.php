<?php
/**
 * @OA\Get(path="/visitors", tags={"visits"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return number of visits per year and per gender from the API. ",
 *         @OA\Response( response=200, description="List of all visits.")
 * )
 */

Flight::route('GET /visitors', function(){
  Flight::json(Flight::visitsService()->get_all());
});


 
?>
