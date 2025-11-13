<?php
/**
 * @OA\Get(
 *     path="/appointments",
 *     tags={"Appointments"},
 *     summary="Get all appointments",
 *     description="Retrieve a list of all appointments",
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved appointments"
 *     )
 * )
 */
Flight::route('GET /appointments', function(){
    Flight::json(Flight::appointmentsService()->getAllAppointments());
}); 

/**
 * @OA\Get(
 *     path="/appointments/{id}",
 *     tags={"Appointments"},
 *     summary="Get appointment by ID",
 *     description="Retrieve a specific appointment by its ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Appointment ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved appointment"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Appointment not found"
 *     )
 * )
 */
Flight::route('GET /appointments/@id', function($id){
    Flight::json(Flight::appointmentsService()->getAppointmentById($id));
}); 

/**
 * @OA\Get(
 *     path="/appointments/user/{user_id}",
 *     tags={"Appointments"},
 *     summary="Get appointments by user",
 *     description="Retrieve all appointments for a specific user",
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved appointments"
 *     )
 * )
 */
Flight::route('GET /appointments/user/@user_id', function($user_id){
    Flight::json(Flight::appointmentsService()->getAppointmentsByUser($user_id));
}); 

/**
 * @OA\Get(
 *     path="/appointments/dentist/{dentist_id}/date/{date}",
 *     tags={"Appointments"},
 *     summary="Get appointments by dentist and date",
 *     description="Retrieve all appointments for a specific dentist on a specific date",
 *     @OA\Parameter(
 *         name="dentist_id",
 *         in="path",
 *         required=true,
 *         description="Dentist ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="date",
 *         in="path",
 *         required=true,
 *         description="Appointment date (YYYY-MM-DD)",
 *         @OA\Schema(type="string", format="date")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved appointments"
 *     )
 * )
 */
Flight::route('GET /appointments/dentist/@dentist_id/date/@date', function($dentist_id, $date){
    Flight::json(Flight::appointmentsService()->getAppointmentsByDentistAndDate($dentist_id, $date));
}); 

/**
 * @OA\Post(
 *     path="/appointments",
 *     tags={"Appointments"},
 *     summary="Create a new appointment",
 *     description="Create a new appointment",
 *     @OA\RequestBody(
 *         required=true,
 * @OA\JsonContent(
*             required={"user_id", "dentist_id", "service_id", "appointment_date", "appointment_time", "status", "notes"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="dentist_id", type="integer", example=1),
 *             @OA\Property(property="service_id", type="integer", example=1),
 *             @OA\Property(property="appointment_date", type="string", example="2025-11-13"),
 *             @OA\Property(property="appointment_time", type="string", example="10:00:00"),
 *             @OA\Property(property="status", type="string", example="scheduled"),
 *             @OA\Property(property="notes", type="string", example="No notes")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Appointment created successfully"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('POST /appointments', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::appointmentsService()->addAppointment($data));
});  

/**
 * @OA\Put(
 *     path="/appointments/{id}",
 *     tags={"Appointments"},
 *     summary="Update an appointment",
 *     description="Update an existing appointment",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Appointment ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 * @OA\JsonContent(
 *             required={"user_id", "dentist_id", "service_id", "appointment_date", "appointment_time", "status", "notes"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="dentist_id", type="integer", example=1),
 *             @OA\Property(property="service_id", type="integer", example=1),
 *             @OA\Property(property="appointment_date", type="string", example="2025-11-13"),
 *             @OA\Property(property="appointment_time", type="string", example="10:00:00"),
 *             @OA\Property(property="status", type="string", example="scheduled"),
 *             @OA\Property(property="notes", type="string", example="No notes")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Appointment updated successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Appointment not found"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('PUT /appointments/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::appointmentsService()->updateAppointment($id, $data));
});   

/**
 * @OA\Delete(
 *     path="/appointments/{id}",
 *     tags={"Appointments"},
 *     summary="Delete an appointment",
 *     description="Delete an appointment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Appointment ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Appointment deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Appointment deleted successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Appointment not found"
 *     )
 * )
 */
Flight::route('DELETE /appointments/@id', function($id){
    Flight::appointmentsService()->deleteAppointment($id);
    Flight::json(['message' => "Appointment deleted successfully"]);
});   


?>
