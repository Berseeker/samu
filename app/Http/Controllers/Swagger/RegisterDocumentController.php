<?php

/**
 * @OA\Post(
 *      path="/api/create-user",
 *      summary="Registrar Usuario",
 *      description="Registrar usuario a traves de los campos necesarios",
 *      operationId="authRegister",
 *      tags={"register"},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Obtener informacion del proveedor/cliente",
 *          @OA\JsonContent(
 *              required={"nombre","email","password","password_confirmation","tienda_nombre","categoria_id","rol","pais_id","divisa_id"},
 *              @OA\Property(property="nombre", type="string", example="Pedro"),
 *              @OA\Property(property="email", type="string", format="email", example="juan_alucard@hotmail.com"),
 *              @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *              @OA\Property(property="password_confirmation", type="string", format="password", example="PassWord12345"),
 *              @OA\Property(property="tienda_nombre", type="string", example="Monster Inc."),
 *              @OA\Property(property="categoria_id", type="integer", example=1),
 *              @OA\Property(property="rol", type="string", example="proveedor"),
 *              @OA\Property(property="pais_id", type="integer", example=1),
 *              @OA\Property(property="divisa_id", type="integer", example=1)
 *          ),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Modelo Categoria, Pais, Divisa no encontrados",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Lo sentimos, este modelo no existe")
 *          )
 *     )
 * )
 */


