<?php

namespace Project\Achievement\Eloquent\Repository;

use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Project\Achievement\Dto\AchievementEntityTo;
use Project\Achievement\Eloquent\DataRequest\AchievementDictionaryDataRequest;
use Project\Achievement\Entity\Achievement;
use Project\Achievement\Exception\AchievementNotFoundException;
use Project\Company\Dto\CompanyEntityTo;

/**
 * Class AchievementDictionaryRepository
 *
 * @package Project\Achievement\Eloquent\Repository
 */
class AchievementDictionaryRepository
{
    /**
     * @var AutoMapperInterface
     */
    protected $mapper;

    /**
     * AchievementDictionaryRepository constructor.
     *
     * @param AutoMapperInterface $mapper
     */
    public function __construct(AutoMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param                      $id
     *
     * @return AchievementEntityTo
     * @throws AchievementNotFoundException
     * @throws UnregisteredMappingException
     */
    public function find($id)
    {
        try {
            $model = Achievement::findOrFail($id);
        } catch (\Throwable $ex) {
            throw AchievementNotFoundException::byId($id, $ex);
        }

        return $model instanceof AchievementEntityTo
            ? $model
            : $this->mapper->mapToObject($model, new AchievementEntityTo());
    }

    /**
     * @param CompanyEntityTo $company
     *
     * @return AchievementDictionaryDataRequest
     */
    public function companyAchievementsDictionary(CompanyEntityTo $company)
    {
        $qb = Achievement::with('company')->withCount('employees');

        $dataRequest = AchievementDictionaryDataRequest::create($qb);
        $dataRequest->byCompany($company->getOriginal());
        $dataRequest->withTransformer(
            function (Achievement $achievement) {
                return $this->mapper->mapToObject($achievement, new AchievementEntityTo());
            }
        );

        return $dataRequest;
    }
}
