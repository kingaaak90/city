<?php

namespace App\Controller\City;

use App\Entity\City\City;
use App\Repository\City\CityRepository;
use App\Facade\City\CityFacade;
use App\Request\DTO\City\CityDto;
use App\Utils\RequestDtoValidator;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Knp\Component\Pager\Pagination\SlidingPagination;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation as ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

class CityController extends AbstractFOSRestController
{
    /**
     * POST Cities.
     * @FOSRest\Post("/api/cities")
     * @SWG\Response(response=200, description="City")
     * @SWG\Parameter(
     *     name="data",
     *     in="body",
     *     type="json",
     *     description="City",
     *     @Model(type=App\Request\DTO\City\CityDto::class)
     * )
     * ApiDoc\Security(name="JWT")
     * @SWG\Tag(name="City")
     */
    public function addCityAction(
        Request $request,
        RequestDtoValidator $dtoValidator,
        CityFacade $cityFacade
    )
    {
        $data = $dtoValidator->deserializeToDto($request->getContent(), ['create'], CityDto::class);
        $errors = $dtoValidator->validate($data, ['create']);

        if ($errors->count() > 0) {
            return $this->view($errors, Response::HTTP_BAD_REQUEST);
        }
        $cityFacade->add($data);

        return $this->view(null,Response::HTTP_CREATED);
    }

    /**
     * GET All City.
     * @FOSRest\Get("/api/city-city")
     * @FOSRest\QueryParam(
     *     name="page",
     *     requirements="\d+",
     *     strict=true,
     *     default="1",
     *     nullable=true
     * )
     * @FOSRest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     strict=true,
     *     default="4",
     *     nullable=true
     * )
     * @FOSRest\View(serializerGroups={"city-list"})
     * @SWG\Response(response=201, description="City")
     * ApiDoc\Security(name="JWT")
     * @SWG\Tag(name="City")
     */
    public function getCityAction(
        CityRepository $cityRepository,
        ParamFetcher $paramFetcher,
        PaginatorInterface $paginator
    ) {

        $city = $cityRepository->getAllCity();

        /** @var SlidingPagination $paginationResult */
        $paginationResult = $paginator->paginate(
            $city,
            $paramFetcher->get('page'),
            $paramFetcher->get('limit'),
            array('wrap-queries'=>true)
        );

        return $this->view(
            [
                'data' => $paginationResult->getItems(),
                'pagination' => $paginationResult->getPaginationData()
            ],
            Response::HTTP_OK
        );

    }



}