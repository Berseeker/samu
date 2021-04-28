<?php
/**
 * @OA\Post(
 *      path="/api/login",
 *      summary="Iniciar Sesion",
 *      description="Iniciar Sesion por correo electronico, contraseña",
 *      operationId="authLogin",
 *      tags={"auth"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Obtener las credenciales del usuario",
 *          @OA\JsonContent(
 *              required={"email","password"},
 *              @OA\Property(property="email", type="string", format="email", example="juan.alucard.02@gmail.com"),
 *              @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Email/Password incorrectos",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Lo sentimos, email o password incorrectos")
 *          )
 *     )
 * )
 */

 /**
 * @OA\Post(
 *      path="/api/logout",
 *      summary="Cerrar Sesion/ token invalido",
 *      description="Cerrar Sesion",
 *      operationId="authLogout",
 *      tags={"auth"},
 *      security={{"bearer_token":{}}},
 *      @OA\Response(
 *          response=200,
 *          description="Logout exitoso"
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="El token no hace match",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Usuario no autorizado")
 *          )
 *      )
 * )
 */


