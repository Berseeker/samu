<?php

/**
 * @OA\Get(
 *      path="/api/paises",
 *      summary="Request Pais",
 *      description="Solicitar todos los paises registrados",
 *      operationId="apiPais",
 *      tags={"paises"},
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
 *              @OA\Property(property="message", type="string", example="Mostrando todos los paises registrados")
 *          )
 *      )
 * )
 */

 /**
 * @OA\Get(
 *      path="/api/pais/{id}",
 *      summary="Request Pais",
 *      description="Solicitar un pais en especifico",
 *      operationId="apiShowPais",
 *      tags={"paises"},
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
 *          description="Modelo Pais no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="El pais solicitado no existe")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Mostrando el pais solicitado")
 *          )
 *      )
 * )
 */


/**
 * @OA\Delete(
 *      path="/api/pais/{id}",
 *      summary="Delete Pais",
 *      description="Eliminar un pais ",
 *      operationId="apiDeletePais",
 *      tags={"paises"},
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
 *          description="Modelo Pais no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="El pais solicitado no existe")
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
 *              @OA\Property(property="message", type="string", example="El pais se elimino correctamente")
 *          )
 *      )
 * )
 */



