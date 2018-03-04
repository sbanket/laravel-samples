<?php

namespace App\Eloquent\Repository;

use App\Dto\Transformer\UserEntityToTransformer;
use App\Eloquent\DataRequest\UserDataRequest;
use App\Entity\User;

/**
 * Class UserRepository
 *
 * @package App\Eloquent\Repository
 */
class UserRepository
{

    /**
     * @var UserEntityToTransformer
     */
    protected $transformer;

    /**
     * UserRepository constructor.
     *
     * @param UserEntityToTransformer $transformer
     */
    public function __construct(UserEntityToTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @param array $relations
     *
     * @return UserDataRequest
     */
    public function fetchAll(array $relations = []): UserDataRequest
    {
        $dataRequest = UserDataRequest::create(
            User::with($relations)
        );
        $dataRequest->withTransformer(
            function (User $user) {
                return $this->transformer->fromEntity($user);
            }
        );

        return $dataRequest;
    }
}
