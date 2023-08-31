<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Websites extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['domain'];
    public function subscribers()
    {
        return $this->hasMany(WebsiteSubscribers::class, 'domain', 'domain');
    }
}
