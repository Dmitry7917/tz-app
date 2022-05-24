<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Contact
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $phone
 * @property int $gender
 * @property bool $favorite
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $full_name
 * @property-read User $user
 * @mixin \Eloquent
 * @method static Builder|Contact newModelQuery()
 * @method static Builder|Contact newQuery()
 * @method static Builder|Contact query()
 * @method static Builder|Contact whereId($value)
 * @method static Builder|Contact whereUserId($value)
 * @method static Builder|Contact whereFirstName($value)
 * @method static Builder|Contact whereMiddleName($value)
 * @method static Builder|Contact whereLastName($value)
 * @method static Builder|Contact wherePhone($value)
 * @method static Builder|Contact whereGender($value)
 * @method static Builder|Contact whereFavorite($value)
 * @method static Builder|Contact whereCreatedAt($value)
 * @method static Builder|Contact whereUpdatedAt($value)
 */
class Contact extends Model
{
    use HasFactory;

    protected $casts = [
        'favorite' => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'gender',
        'favorite',
    ];

    protected function fullName(): Attribute
    {
        return new Attribute(
            get: fn($value): string => $this->last_name . ' ' . $this->first_name,
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
