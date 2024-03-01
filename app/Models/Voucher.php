<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'vouchers';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['name', 'voucher_code', 'is_active'];

    public function uniqueIds()
    {
        return [$this->primaryKey, 'voucher_code'];
    }

    public function scopeActive(EloquentBuilder $builder): void{
        $builder->where('is_active', '=', true);
    }

    public function scopeNonActive(EloquentBuilder $builder): void{
        $builder->where('is_active', '=', false);
    }
}
