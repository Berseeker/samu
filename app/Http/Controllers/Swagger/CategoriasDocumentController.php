<?php

/**
 * @OA\Get(
 *      path="/api/categorias",
 *      summary="Request All Categories",
 *      description="Solicitar todas las categorias registradas",
 *      operationId="apiCategory",
 *      tags={"categorias"},
 *      @OA\Response(
 *          response=500,
 *          description="Falla Critica",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Consulta con el programador")
 *          )
 *      )
 * )
 */

 /**
 * @OA\Get(
 *      path="/api/categoria/{id}",
 *      summary="Request a Category",
 *      description="Solicitar una categoria en especifico",
 *      operationId="apiShowCategory",
 *      tags={"categorias"},
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
 *          description="Modelo Categoria no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La categoria solicitada no existe")
 *          )
 *      )
 * )
 */

/**
 * @OA\Post(
 *      path="/api/categoria/{id}",
 *      summary="Update Category",
 *      description="Modificar una categoria ",
 *      operationId="apiUpdateCategory",
 *      tags={"categorias"},
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
 *              required={"nombre"},
 *              @OA\Property(property="nombre", type="string", example="Test")
 *          ),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Modelo Categoria no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La categoria solicitada no existe")
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Usuario no autenticado")
 *          )
 *      )
 * )
 */

 /**
 * @OA\Post(
 *      path="/api/categoria",
 *      summary="Store Category",
 *      description="Crear una categoria ",
 *      operationId="apiStoreCategory",
 *      tags={"categorias"},
 *      security={{"bearer_token":{}}},
 *      @OA\RequestBody(
 *          required=true,
 *          description="Mandar los datos necesarios para crear una categoria",
 *          @OA\JsonContent(
 *              required={"nombre"},
 *              @OA\Property(property="nombre", type="string", example="Test")
 *          ),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Modelo Categoria no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La categoria solicitada no existe")
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Usuario no autenticado")
 *          )
 *      )
 * )
 */

/**
 * @OA\Delete(
 *      path="/api/categoria/{id}",
 *      summary="Delete Category",
 *      description="Eliminar una categoria ",
 *      operationId="apiDeleteCategory",
 *      tags={"categorias"},
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
 *          description="Modelo Categoria no encontrado",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La categoria solicitada no existe")
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
 *          response=406,
 *          description="Has Subcategories",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="La categoria no se puede eliminar ya que hay subcategorias que dependen de ella")
 *          )
 *      )
 * )
 */



