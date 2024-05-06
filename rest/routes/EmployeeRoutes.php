<?php

/**
 * @OA\Get(path="/employees", tags={"employees"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all employees from the API. ",
 *         @OA\Response( response=200, description="List of employees.")
 * )
 */

//works
//get all employees from database
Flight::route('GET /employees', function () {
    Flight::json(Flight::employeeService()->get_all());
});


 /**
  * @OA\Get(path="/employees/{id}", tags={"employees"}, security={{"ApiKeyAuth": {}}},
  *     @OA\Parameter(in="path", name="id", example=1, description="Employee ID"),
  *     @OA\Response(response="200", description="Fetch individual employees")
  * )
  */


//works
//get all information regarding one employee based upon its id as a parameter
Flight::route('GET /employees/@id', function ($id) {
    Flight::json(Flight::employeeService()->get_by_id($id));
});


/**
* @OA\Post(
*     path="/employees", security={{"ApiKeyAuth": {}}},
*     description="Add employee",
*     tags={"employees"},
*     @OA\RequestBody(description="Add new employee", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="location_id", type="int", example="1",	description="Where employee is working"),
*    				@OA\Property(property="employee_name", type="string", example="Charlie",	description="Employee's first name" ),
*                   @OA\Property(property="employee_surname", type="string", example="Chaplin",	description="Employee's last name" ),
*                   @OA\Property(property="hired_date", type="date", example="2016-05-15",	description="Hired date" ),
*                   @OA\Property(property="birth_date", type="date", example="2000-05-15",	description="Birth date" ),
*                   @OA\Property(property="gender", type="string", example="Male",	description="Gender" ),
*                   @OA\Property(property="email", type="string", example="charliechaplin@gmail.com",	description="Email" ),
*                   @OA\Property(property="salary", type="double", example="3400",	description="Salary" ),
*                   @OA\Property(property="phone_number", type="int", example="62421743",	description="Phone" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Employee has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
//works
//add a new employee to the database
Flight::route('POST /employees', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::employeeService()->add($data));
});

/**
 * @OA\Put(
 *     path="/employees/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Edit employee",
 *     tags={"employees"},
 *     @OA\Parameter(in="path", name="id", example=1, description="employee ID"),
 *     @OA\RequestBody(description="employee info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="location_id", type="int", example="1",	description="Where employee is working"),
*    				@OA\Property(property="employee_name", type="string", example="Charlie",	description="Employee's first name" ),
*                   @OA\Property(property="employee_surname", type="string", example="Chaplin",	description="Employee's last name" ),
*                   @OA\Property(property="hired_date", type="date", example="2016-05-15",	description="Hired date" ),
*                   @OA\Property(property="birth_date", type="date", example="2000-05-15",	description="Birth date" ),
*                   @OA\Property(property="gender", type="string", example="Male",	description="Gender" ),
*                   @OA\Property(property="email", type="string", example="charliechaplin@gmail.com",	description="Email" ),
*                   @OA\Property(property="salary", type="double", example="3400",	description="Salary" ),
*                   @OA\Property(property="phone_number", type="int", example="62421743",	description="Phone" ),
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="employee has been edited"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */


//works
//update current customer based upon its id as a parameter
Flight::route("PUT /employees/@id", function($id){
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Employee edited succesfully', 'data' => Flight::employeeService()->update($data, $id)]); 
    //-> converts the results to the JSON form
    //This array we could have created above, store it in a variable, and then call that variable or do it directly like this
});

 /**
 * @OA\Delete(
 *     path="/employees/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete employee",
 *     tags={"employees"},
 *     @OA\Parameter(in="path", name="id", example=1, description="employee ID"),
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
//delete a current customer based upon its id as a parameter
Flight::route('DELETE /employees/@id', function ($id) {
    Flight::employeeService()->delete($id);
});



?>
