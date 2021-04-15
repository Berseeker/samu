<?php

/**
 * @OA\Get(
 *      path="/api/direcciones",
 *      summary="Request Directions",
 *      description="Solicitar direcciones pertenecientes a un usuario",
 *      operationId="apiDirection",
 *      tags={"direcciones"},
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
 *              @OA\Property(property="message", type="string", example="Mostrando todas las direcciones relacionadas a un cliente")
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
 *      path="/api/direccion/{id}",
 *      summary="Request Direction",
 *      description="Solicitar la direccion de un cliente",
 *      operationId="apiShowDirection",
 *      tags={"direcciones"},
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
 *          description="Modelo Direccion no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La direccion solicitada no existe o no le pertenece al usuario")
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
 *              @OA\Property(property="message", type="string", example="Mostrando la direccion solicitada")
 *          )
 *      )
 * )
 */

/**
 * @OA\Post(
 *      path="/api/direccion/{id}",
 *      summary="Update Direction",
 *      description="Modificar una Direccion ",
 *      operationId="apiUpdateDirection",
 *      tags={"direcciones"},
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
 *          description="Mandar los datos necesarios para modificar una direccion",
 *          @OA\JsonContent(
 *              required={"persona_x_recibe","celular","ciudad","estado","colonia_delegacion","calle","no_ext","pais_id","cp"},
 *              @OA\Property(property="persona_x_recibe", type="string", example="Luis"),
 *              @OA\Property(property="celular", type="integer", example=00000000),
 *              @OA\Property(property="ciudad", type="string", example="Cancun"),
 *              @OA\Property(property="estado", type="string", example="QR"),
 *              @OA\Property(property="colonia_delegacion", type="string", example="Benito Jaurez"),
 *              @OA\Property(property="calle", type="string", example="Av 3"),
 *              @OA\Property(property="no_ext", type="integer", example=3),
 *              @OA\Property(property="pais_id", type="integer", example=3),
 *              @OA\Property(property="cp", type="integer", example=77500),
 *              @OA\Property(property="referencias", type="string", example="por el oxxo"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Modelo Direccion no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La direccion solicitada no existe")
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
 *              @OA\Property(property="message", type="string", example="La direccion se actualizo correctamente")
 *          )
 *      )
 * )
 */

/**
 * @OA\Post(
 *      path="/api/direccion",
 *      summary="Store Direction",
 *      description="Crear una Direccion ",
 *      operationId="apiStoreDirection",
 *      tags={"direcciones"},
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
 *          description="Mandar los datos necesarios para crear una direccion",
 *          @OA\JsonContent(
 *              required={"persona_x_recibe","celular","ciudad","estado","colonia_delegacion","calle","no_ext","pais_id","cp"},
 *              @OA\Property(property="persona_x_recibe", type="string", example="Luis"),
 *              @OA\Property(property="celular", type="integer", example=00000000),
 *              @OA\Property(property="ciudad", type="string", example="Cancun"),
 *              @OA\Property(property="estado", type="string", example="QR"),
 *              @OA\Property(property="colonia_delegacion", type="string", example="Benito Jaurez"),
 *              @OA\Property(property="calle", type="string", example="Av 3"),
 *              @OA\Property(property="no_ext", type="integer", example=3),
 *              @OA\Property(property="pais_id", type="integer", example=3),
 *              @OA\Property(property="cp", type="integer", example=77500),
 *              @OA\Property(property="referencias", type="string", example="por el oxxo"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Modelo Direccion no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La direccion solicitada no existe")
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
 *              @OA\Property(property="message", type="string", example="La direccion se creó correctamente")
 *          )
 *      )
 * )
 */


/**
 * @OA\Delete(
 *      path="/api/direccion/{id}",
 *      summary="Delete Direction",
 *      description="Eliminar una direccion ",
 *      operationId="apiDeleteDirection",
 *      tags={"direcciones"},
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
 *          description="Modelo Direccion no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La direccion solicitada no existe")
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
 *              @OA\Property(property="message", type="string", example="La direccion se elimino correctamente")
 *          )
 *      )
 * )
 */



