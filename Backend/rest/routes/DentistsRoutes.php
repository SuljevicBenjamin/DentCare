<?php
/**
 * @OA\Get(
 *     path="/dentists",
 *     tags={"Dentists"},
 *     summary="Get all dentists",
 *     description="Retrieve a list of all dentists",
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved dentists",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Dentist")
 *         )
 *     )
 * )
 */
Flight::route('GET /dentists', function(){
    Flight::json(Flight::dentistsService()->getAllDentists());
}); 

/**
 * @OA\Get(
 *     path="/dentists/{id}",
 *     tags={"Dentists"},
 *     summary="Get dentist by ID",
 *     description="Retrieve a specific dentist by its ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Dentist ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved dentist",
 *         @OA\JsonContent(ref="#/components/schemas/Dentist")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Dentist not found"
 *     )
 * )
 */
Flight::route('GET /dentists/@id', function($id){
    Flight::json(Flight::dentistsService()->getDentistById($id));
}); 

/**
 * @OA\Get(
 *     path="/dentists/specialization/{specialization}",
 *     tags={"Dentists"},
 *     summary="Get dentists by specialization",
 *     description="Retrieve all dentists with a specific specialization",
 *     @OA\Parameter(
 *         name="specialization",
 *         in="path",
 *         required=true,
 *         description="Dentist specialization",
 *         @OA\Schema(type="string", example="General Dentist")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved dentists",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Dentist")
 *         )
 *     )
 * )
 */
Flight::route('GET /dentists/specialization/@specialization', function($specialization){
    Flight::json(Flight::dentistsService()->getDentistsBySpecialization($specialization));
}); 

/**
 * @OA\Post(
 *     path="/dentists",
 *     tags={"Dentists"},
 *     summary="Create a new dentist",
 *     description="Create a new dentist",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/DentistInput")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Dentist created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Dentist")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('POST /dentists', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::dentistsService()->addDentist($data));
});  

/**
 * @OA\Put(
 *     path="/dentists/{id}",
 *     tags={"Dentists"},
 *     summary="Update a dentist",
 *     description="Update an existing dentist",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Dentist ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/DentistInput")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Dentist updated successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Dentist")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Dentist not found"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('PUT /dentists/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::dentistsService()->updateDentist($id, $data));
});   

/**
 * @OA\Delete(
 *     path="/dentists/{id}",
 *     tags={"Dentists"},
 *     summary="Delete a dentist",
 *     description="Delete a dentist by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Dentist ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Dentist deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Dentist deleted successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Dentist not found"
 *     )
 * )
 */
Flight::route('DELETE /dentists/@id', function($id){
    Flight::dentistsService()->deleteDentist($id);
    Flight::json(['message' => "Dentist deleted successfully"]);
});   

/**
 * @OA\Schema(
 *     schema="Dentist",
 *     type="object",
 *     @OA\Property(property="dentist_id", type="integer", example=1),
 *     @OA\Property(property="full_name", type="string", example="Dr. Dino Dinic"),
 *     @OA\Property(property="specialization", type="string", nullable=true, example="General Dentist")
 * )
 * 
 * @OA\Schema(
 *     schema="DentistInput",
 *     type="object",
 *     required={"full_name"},
 *     @OA\Property(property="full_name", type="string", example="Dr. Dino Dinic"),
 *     @OA\Property(property="specialization", type="string", nullable=true, example="General Dentist")
 * )
 */
?>
