<?php


namespace App\Repositories;


use App\Models\Contact;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ContactRepositoryInterface
 * @package App\Repositories
 * @property Contact $model
 */
interface ContactRepositoryInterface extends RepositoryInterface, RepositoryCriteriaInterface
{
    /**
     * @inheritDoc
     */
    public function model();
}
