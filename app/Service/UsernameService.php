<?php

namespace App\Service;

use App\Eloquent\Repository\UserRepository;
use Project\Company\Eloquent\Repository\CompanyRepository;
use Project\Employee\Service\CurrentEmployeeTrait;

/**
 * Class UsernameService
 *
 * @package App\Service
 */
class UsernameService
{
    use CurrentEmployeeTrait;

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UsernameService constructor.
     *
     * @param CompanyRepository $companyRepository
     * @param UserRepository    $userRepository
     */
    public function __construct(CompanyRepository $companyRepository, UserRepository $userRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->userRepository    = $userRepository;
    }

    /**
     * @param string      $username
     * @param null|string $ignore
     *
     * @return bool
     */
    public function isUsernameUnique(string $username, string $ignore = null)
    {
        $dataRequest = $this->companyRepository->fetchAll()
            ->byId($this->getCurrentCompany()->getId())
            ->withUsername($username, $ignore);
        $company = $dataRequest->first();
        return $company === null;
    }

    /**
     * @param string $email
     *
     * @return null|string
     */
    public function generateUniqueUsername(string $email): ?string
    {
        $username = $this->generateUsername($email);
        if (!$username) {
            return null;
        }

        $countSimilar = $this->userRepository->fetchAll()
            ->withUsernameLike($username)
            ->count();

        if ($countSimilar > 0) {
            $countSimilar++;
            $username = sprintf('%s%s', $username, $countSimilar);
        }

        return $username;
    }

    /**
     * @param string $email
     *
     * @return null|string
     */
    public function generateUsername(string $email): ?string
    {
        return $email ? substr($email, 0, strrpos($email, '@')) : null;
    }
}
