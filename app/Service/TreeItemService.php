<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\TreeItem;
use App\Repository\TreeItemRepository;

class TreeItemService
{
    public function __construct(private TreeItemRepository $treeItemRepository)
    {
    }


    public function getById(int $id): TreeItem
    {
        return $this->treeItemRepository->getById($id);
    }


    public function createRoot(string $mainItem): TreeItem
    {
        $data = ['name' => $mainItem, 'order' => 0, 'price' => 0, 'parent_id' => null];
        return $this->treeItemRepository->create($data);
    }

    public function createItem(): void
    {

    }



}
