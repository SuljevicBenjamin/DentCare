<?php
/**
 * @OA\Get(
 *     path="/users",
 *     tags={"Users"},
 *     summary="Get all users",
 *     description="Retrieve a list of all users (passwords are excluded from response)",
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved users"
 *     )
 * )
 */
Flight::route('GET /users', function(){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::usersService()->getAllUsers());
}); 

/**
 * @OA\Get(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Get user by ID",
 *     description="Retrieve a specific user by its ID (password is excluded from response)",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved user"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 */
Flight::route('GET /users/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::usersService()->getUserById($id));
}); 

/**
 * @OA\Get(
 *     path="/users/email/{email}",
 *     tags={"Users"},
 *     summary="Get user by email",
 *     description="Retrieve a user by email address",
 *     @OA\Parameter(
 *         name="email",
 *         in="path",
 *         required=true,
 *         description="User email address",
 *         @OA\Schema(type="string", format="email", example="user@example.com")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved user"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 */
Flight::route('GET /users/email/@email', function($email){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::usersService()->getUserByEmail($email));
}); 

/**
 * @OA\Post(
 *     path="/users",
 *     tags={"Users"},
 *     summary="Create a new user",
 *     description="Create a new user (password is automatically hashed and excluded from response)",
 *     @OA\RequestBody(
 *         required=true,
 * @OA\JsonContent(
 *             required={"full_name", "email", "password", "role"},
 *             @OA\Property(property="full_name", type="string", example="Pero Peric"),
 *             @OA\Property(property="email", type="string", example="pero.peric@example.com"),
 *             @OA\Property(property="password", type="string", example="password"),
 *             @OA\Property(property="role", type="string", example="user")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User created successfully"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('POST /users', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::usersService()->addUser($data));
});  

/**
 * @OA\Put(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Update a user",
 *     description="Update an existing user (password will be hashed if provided and excluded from response)",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 * @OA\JsonContent(
 *             required={"full_name", "email", "password", "role"},
 *             @OA\Property(property="full_name", type="string", example="Pero Peric"),
 *             @OA\Property(property="email", type="string", example="pero.peric@example.com"),
 *             @OA\Property(property="password", type="string", example="password"),
 *             @OA\Property(property="role", type="string", example="user")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('PUT /users/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::usersService()->updateUser($id, $data));
});   

/**
 * @OA\Delete(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Delete a user",
 *     description="Delete a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="User deleted successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 */
Flight::route('DELETE /users/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::usersService()->deleteUser($id);
    Flight::json(['message' => "User deleted successfully"]);
});   


?>
