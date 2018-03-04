<?php

namespace App\Twig\Extension\App;

use App\Dto\Transformer\UserEntityToTransformer;
use App\Dto\UserEntityTo;
use App\Entity\User;
use App\Service\UserService;
use Project\Employee\Facades\EmployeeLink;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class Userlink
 *
 * @package App\Twig\Extension\App
 */
class Userlink extends Twig_Extension
{

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var UserEntityToTransformer
     */
    protected $userTransformer;

    /**
     * Userlink constructor.
     *
     * @param UserService             $userService
     * @param UserEntityToTransformer $userTransformer
     */
    public function __construct(UserService $userService, UserEntityToTransformer $userTransformer)
    {
        $this->userService     = $userService;
        $this->userTransformer = $userTransformer;
    }

    public function getName()
    {
        return 'App_Extension_App_Userlink';
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('userlink', [$this, 'getUserlink']),
        ];
    }

    /**
     * @param User|UserEntityTo $user
     * @param array             $with
     *
     * @return null|string
     */
    public function getUserlink($user = null, array $with = [])
    {
        $user = $user ?: $this->userService->getCurrent();

        if ($user instanceof User) {
            $user = $this->userTransformer->fromEntity($user);
        }

        return EmployeeLink::forUsername($user->getUsername(), $with);
    }
}
