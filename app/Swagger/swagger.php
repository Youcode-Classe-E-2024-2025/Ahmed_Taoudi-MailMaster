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
 * 
 * @OA\Schema(
 *     schema="Subscriber",
 *     type="object",
 *     required={"email"},
 *     @OA\Property(property="id", type="integer", description="The unique ID of the subscriber"),
 *     @OA\Property(property="email", type="string", description="The subscriber's email"),
 *     @OA\Property(property="name", type="string", description="The subscriber's name", nullable=true),
 *     @OA\Property(property="status", type="boolean", description="The subscription status")
 * )
 * 
 * @OA\Schema(
 *     schema="SubscriberRequest",
 *     type="object",
 *     required={"email"},
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="The email address of the subscriber",
 *         example="subscriber@example.com"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the subscriber",
 *         example="John Doe",
 *         nullable=true
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="boolean",
 *         description="Subscription status",
 *         example=true
 *     )
 * )
 * 
 * @OA\Schema(
 *     schema="SubscriberRequestUpdate",
 *     type="object",
 *     required={"status"},  
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="The email address of the subscriber (cannot be changed during update)",
 *         example="subscriber@example.com",
 *         nullable=true
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the subscriber",
 *         example="John Doe",
 *         nullable=true
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="boolean",
 *         description="Subscription status (active or inactive)",
 *         example=true
 *     )
 * )
 * 
 * 
 * * @OA\Schema(
 *     schema="NewsletterRequest",
 *     type="object",
 *     required={"title", "content", "status"},
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="The title of the newsletter",
 *         example="Monthly Updates"
 *     ),
 *     @OA\Property(
 *         property="content",
 *         type="string",
 *         description="The content of the newsletter",
 *         example="Here are the updates for this month..."
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         enum={"brouillon", "envoyée", "planifiée"},
 *         description="The status of the newsletter",
 *         example="planifiée"
 *     )
 * )
 * 
 * 
 * 
 * * @OA\Schema(
 *     schema="Newsletter",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The unique ID of the newsletter",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="integer",
 *         description="The ID of the user who created the newsletter",
 *         example=2
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="The title of the newsletter",
 *         example="Monthly Updates"
 *     ),
 *     @OA\Property(
 *         property="content",
 *         type="string",
 *         description="The content of the newsletter",
 *         example="Here are the updates for this month..."
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         description="The status of the newsletter",
 *         example="planifiée"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp of when the newsletter was created",
 *         example="2025-04-07T12:34:56"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp of the last time the newsletter was updated",
 *         example="2025-04-07T12:34:56"
 *     )
 * )
 */

class swagger {}
