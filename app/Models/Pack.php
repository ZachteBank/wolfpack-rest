<?php

namespace App\Models;

use Database\Factories\PackFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Pack
 *
 * @property mixed $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static PackFactory factory(...$parameters)
 * @method static Builder|Pack newModelQuery()
 * @method static Builder|Pack newQuery()
 * @method static Builder|Pack query()
 * @method static Builder|Pack whereCreatedAt($value)
 * @method static Builder|Pack whereId($value)
 * @method static Builder|Pack whereName($value)
 * @method static Builder|Pack whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Pack extends Model
{
    use HasFactory;

    protected $table = 'packs';
    protected $fillable = ['name'];

    public function getAllWolves()
    {
        return $this->hasMany(Wolf::class)->get();
    }


}
