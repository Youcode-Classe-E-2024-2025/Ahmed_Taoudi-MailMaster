<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *     title="MailMasterAPI",
 *     version="1.0",
 *     description="API for managing compaign"
 * )
 * 
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     required={"id", "name", "email", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-23T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-03-23T12:34:56Z")
 * )
 */

class swagger {}
