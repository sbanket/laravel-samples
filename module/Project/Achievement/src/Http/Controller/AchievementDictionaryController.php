<?php

namespace Project\Achievement\Http\Controller;

use App\Http\Controllers\Controller;
use App\Http\Resource\ResourcesMap;
use App\Module\Behaviour\AwareOfModuleAlias;
use App\Module\Behaviour\MakesView;
use App\Module\Behaviour\ModuleAliasAwareInstance;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Project\Achievement\Dto\AchievementEntityTo;
use Project\Achievement\Dto\Resource\AchievementResource;
use Project\Achievement\Eloquent\Repository\AchievementDictionaryRepository;
use Project\Achievement\Exception\AchievementNotFoundException;
use Project\Achievement\Http\Request\AchievementCrudRequest;
use Project\Achievement\Http\Request\AchievementEnableRequest;
use Project\Achievement\Http\Request\AchievementIconRequest;
use Project\Achievement\Service\AchievementDictionaryService;
use Project\Employee\Service\CurrentEmployeeTrait;

/**
 * Class AchievementsDictionaryController
 *
 * @package Project\Achievement\Http\Controller
 */
class AchievementDictionaryController extends Controller implements ModuleAliasAwareInstance
{
    use AwareOfModuleAlias,
        MakesView,
        CurrentEmployeeTrait;

    /**
     * @var AchievementDictionaryRepository
     */
    protected $repository;

    /**
     * @var AchievementDictionaryService
     */
    protected $crudService;

    /**
     * @var ResourcesMap
     */
    protected $resourceMap;

    /**
     * AchievementDictionaryController constructor.
     *
     * @param AchievementDictionaryRepository $repository
     * @param AchievementDictionaryService    $crudService
     * @param ResourcesMap                    $resourceMap
     */
    public function __construct(AchievementDictionaryRepository $repository, AchievementDictionaryService $crudService,
                                ResourcesMap $resourceMap)
    {
        $this->repository  = $repository;
        $this->crudService = $crudService;
        $this->resourceMap = $resourceMap;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function dictionary()
    {
        return $this->makeView('dictionary/index');
    }

    /**
     * @return \App\Http\Resource\ResourceCollection
     */
    public function index()
    {
        $records = $this->repository->companyAchievementsDictionary($this->getCurrentCompany());
        $records->orderByCreated('DESC');

        return $this->resourceMap->collection($records->paginate(5));
    }

    /**
     * @param $id
     *
     * @return Resource|AchievementResource
     * @throws UnregisteredMappingException
     */
    public function show($id)
    {
        $model = $this->guardForAchievement($id);

        return $this->resourceMap->resource($model);
    }

    /**
     * @param AchievementCrudRequest $request
     *
     * @return AchievementResource
     * @throws UnregisteredMappingException
     */
    public function store(AchievementCrudRequest $request)
    {
        $record = $this->crudService->create($request->getAttributes(), $this->getCurrentCompany());

        /** @var AchievementResource $resource */
        $resource = $this->resourceMap->resource($record);
        $resource->isCreatedResource();
        $resource->withMessage('Достижение добавлено');

        return $resource;
    }

    /**
     * @param                        $id
     * @param AchievementCrudRequest $request
     *
     * @return AchievementResource
     * @throws UnregisteredMappingException
     */
    public function update($id, AchievementCrudRequest $request)
    {
        $achievement = $this->guardForAchievement($id);
        $achievement = $this->crudService->update($achievement, $request->getAttributes());

        /** @var AchievementResource $resource */
        $resource = $this->resourceMap->resource($achievement);
        $resource->withMessage('Достижение обновлено');
        $resource->isUpdatedResource();

        return $resource;
    }

    /**
     * @param                        $id
     * @param AchievementIconRequest $request
     *
     * @return AchievementResource
     * @throws UnregisteredMappingException
     */
    public function updateIcon($id, AchievementIconRequest $request)
    {
        $achievement = $this->guardForAchievement($id);

        $this->crudService->updateImage($achievement, $request->getAttributes());

        /** @var AchievementResource $resource */
        $resource = $this->resourceMap->resource($achievement);
        $resource->withMessage('Иконка обновлена');
        $resource->isUpdatedResource();

        return $resource;
    }

    /**
     * @param                          $id
     * @param AchievementEnableRequest $request
     *
     * @return AchievementResource
     * @throws UnregisteredMappingException
     */
    public function enable($id, AchievementEnableRequest $request)
    {
        $achievement = $this->guardForAchievement($id);
        $attributes  = $request->getAttributes();

        if ($attributes->isEnabled()) {
            $achievement = $this->crudService->enable($achievement);
            $message     = 'Достижение активировано';
        } else {
            $achievement = $this->crudService->disable($achievement);
            $message     = 'Достижение деактивировано';
        }

        /** @var AchievementResource $resource */
        $resource = $this->resourceMap->resource($achievement);
        $resource->withMessage($message);
        $resource->isUpdatedResource();

        return $resource;
    }

    /**
     * @param $id
     *
     * @return AchievementEntityTo
     * @throws UnregisteredMappingException
     */
    protected function guardForAchievement($id): AchievementEntityTo
    {
        try {
            $achievement = $this->repository->find($id, $this->getCurrentCompany());
        } catch (AchievementNotFoundException $ex) {
            \Log::alert(
                'Achievement not found', [
                'Message' => $ex->getPrevious() ? $ex->getPrevious()->getMessage() : $ex->getMessage(),
                'ID'      => $ex->getId(),
            ]);

            return abort(404);
        }

        return $achievement;
    }
}
