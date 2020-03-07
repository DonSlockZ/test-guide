<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Organization;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api")
 */
class GuideController extends AbstractController
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("/categories/{categoryId}/organizations", name="organizations_list", requirements={"category"="\d+"})
     */
    public function getCategoryOrganizations(int $categoryId)
    {
        $organizations = $this->getDoctrine()
            ->getRepository(Category::class)->find($categoryId)->getOrganizations();
        $jsonContent = $this->serializer->serialize(['status' => 'success', 'data' => $organizations], 'json', array('groups' => ['default']));
        return new JsonResponse($jsonContent, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/organizations/{organizationId}", name="organization_info", requirements={"category"="\d+"})
     */
    public function getOrganizationInfo(int $organizationId)
    {
        $organization = $this->getDoctrine()
            ->getRepository(Organization::class)->find($organizationId);
        $jsonContent = $this->serializer->serialize(['status' => 'success', 'data' => $organization], 'json', array('groups' => ['default']));
        return new JsonResponse($jsonContent, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/organizations", name="organizations_search")
     */
    public function findOrganizationsByName(Request $request)
    {
        $name = $request->query->get('name');
//        if (empty($name)) {
//            throw new BadRequestHttpException('Invalid parameters');
//        }
        $organizations = $this->getDoctrine()
            ->getRepository(Organization::class)->findByName($name);
        $jsonContent = $this->serializer->serialize(['status' => 'success', 'data' => $organizations], 'json', array('groups' => ['default']));
        return new JsonResponse($jsonContent, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/top-categories", name="categories_list")
     */
    public function getTopCategories()
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)->findBy(array('parent' => null));
        $jsonContent = $this->serializer->serialize(['status' => 'success', 'data' => $categories], 'json', array('groups' => ['default', 'references'], AbstractNormalizer::IGNORED_ATTRIBUTES => ['organizations']));
        return new JsonResponse($jsonContent, Response::HTTP_OK, [], true);
    }
}
