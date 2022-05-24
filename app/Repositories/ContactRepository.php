<?php


namespace App\Repositories;

use App\Models\Contact;
use Prettus\Repository\Eloquent\BaseRepository;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{
    public function model()
    {
        return Contact::class;
    }
}
