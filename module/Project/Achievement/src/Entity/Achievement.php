<?php

namespace Project\Achievement\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Project\Company\Eloquent\Scope\CompanyConstraint;
use Project\Company\Entity\Company;
use Project\Employee\Entity\Employee;
use Project\EmployeeAchievement\Entity\EmployeeAchievement;

/**
 * Class Achievement
 *
 * @package Project\Achievement\Entity
 *
 * @property Company               $company
 * @property Employee[]|Collection $employees
 */
class Achievement extends Model
{
    use CompanyConstraint;

    const COMPANY_COLUMN = 'company_id';

    protected $table = 'achievements';

    protected $fillable = [
        'label',
        'icon',
        'is_enabled',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_achievements');
    }
}
