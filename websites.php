<?php
// Inkluderar filen config.php
include("includes/config.php");

// Sätter header för innehållstyp JSON, tillåter diverse metoder för att hantera data i databasen, och gör tjänsten åtkomlig från andra platser
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

// Skapar en ny instans av klassen Websites
$Websites = new Websites();


// Kollar om ID är satt som GET-parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

// Lagrar vilken metod som sidan anropas med
$method = $_SERVER['REQUEST_METHOD'];

// Switch case beroende på vilken metod som anroped gjordes med
switch ($method) {
    // Ifall det är metoden GET hämtas webbplatser via klassen Websites
    case "GET":
        if (count($Websites->getWebsites()) > 0) {
            $result = $Websites->getWebsites();
        } else {
            $result = array("message" => "No websites found.");
        }
        break;
        // Ifall det är metoden POST läser den med indata från anropet, vad som skickas med själva anropet alltså.
    case "POST":
        // I variabeln input lagras indatan, och görs om från JSON till objekt
        $input = json_decode(file_get_contents('php://input'));
        $result = $input;
        // Anropar en funktion i klassen för att skapa ett nytt inlägg.
        if ($Websites->addWebsite($input->websitetitle, $input->websiteurl, $input->description)) {
            http_response_code(201);
            $result = array("message" => "Website added.");
        } else {
            http_response_code(503);
            $result = array("message" => "Website could not be added.");
        }
        break;
        // Metod för att ta bort webbplatser
    case "DELETE":
        // Kollar om ett id är medskickat
        if (!isset($id)) {
            $result = array("message" => "No id has been specified.");
        } else {
            // Är ett ID medskickat så görs ett försök genom en funktion i klassen att ta bort webbplatsen.
            if ($Websites->deleteWebsite($id)) {
                http_response_code(200);
                $result = array("message" => "Website deleted.");
            } else {
                http_response_code(503);
                $result = array("message" => "Website could not be deleted.");
            }
        }
        break;
        // Metod för att redigera webbplatser
    case "PUT":
        // Läser in indata och lagrar i input
        $input = json_decode(file_get_contents('php://input'));
        // Använder funktion i klassen för att uppdatera webbplatsen
        if ($Websites->updateWebsite($id, $input->websitetitle, $input->websiteurl, $input->description)) {
            http_response_code(200);
            $result = array("message" => "Website updated.");
        } else {
            http_response_code(503);
            $result = array("message" => "Website could not be updated.");
        }
        break;
}
// Skickar ut ett svar i JSON-format, som låter en veta ifall ens anrop lyckats eller misslyckats.
echo json_encode($result);
