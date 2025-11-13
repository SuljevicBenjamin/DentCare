<?php
/**
 * @OA\Get(
 *     path="/services",
 *     tags={"Services"},
 *     summary="Get all dental services",
 *     description="Retrieve a list of all dental services",
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved services"
 *     )
 * )
 */
Flight::route('GET /services', function(){
    Flight::json(Flight::servicesService()->getAllServices());
}); 

/**
 * @OA\Get(
 *     path="/services/{id}",
 *     tags={"Services"},
 *     summary="Get service by ID",
 *     description="Retrieve a specific dental service by its ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Service ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved service"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Service not found"
 *     )
 * )
 */
Flight::route('GET /services/@id', function($id){
    Flight::json(Flight::servicesService()->getServiceById($id));
}); 

/**
 * @OA\Get(
 *     path="/services/name/{name}",
 *     tags={"Services"},
 *     summary="Get service by name",
 *     description="Retrieve a dental service by its name",
 *     @OA\Parameter(
 *         name="name",
 *         in="path",
 *         required=true,
 *         description="Service name",
 *         @OA\Schema(type="string", example="Dental Check-up & Filling")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved service"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Service not found"
 *     )
 * )
 */
Flight::route('GET /services/name/@name', function($name){
    Flight::json(Flight::servicesService()->getServiceByName($name));
}); 

/**
 * @OA\Post(
 *     path="/services",
 *     tags={"Services"},
 *     summary="Create a new dental service",
 *     description="Create a new dental service",
 *     @OA\RequestBody(
 *         required=true,
 * @OA\JsonContent(
 *             required={"name", "description", "price"},
 *             @OA\Property(property="name", type="string", example="Dental Check-up & Filling"),
 *             @OA\Property(property="description", type="string", example="Description"),
 *             @OA\Property(property="price", type="float", example=100.00)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Service created successfully"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('POST /services', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::servicesService()->addService($data));
});  

/**
 * @OA\Put(
 *     path="/services/{id}",
 *     tags={"Services"},
 *     summary="Update a dental service",
 *     description="Update an existing dental service",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Service ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 * @OA\JsonContent(
 *             required={"name", "description", "price"},
 *             @OA\Property(property="name", type="string", example="Dental Check-up & Filling"),
 *             @OA\Property(property="description", type="string", example="Description"),
 *             @OA\Property(property="price", type="float", example=100.00)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Service updated successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Service not found"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('PUT /services/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::servicesService()->updateService($id, $data));
});   

/**
 * @OA\Delete(
 *     path="/services/{id}",
 *     tags={"Services"},
 *     summary="Delete a dental service",
 *     description="Delete a dental service by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Service ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Service deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Service deleted successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Service not found"
 *     )
 * )
 */
Flight::route('DELETE /services/@id', function($id){
    Flight::servicesService()->deleteService($id);
    Flight::json(['message' => "Service deleted successfully"]);
});   


?>
