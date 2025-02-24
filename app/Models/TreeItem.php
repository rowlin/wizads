<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TreeItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $with = ['children'];
    protected $fillable = [ 'name', 'parent_id', 'price', 'order'];

    public function children(): HasMany
    {
        return $this->hasMany(TreeItem::class,'parent_id','id')
            ->when(request()->has('price'), function ($q) {
                $q->where('price', '>=', request()->get('price'));
            });
        //FIXME: No good way!
    }

    public function parent(): HasOne
    {
        return $this->hasOne(TreeItem::class,'id','parent_id');
    }

}
