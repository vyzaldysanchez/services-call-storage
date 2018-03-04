<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Service
 * @package App\Models
 *
 * @property string $name
 * @property Carbon $created_at
 */
class Service extends Model
{
    protected $table = 'services';
    protected $fillable = ['name'];

    public $timestamps = true;

    public function toArray()
    {
        return [
            'name' => $this->name,
            'called_at' => $this->created_at->toDateString()
        ];
    }
}