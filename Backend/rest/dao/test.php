<?php
require_once __DIR__ . '/UsersDao.php';
require_once __DIR__ . '/DentistsDao.php';
require_once __DIR__ . '/ServicesDao.php';
require_once __DIR__ . '/AppointmentsDao.php';
require_once __DIR__ . '/PricingPlansDao.php';
require_once __DIR__ . '/ContactMessagesDao.php';


$usersDao = new UsersDao();
$dentistsDao = new DentistsDao();
$servicesDao = new ServicesDao();
$appointmentsDao = new AppointmentsDao();
$pricingPlansDao = new PricingPlansDao();
$contactMessagesDao = new ContactMessagesDao();


function randomEmail($name) {
    return strtolower($name) . rand(1000, 99999) . "@example.com";
}


$user1 = $usersDao->insertUsers([
    'full_name' => 'Benjamin Suljevic',
    'email' => randomEmail('benjamin'),
    'password' => password_hash('pass123', PASSWORD_DEFAULT),
    'role' => 'admin'
]);

$user2 = $usersDao->insertUsers([
    'full_name' => 'Amina Hadzic',
    'email' => randomEmail('amina'),
    'password' => password_hash('amina2025', PASSWORD_DEFAULT),
    'role' => 'user'
]);

$user3 = $usersDao->insertUsers([
    'full_name' => 'Nedim Selimovic',
    'email' => randomEmail('nedim'),
    'password' => password_hash('nedim321', PASSWORD_DEFAULT),
    'role' => 'user'
]);


$dentist1 = $dentistsDao->insertDentists([
    'full_name' => 'Dr. Dino Dinic',
    'specialization' => 'General Dentist'
]);

$dentist2 = $dentistsDao->insertDentists([
    'full_name' => 'Dr. Ana Anic',
    'specialization' => 'Orthodontist'
]);


$service1 = $servicesDao->insertServices([
    'name' => 'Dental Check-up & Filling',
    'description' => 'Comprehensive dental check-up with cavity filling if needed.',
    'price' => 90.00
]);

$service2 = $servicesDao->insertServices([
    'name' => 'Braces / Clear Aligners',
    'description' => 'Orthodontic treatment for teeth alignment using braces or clear aligners.',
    'price' => 1200.00
]);


$plan1 = $pricingPlansDao->insertPricingPlans([
    'name' => 'Basic Care',
    'price' => 29.99,
    'duration_months' => 1
]);

$plan2 = $pricingPlansDao->insertPricingPlans([
    'name' => 'Premium Care',
    'price' => 79.99,
    'duration_months' => 3
]);


$appointment = $appointmentsDao->insertAppointment([
    'user_id' => 2,  // Amina Hadzic
    'dentist_id' => 1, // Dr. Dino Dinic
    'service_id' => 1, // Dental Check-up & Filling
    'appointment_date' => date('Y-m-d', strtotime('+1 day')),
    'appointment_time' => '10:00:00',
    'status' => 'scheduled',
    'notes' => 'First visit'
]);


$message = $contactMessagesDao->insertContactMessages([
    'user_id' => 2,
    'name' => 'Amina Hadzic',
    'email' => randomEmail('amina'),
    'subject' => 'Question about services',
    'message' => 'Do you offer whitening?'
]);


echo "\n--- USERS ---\n";
print_r($usersDao->getAll());

echo "\n--- DENTISTS ---\n";
print_r($dentistsDao->getAll());

echo "\n--- SERVICES ---\n";
print_r($servicesDao->getAll());

echo "\n--- PRICING PLANS ---\n";
print_r($pricingPlansDao->getAll());

echo "\n--- APPOINTMENTS ---\n";
print_r($appointmentsDao->getAll());

echo "\n--- CONTACT MESSAGES ---\n";
print_r($contactMessagesDao->getAll());
?>
 