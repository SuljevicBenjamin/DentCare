<?php
/**
 * @OA\Get(
 *     path="/pricing-plans",
 *     tags={"Pricing Plans"},
 *     summary="Get all pricing plans",
 *     description="Retrieve a list of all pricing plans",
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved pricing plans",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/PricingPlan")
 *         )
 *     )
 * )
 */
Flight::route('GET /pricing-plans', function(){
    Flight::json(Flight::pricingPlansService()->getAllPricingPlans());
}); 

/**
 * @OA\Get(
 *     path="/pricing-plans/{id}",
 *     tags={"Pricing Plans"},
 *     summary="Get pricing plan by ID",
 *     description="Retrieve a specific pricing plan by its ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Pricing plan ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved pricing plan",
 *         @OA\JsonContent(ref="#/components/schemas/PricingPlan")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pricing plan not found"
 *     )
 * )
 */
Flight::route('GET /pricing-plans/@id', function($id){
    Flight::json(Flight::pricingPlansService()->getPricingPlanById($id));
}); 

/**
 * @OA\Post(
 *     path="/pricing-plans",
 *     tags={"Pricing Plans"},
 *     summary="Create a new pricing plan",
 *     description="Create a new pricing plan",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/PricingPlanInput")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pricing plan created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/PricingPlan")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('POST /pricing-plans', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::pricingPlansService()->addPricingPlan($data));
});  

/**
 * @OA\Put(
 *     path="/pricing-plans/{id}",
 *     tags={"Pricing Plans"},
 *     summary="Update a pricing plan",
 *     description="Update an existing pricing plan",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Pricing plan ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/PricingPlanInput")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pricing plan updated successfully",
 *         @OA\JsonContent(ref="#/components/schemas/PricingPlan")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pricing plan not found"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('PUT /pricing-plans/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::pricingPlansService()->updatePricingPlan($id, $data));
});   

/**
 * @OA\Delete(
 *     path="/pricing-plans/{id}",
 *     tags={"Pricing Plans"},
 *     summary="Delete a pricing plan",
 *     description="Delete a pricing plan by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Pricing plan ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pricing plan deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Pricing plan deleted successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pricing plan not found"
 *     )
 * )
 */
Flight::route('DELETE /pricing-plans/@id', function($id){
    Flight::pricingPlansService()->deletePricingPlan($id);
    Flight::json(['message' => "Pricing plan deleted successfully"]);
});   

/**
 * @OA\Schema(
 *     schema="PricingPlan",
 *     type="object",
 *     @OA\Property(property="plan_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Basic Care"),
 *     @OA\Property(property="price", type="number", format="float", example=29.99),
 *     @OA\Property(property="duration_months", type="integer", example=1)
 * )
 * 
 * @OA\Schema(
 *     schema="PricingPlanInput",
 *     type="object",
 *     required={"name", "price", "duration_months"},
 *     @OA\Property(property="name", type="string", example="Basic Care"),
 *     @OA\Property(property="price", type="number", format="float", example=29.99),
 *     @OA\Property(property="duration_months", type="integer", example=1)
 * )
 */
?>
