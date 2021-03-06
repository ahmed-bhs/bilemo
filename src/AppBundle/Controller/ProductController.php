<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Controller managing the products.
 */
class ProductController extends FOSRestController
{
    /**
     * Get the list of all product.
     *
     * @Rest\Get(
     *      path="/api/products",
     *      name="product_list"
     * )
     *
     * @Rest\View(StatusCode = 200)
     *
     * @Security("has_role('ROLE_USER')")
     *
     * @SWG\Get(
     *     description="Get the list of products.",
     *     tags = {"Product"},
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation"
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized: JWT Token not found / Expired JWT Token / Invalid JWT Token",
     *     ),
     *     @SWG\Response(
     *          response=405,
     *          description="Method Not Allowed"
     *     ),
     *     @SWG\Parameter(
     *          name="Authorization",
     *          required= true,
     *          in="header",
     *          type="string",
     *          description="Bearer Token",
     *     )
     * )
     *
     * @Cache(
     *      expires="1 hour",
     *      public=true,
     * )
     */
    public function listAction(ObjectManager $entityManager)
    {
        $products = $entityManager->getRepository(Product::class)->findAllWhithAllEntities();

        return $this->view($products, Response::HTTP_OK);
    }

    /**
     * Get one product.
     *
     * @Rest\Get(
     *      path="/api/products/{id}",
     *      name="product_detail",
     *      requirements = {"id"="\d+"}
     * )
     * @Entity("product", expr="repository.findOneWhithAllEntities(id)")
     *
     * @Rest\View(StatusCode = 200)
     *
     * @Security("has_role('ROLE_USER')")
     *
     * @SWG\Get(
     *     description="Get one product.",
     *     tags = {"Product"},
     *     @SWG\Response(
     *          response=200,
     *          @Model(type=Product::class),
     *          description="successful operation"
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized: JWT Token not found / Expired JWT Token / Invalid JWT Token",
     *     ),
     *     @SWG\Response(
     *          response=405,
     *          description="Method Not Allowed"
     *     ),
     *     @SWG\Response(
     *          response=500,
     *          description="Internal Server Error"
     *     ),
     *     @SWG\Parameter(
     *          name="id",
     *          required= true,
     *          in="path",
     *          type="integer",
     *          description="The product unique identifier.",
     *     ),
     *     @SWG\Parameter(
     *          name="Authorization",
     *          required= true,
     *          in="header",
     *          type="string",
     *          description="Bearer Token",
     *     )
     * )
     *
     * @Cache(
     *      expires="1 hour",
     *      public=true,
     * )
     */
    public function detailAction(Product $product)
    {
        return $this->view($product, Response::HTTP_OK);
    }
}
