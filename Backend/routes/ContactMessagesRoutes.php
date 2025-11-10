<?php
/**
 * @OA\Get(
 *     path="/contact-messages",
 *     tags={"Contact Messages"},
 *     summary="Get all contact messages",
 *     description="Retrieve a list of all contact messages",
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved contact messages",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/ContactMessage")
 *         )
 *     )
 * )
 */
Flight::route('GET /contact-messages', function(){
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
 *         description="Successfully retrieved contact message",
 *         @OA\JsonContent(ref="#/components/schemas/ContactMessage")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Contact message not found"
 *     )
 * )
 */
Flight::route('GET /contact-messages/@id', function($id){
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
 *         @OA\JsonContent(ref="#/components/schemas/ContactMessageInput")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Contact message created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/ContactMessage")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('POST /contact-messages', function(){
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
 *         @OA\JsonContent(ref="#/components/schemas/ContactMessageInput")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Contact message updated successfully",
 *         @OA\JsonContent(ref="#/components/schemas/ContactMessage")
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
    Flight::contactMessagesService()->deleteContactMessage($id);
    Flight::json(['message' => "Contact message deleted successfully"]);
});   

/**
 * @OA\Schema(
 *     schema="ContactMessage",
 *     type="object",
 *     @OA\Property(property="message_id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", nullable=true, example=2),
 *     @OA\Property(property="name", type="string", example="Amina Hadzic"),
 *     @OA\Property(property="email", type="string", format="email", example="amina@example.com"),
 *     @OA\Property(property="subject", type="string", nullable=true, example="Question about services"),
 *     @OA\Property(property="message", type="string", example="Could you explain more about the whitening process?"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-11-02T00:23:53+00:00")
 * )
 * 
 * @OA\Schema(
 *     schema="ContactMessageInput",
 *     type="object",
 *     required={"name", "email", "message"},
 *     @OA\Property(property="user_id", type="integer", nullable=true, example=2),
 *     @OA\Property(property="name", type="string", example="Amina Hadzic"),
 *     @OA\Property(property="email", type="string", format="email", example="amina@example.com"),
 *     @OA\Property(property="subject", type="string", nullable=true, example="Question about services"),
 *     @OA\Property(property="message", type="string", example="Could you explain more about the whitening process?")
 * )
 */
?>
