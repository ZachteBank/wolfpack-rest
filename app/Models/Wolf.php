<?php

namespace App\Models;

use Database\Factories\WolfFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\ArrayShape;

/**
 * App\Models\Wolf
 *
 * @property int $id
 * @property string $name
 * @property string $gender
 * @property string $birthday
 * @property double $lat
 * @property double $lng
 * @property int|null $pack_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static WolfFactory factory(...$parameters)
 * @method static Builder|Wolf newModelQuery()
 * @method static Builder|Wolf newQuery()
 * @method static Builder|Wolf query()
 * @method static Builder|Wolf whereBirthday($value)
 * @method static Builder|Wolf whereCreatedAt($value)
 * @method static Builder|Wolf whereGender($value)
 * @method static Builder|Wolf whereId($value)
 * @method static Builder|Wolf whereLat($value)
 * @method static Builder|Wolf whereLng($value)
 * @method static Builder|Wolf whereName($value)
 * @method static Builder|Wolf wherePackId($value)
 * @method static Builder|Wolf whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Wolf extends Model
{
    use HasFactory;

    protected $table = 'wolves';
    protected $fillable = ['name', 'gender', 'birthday', 'lat', 'lng', 'pack_id'];

    #[ArrayShape(["latitude" => "double", "longitude" => "double"])]
    function getLocation(): array
    {
        return ["latitude" => $this->lat, "longitude" => $this->lng];
    }
}
