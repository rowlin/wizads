<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tree extends Model
{
    /** @use HasFactory<\Database\Factories\TreeFactory> */
    use HasFactory;

    protected $fillable = ['name', 'tree_item_id','is_public', 'user_id'];

    public function rootItem(): HasOne
    {
        return $this->hasOne(TreeItem::class, 'id', 'tree_item_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
