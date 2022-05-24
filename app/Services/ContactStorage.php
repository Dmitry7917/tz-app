<?php


namespace App\Services;


use App\Dto\ContactDto;
use App\Models\Contact;

class ContactStorage
{
    /**
     * @throws \Exception
     */
    public function store(ContactDto $contactDto): Contact
    {
        $contact = new Contact($contactDto->toArray());

        if (!$contact->save()) {
            throw new \Exception('can not create contact');
        }

        return $contact;
    }

    /**
     * @throws \Exception
     */
    public function update(Contact $contact, ContactDto $contactDto): Contact
    {
        if (!$contact->update($contactDto->toArray())) {
            throw new \Exception('can not update contact');
        }

        return $contact;
    }

    /**
     * @throws \Exception
     */
    public function delete(Contact $contact): void
    {
        if (!$contact->delete()) {
            throw new \Exception('can not delete contact');
        }
    }
}
