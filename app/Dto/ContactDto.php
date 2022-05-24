<?php

namespace App\Dto;


class ContactDto extends BaseDto
{
    public ?int $user_id;
    public ?string $first_name;
    public ?string $middle_name;
    public ?string $last_name;
    public ?string $phone;
    public ?int $gender;
    public ?bool $favorite;
}
