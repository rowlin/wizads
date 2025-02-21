<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\TreeItem;

class TreeItemRepository
{
    private TreeItem $treeItem;

    public function __construct()
    {
        $this->treeItem = new TreeItem();
    }

    public function getById(int $id): TreeItem
    {
        return $this->treeItem->query()->findOrFail($id);
    }

    //TODO: will be best to use DTO
    public function create(array $itemData): TreeItem
    {
        return $this->treeItem->query()->create($itemData);
    }

}
