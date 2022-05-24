<?php

namespace App\Http\Controllers;

use App\Dto\ContactDto;
use App\Http\Requests\ContactCreateRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Http\Resources\ContactResource;
use App\Repositories\ContactRepositoryInterface;
use App\Services\ContactStorage;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ContactController extends Controller
{
    public function __construct(
        private ContactStorage $storage,
        private ContactRepositoryInterface $repository
    ) {}

    /**
     * @return AnonymousResourceCollection<int, ContactResource>
     */
    public function index(): AnonymousResourceCollection
    {
        $t0 = microtime(true);
        $this->kek2();
        $t1 = microtime(true);

        $t_range = $t1 - $t0;

        dd($t_range);

        return ContactResource::collection(
            $this->repository
                ->where('user_id', \Auth::user()?->id)
                ->paginate(\request()->get('limit') ?? 25)
        );
    }

    private function kek2($count = 1, $number = 1)
    {
        $i = $count;

        while(--$i) {
            echo $number . ' ';
            $number++;

            if ($number > 100) {
                return;
            }
        }

        echo '<br>';

        $this->kek2(++$count, $number);
    }

    private function kek()
    {
        $count = 1;
        $number = 1;

        for(;$number < 100;) {
            $j = $count;

            while(--$j) {
                echo $number . ' ';
                $number++;
            }

            $count++;
            echo '<br>';
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function show(int $contact): ContactResource
    {
        $contactModel = $this->repository->find($contact);
        $this->authorize($contactModel);

        return new ContactResource($contactModel);
    }

    /**
     * @throws UnknownProperties
     * @throws \Exception
     */
    public function store(ContactCreateRequest $request): ContactResource
    {
        $contactDto = ContactDto::fromFormRequest($request);
        $contactDto->user_id = \Auth::user()->id;

        $contact = $this->storage->store($contactDto);

        return new ContactResource($contact);
    }

    /**
     * @throws UnknownProperties
     * @throws AuthorizationException
     * @throws \Exception
     */
    public function update(ContactUpdateRequest $request, int $contact): ContactResource
    {
        $contactModel = $this->repository->find($contact);
        $this->authorize($contactModel);

        $contactModel = $this->storage->update(
            $contactModel,
            ContactDto::fromFormRequest($request)
        );

        return new ContactResource($contactModel);
    }

    /**
     * @throws AuthorizationException
     * @throws \Exception
     */
    public function destroy(int $contact): Response
    {
        $contactModel = $this->repository->find($contact);
        $this->authorize($contactModel);

        $this->storage->delete($contactModel);

        return response()->noContent();
    }
}
