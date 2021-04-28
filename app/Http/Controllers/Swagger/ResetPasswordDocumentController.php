<?php

/**
 * @OA\Post(
 *      path="/api/request-new-password",
 *      summary="Request Password",
 *      description="Solicitar una peticion para cambiar la password en caso de olvidarla",
 *      operationId="authRequestPassword",
 *      tags={"reset-password"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Generar token para cambio de contraseña",
 *          @OA\JsonContent(
 *              required={"email"},
 *              @OA\Property(property="email", type="string", format="email", example="juan_alucard@hotmail.com")
 *          ),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Modelo Email no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Este email no se encuentra registrado")
 *          )
 *     )
 * )
 */

 /**
 * @OA\Post(
 *      path="/api/reset-password",
 *      summary="Change Password",
 *      description="Validar la peticion de cambio de contraseña",
 *      operationId="authResetPassword",
 *      tags={"reset-password"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Cambiar la contraseña por la solicitada",
 *          @OA\JsonContent(
 *              required={"token","email","password","password_confirmation"},
 *              @OA\Property(property="token", type="string", example="dfgtb456RTBT67"),
 *              @OA\Property(property="email", type="string", format="email", example="juan_alucard@hotmail.com"),
 *              @OA\Property(property="password", type="string", format="password", example="test123"),
 *              @OA\Property(property="password_confirmation", type="string", format="password", example="test123"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Modelo Email no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Este email no se encuentra registrado")
 *          )
 *      ),
 *      @OA\Response(
 *          response=405,
 *          description="Token Expiration",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Este token ya expiró, favor de solicitar otro")
 *          )
 *      ),
 *      @OA\Response(
 *          response=403,
 *          description="Unauthorize",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Este usuario no solicito cambio de contraseña")
 *          )
 *      )
 * )
 */


