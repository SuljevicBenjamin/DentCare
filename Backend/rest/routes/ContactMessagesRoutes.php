<?php
/**
 * @OA\Get(
 *     path="/contact-messages",
 *     tags={"Contact Messages"},
 *     summary="Get all contact messages",
 *     description="Retrieve a list of all contact messages",
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved contact messages"
 *     )
 * )
 */
Flight::route('GET /contact-messages', function(){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::contactMessagesService()->getAllContactMessages());
}); 

/**
 * @OA\Get(
 *     path="/contact-messages/{id}",
 *     tags={"Contact Messages"},
 *     summary="Get contact message by ID",
 *     description="Retrieve a specific contact message by its ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Contact message ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved contact message"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Contact message not found"
 *     )
 * )
 */
Flight::route('GET /contact-messages/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::contactMessagesService()->getContactMessageById($id));
}); 

/**
 * @OA\Post(
 *     path="/contact-messages",
 *     tags={"Contact Messages"},
 *     summary="Create a new contact message",
 *     description="Create a new contact message",
 *     @OA\RequestBody(
 *         required=true,
 * @OA\JsonContent(
 *             required={"user_id", "name", "email", "subject", "message"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="Pero Peric"),
 *             @OA\Property(property="email", type="string", example="pero.peric@example.com"),
 *             @OA\Property(property="subject", type="string", example="Subject"),
 *             @OA\Property(property="message", type="string", example="Message")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Contact message created successfully"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('POST /contact-messages', function(){
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::contactMessagesService()->addContactMessage($data));
});  

/**
 * @OA\Put(
 *     path="/contact-messages/{id}",
 *     tags={"Contact Messages"},
 *     summary="Update a contact message",
 *     description="Update an existing contact message",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Contact message ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 * @OA\JsonContent(
 *             required={"user_id", "name", "email", "subject", "message"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="Pero Peric"),
 *             @OA\Property(property="email", type="string", example="pero.peric@example.com"),
 *             @OA\Property(property="subject", type="string", example="Subject"),
 *             @OA\Property(property="message", type="string", example="Message")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Contact message updated successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Contact message not found"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('PUT /contact-messages/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::contactMessagesService()->updateContactMessage($id, $data));
});   

/**
 * @OA\Delete(
 *     path="/contact-messages/{id}",
 *     tags={"Contact Messages"},
 *     summary="Delete a contact message",
 *     description="Delete a contact message by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Contact message ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Contact message deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Contact message deleted successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Contact message not found"
 *     )
 * )
 */
Flight::route('DELETE /contact-messages/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::contactMessagesService()->deleteContactMessage($id);
    Flight::json(['message' => "Contact message deleted successfully"]);
});   


?>
