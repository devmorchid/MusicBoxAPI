<?php

namespace App\Http\Controllers;

/**
 
*@OA\Info(
*version="1.0.0",
*title="Music Box API Documentation",
*description="API for managing Artists, Albums, and Songs, protected by Sanctum.",
*@OA\Contact(
*email="support@musicbox.com"
*)
*)*
*@OA\Server(
*url=L5_SWAGGER_CONST_HOST,
*description="Music Box API Server"
*)*
*@OA\SecurityScheme(
*securityScheme="bearerAuth",
*in="header",
*name="Bearer Token Authentication",
*type="http",
*scheme="Bearer",
*bearerFormat="Passport/Sanctum Token",
*)*/
class swagger extends Controller
{
    // This class is just for the annotations and doesn't need methods.
}
