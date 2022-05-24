<?php


namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum as BenSampoEnum;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


abstract class BaseEnum extends BenSampoEnum implements LocalizedEnum
{
    public static function getFilterItemDescription(string $key): ?string
    {
        $key = Str::ucfirst($key);
        $constant = Arr::get(self::getConstants(), $key);

        return self::getDescription($constant);
    }

    public function toArray(): array
    {
        return (array)$this;
    }
}
