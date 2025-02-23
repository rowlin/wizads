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

    public function create(array $data): TreeItem
    {
        return $this->treeItemRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $treeItem = $this->getById($id);

        return $this->treeItemRepository->update($treeItem, $data);
    }

    public function delete(int $id): bool
    {
        $treeItem = $this->getById($id);
        return $treeItem->delete();
    }





}
