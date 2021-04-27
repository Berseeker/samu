<?php

/**
 * @OA\Get(
 *      path="/api/divisas",
 *      summary="Request Divisas",
 *      description="Solicitar todas las divisas registradas",
 *      operationId="apiDivisa",
 *      tags={"divisas"},
 *      @OA\Response(
 *          response=500,
 *          description="Falla Critica",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Consulta con el programador")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Mostrando todas las divisas")
 *          )
 *      )
 * )
 */

 /**
 * @OA\Get(
 *      path="/api/divisa/{id}",
 *      summary="Request Divisa",
 *      description="Solicitar una divisa en especifico",
 *      operationId="apiShowDivisa",
 *      tags={"divisas"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Modelo Divisa no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La divisa solicitada no existe")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Mostrando la divisa solicitada")
 *          )
 *      )
 * )
 */

/**
 * @OA\Post(
 *      path="/api/divisa/{id}",
 *      summary="Update Divisa",
 *      description="Modificar una Divisa ",
 *      operationId="apiUpdateDivisa",
 *      tags={"divisas"},
 *      security={{"bearer_token":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          description="Mandar los datos necesarios para modificar una divisa",
 *          @OA\JsonContent(
 *              required={"moneda","valor"},
 *              @OA\Property(property="moneda", type="string", example="MXN"),
 *              @OA\Property(property="valor", type="number", example=23.50),
 *              @OA\Property(property="pais", type="string", example="Mexico"),
 *              @OA\Property(property="bandera", type="string", example="http://something"),
 *              @OA\Property(property="alpha_code", type="number", example="es-MX"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Modelo Divisa no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La divisa solicitada no existe")
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Usuario no autenticado")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La divisa se actualizo correctamente")
 *          )
 *      )
 * )
 */

/**
 * @OA\Post(
 *      path="/api/divisa",
 *      summary="Store Divisa",
 *      description="Crear una Divisa ",
 *      operationId="apiStoreDivisa",
 *      tags={"divisas"},
 *      security={{"bearer_token":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          description="Mandar los datos necesarios para crear una divisa",
 *          @OA\JsonContent(
 *              required={"moneda","valor"},
 *              @OA\Property(property="moneda", type="string", example="MXN"),
 *              @OA\Property(property="valor", type="number", example=23.50),
 *              @OA\Property(property="pais", type="string", example="Mexico"),
 *              @OA\Property(property="bandera", type="string", example="http://something"),
 *              @OA\Property(property="alpha_code", type="number", example="es-MX"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Modelo Direccion no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La divisa solicitada no existe")
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Usuario no autenticado")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La divisa se creó correctamente")
 *          )
 *      )
 * )
 */


/**
 * @OA\Delete(
 *      path="/api/divisa/{id}",
 *      summary="Delete Divisa",
 *      description="Eliminar una divisa ",
 *      operationId="apiDeleteDivisa",
 *      tags={"divisas"},
 *      security={{"bearer_token":{}}},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Modelo Divisa no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La divisa solicitada no existe")
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Usuario no autenticado")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La divisa se elimino correctamente")
 *          )
 *      )
 * )
 */



