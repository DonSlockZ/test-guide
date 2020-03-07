<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Organization;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
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
        $data = [];
        foreach ($organizations as $organization) {
            $data[] = $organization->getName();
        }
//        $data = $this->serializer->serialize($organizations->toArray(), JsonEncoder::FORMAT);
        return new JsonResponse(['success' => 'getCategoryOrganizations', 'data' => $data]);
//        return $this->render('guide/index.html.twig', [
//            'controller_name' => 'GuideController',
//        ]);
    }

    /**
     * @Route("/organizations/{organizationId}", name="organization_info", requirements={"category"="\d+"})
     */
    public function getOrganizationInfo(int $organizationId)
    {
        $organization = $this->getDoctrine()
            ->getRepository(Organization::class)->find($organizationId);
        $jsonContent = $this->serializer->serialize(['success' => 'getOrganizationInfo', 'data' => $organization], 'json', array('groups' => ['default']));
        return new JsonResponse($jsonContent, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/organizations", name="organizations_search")
     */
    public function findOrganizationsByName(Request $request)
    {
        $name = $request->query->get('name');
        $organizations = $this->getDoctrine()
            ->getRepository(Organization::class)->findByName($name);
        $data = [];
        foreach ($organizations as $organization) {
            $data[] = $organization->getName();
        }
//        $data = $this->serializer->serialize($organizations->toArray(), JsonEncoder::FORMAT);
        return new JsonResponse(['success' => 'findOrganizationsByName', 'data' => $data]);
//        return $this->render('guide/index.html.twig', [
//            'controller_name' => 'GuideController',
//        ]);
    }
}
