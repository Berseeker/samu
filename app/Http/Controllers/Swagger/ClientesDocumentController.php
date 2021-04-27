<?php

/**
 * @OA\Get(
 *      path="/api/clientes",
 *      summary="Request Clients",
 *      description="Solicitar todos los clientes registrados",
 *      operationId="apiCliente",
 *      tags={"clientes"},
 *      security={{"bearer_token":{}}},
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
 *              @OA\Property(property="message", type="string", example="Mostrando todos los clientes registrados en la BD")
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Usuario no autenticado")
 *          )
 *      ),
 * )
 */

 /**
 * @OA\Get(
 *      path="/api/cliente/{id}",
 *      summary="Request Client",
 *      description="Solicitar un cliente en especifico",
 *      operationId="apiShowClient",
 *      tags={"clientes"},
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
 *          description="Modelo Cliente no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="El cliente solicitado no existe")
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
 *              @OA\Property(property="message", type="string", example="Mostrando el cliente solicitado")
 *          )
 *      )
 * )
 */

/**
 * @OA\Post(
 *      path="/api/cliente/{id}",
 *      summary="Update Client",
 *      description="Modificar un cliente ",
 *      operationId="apiUpdateClient",
 *      tags={"clientes"},
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
 *          description="Mandar los datos necesarios para modificar una categoria",
 *          @OA\JsonContent(
 *              required={"nombre","email"},
 *              @OA\Property(property="nombre", type="string", example="Luis"),
 *              @OA\Property(property="email", type="email", format="email", example="test@gmail.com"),
 *              @OA\Property(property="telefono", type="integer", example=00000000),
 *              @OA\Property(property="foto_perfil", type="string", example="picture.png")
 *          ),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Modelo Cliente no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="El cliente solicitado no existe")
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
 *              @OA\Property(property="message", type="string", example="El cliente se actualizo correctamente")
 *          )
 *      )
 * )
 */

/**
 * @OA\Delete(
 *      path="/api/cliente/{id}",
 *      summary="Delete Client",
 *      description="Eliminar un cliente ",
 *      operationId="apiDeleteClient",
 *      tags={"clientes"},
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
 *          description="Modelo Cliente no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="El cliente solicitado no existe")
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
 *              @OA\Property(property="message", type="string", example="El cliente se elimino correctamente")
 *          )
 *      )
 * )
 */



