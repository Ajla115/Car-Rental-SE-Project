<?php
use Firebase\JWT\JWT;

/**
 * @OA\Get(path="/customers", tags={"customers"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all customers from the API. ",
 *         @OA\Response( response=200, description="List of customers.")
 * )
 */

//ako ne zelim da pise authorizacija kod ovih routes u swaggeru, onda trebam izbaciti ovo security={{"ApiKeyAuth": {}}},

//works
//get all customers from database
Flight::route('GET /customers', function () {
    Flight::json(Flight::customerService()->get_all());
});


/**
 * @OA\Get(path="/customers/{id}", tags={"customers"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Customer ID"),
 *     @OA\Response(response="200", description="Fetch individual customer")
 * )
 */

//works
//get all information regarding one customer based upon its id as a parameter
Flight::route('GET /customers/@id', function ($id) {
    Flight::json(Flight::customerService()->get_by_id($id));
});



/**
 * @OA\Post(
 *     path="/customer", security={{"ApiKeyAuth": {}}},
 *     description="Add customer",
 *     tags={"customers"},
 *     @OA\RequestBody(description="Add new customer", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="customer_name", type="string", example="Demo",	description="Customer first name"),
 *    				@OA\Property(property="customer_surname", type="string", example="Customer",	description="Customer last name" ),
 *                   @OA\Property(property="email", type="string", example="demo@gmail.com",	description="Customer email" ),
 *                   @OA\Property(property="password", type="string", example="12345",	description="Password" ),
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Customer has been added"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */

//works
//add a new customer to the database
Flight::route('POST /customer', function () {
    $data = Flight::request()->data->getData();

    Flight::json(Flight::customerService()->add($data));

    // Add the customer to the database
    // $customer = Flight::customerService()->add($data);
    // unset($customer['password']);

    // // Generate the JWT token
    // $jwt = JWT::encode($customer, Config::JWT_SECRET(), 'HS256');

    // // Return the JWT token in the response
    // Flight::json(['token' => $jwt, 'customer' => $customer]);
});




/**
 * @OA\Put(
 *     path="/customers/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Edit customer",
 *     tags={"customers"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Customer ID"),
 *     @OA\RequestBody(description="Customer info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="customer_name", type="string", example="Demo",	description="Customer first name"),
 *    				@OA\Property(property="customer_surname", type="string", example="Customer",	description="Customer last name" ),
 *                  @OA\Property(property="email", type="string", example="demo@gmail.com",	description="Customer email" ),
 *                  @OA\Property(property="password", type="string", example="12345",	description="Password" ),
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Customer has been edited"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */

//works
//update an existing customer based upon its id as a parameter
Flight::route("PUT /customers/@id", function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Customer edited succesfully', 'data' => Flight::customerService()->update($data, $id)]);
    //-> converts the results to the JSON form
    //This array we could have created above, store it in a variable, and then call that variable or do it directly like this
});

/**
 * @OA\Delete(
 *     path="/customers/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete customer",
 *     tags={"customers"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Customer ID"),
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
//delete one customer based upon its id as a parameter
/*
Flight::route('DELETE /customers/@id', function ($id) {
    Flight::customerService()->delete($id);
});*/
Flight::route('DELETE /customers/@id', function ($id) {
    try {
        Flight::customerService()->delete($id);
        Flight::json(['message' => 'Customer deleted successfully']);
    } catch (Exception $e) {
        error_log($e->getMessage());
        Flight::halt(500, 'Internal Server Error');
    }
});


/**
 * @OA\Post(
 *     path="/login", 
 *     description="Login",
 *     tags={"login"},
 *     @OA\RequestBody(description="Login", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *             @OA\Property(property="email", type="string", example="demo@gmail.com",	description="User email" ),
 *             @OA\Property(property="password", type="string", example="12345",	description="Password" ),
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Logged in successfuly"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */
Flight::route('POST /login', function () {

    $data = Flight::request()->data->getData();
    $response = Flight::customerService()->login($data);
    Flight::json($response);
});


//login goes without authentication on swagger


//Custom update based on data (first name, last name and email) from frontend
/**
 * @OA\Put(
 *     path="/customers/", security={{"ApiKeyAuth": {}}},
 *     description="Edit customer",
 *     tags={"customers"},
 *     @OA\RequestBody(description="Customer info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="customer_name", type="string", example="Demo",	description="Customer first name"),
 *    				@OA\Property(property="customer_surname", type="string", example="Customer",	description="Customer last name" ),
 *                  @OA\Property(property="email", type="string", example="demo@gmail.com",	description="Customer email" )
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Customer has been edited"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */



Flight::route("PUT /updatesinglecustomer", function () {
    $data = Flight::request()->data->getData();
    Flight::json(['message' => 'Customer edited succesfully', 'data' => Flight::customerService()->customUpdate($data)]);
    //-> converts the results to the JSON form
    //This array we could have created above, store it in a variable, and then call that variable or do it directly like this
});