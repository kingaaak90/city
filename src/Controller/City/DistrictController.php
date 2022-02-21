<?php

namespace App\Controller\City;

use App\Entity\City\City;
use App\Entity\City\District;
use App\Facade\City\DistrictFacade;
use App\Repository\City\CityRepository;
use App\Repository\City\DistrictRepository;
use App\Request\DTO\City\DistrictDto;
use App\Utils\RequestDtoValidator;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Knp\Component\Pager\Pagination\SlidingPagination;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Model;


class DistrictController extends AbstractFOSRestController
{
    /**
     * POST District.
     * @FOSRest\Post("/api/district")
     * @SWG\Response(response=200, description="District")
     * @SWG\Parameter(
     *     name="data",
     *     in="body",
     *     type="json",
     *     description="City",
     *     @Model(type=App\Request\DTO\City\DistrictDto::class)
     * )
     * ApiDoc\Security(name="JWT")
     * @SWG\Tag(name="City")
     */
    public function addDistrictAction(
        Request $request,
        RequestDtoValidator $dtoValidator,
        DistrictFacade $districtFacade
    )
    {
        dump('tt');

        $data = $dtoValidator->deserializeToDto($request->getContent(), ['create'], DistrictDto::class);
        $errors = $dtoValidator->validate($data, ['create']);

        if ($errors->count() > 0) {
            return $this->view($errors, Response::HTTP_BAD_REQUEST);
        }

        $districtFacade->add($data);


        return $this->view(null,Response::HTTP_CREATED);
    }

    /**
     * GET all districts.
     * @FOSRest\Get("/api/city/{city}/districts")
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
     * FOSRest\QueryParam(
     *      name="city_id",
     *      nullable=true
     * )
     * @SWG\Response(response=201, description="Districts")
     * ApiDoc\Security(name="JWT")
     * @SWG\Tag(name="City")
     */
    public function getAllDistrictsCityAction(
        DistrictRepository $districtRepository,
        ParamFetcher $paramFetcher,
        PaginatorInterface $paginator,
        City $city

    ) {

        $district = $districtRepository->getAllDistrictCity($city);

        /** @var SlidingPagination $paginationResult */
        $paginationResult = $paginator->paginate(
            $district,
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

    /**
     * GET districts sort by population desc.
     * @FOSRest\Get("/api/city/{city}/districts-population-desc")
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
     * FOSRest\QueryParam(
     *      name="city_id",
     *      nullable=true
     * )
     * @SWG\Response(response=201, description="Districts")
     * ApiDoc\Security(name="JWT")
     * @SWG\Tag(name="City")
     */
    public function getDistrictsCityPopulationAscAction(
        DistrictRepository $districtRepository,
        ParamFetcher $paramFetcher,
        PaginatorInterface $paginator,
        City $city

    ) {

        $district = $districtRepository->getDistrictByPopulationDESC($city);

        /** @var SlidingPagination $paginationResult */
        $paginationResult = $paginator->paginate(
            $district,
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