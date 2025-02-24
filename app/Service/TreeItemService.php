<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\TreeItem;
use App\Repository\TreeItemRepository;
use Illuminate\Support\Facades\Cache;

class TreeItemService
{
    public function __construct(private TreeItemRepository $treeItemRepository)
    {
    }


    private function forgetCache(int $treeId): bool
    {
        return Cache::forget("tree-". $treeId);
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
        $treeItem = $this->treeItemRepository->create($data);

        if ($treeItem) {
            $this->forgetCache($data['tree_id']);
        }

        return $treeItem;
    }

    public function update(int $id, array $data): bool
    {
        $treeItem = $this->getById($id);

        return $this->treeItemRepository->update($treeItem, $data) ? $this->forgetCache($data['tree_id']) : false;
    }

    public function delete(int $treeId, int $id): bool
    {
        $treeItem = $this->getById($id);
        return $treeItem->delete() ? $this->forgetCache($treeId) : false;
    }

    public function move(array $data): bool
    {
        $moveItem = $this->getById((int)$data['start']);
        $parentId = $moveItem->parent_id;

        if ($parentId) {
            $moveItem->children()->each(function ($el) use ($parentId) {
                $el->update(['parent_id' => $parentId]);
            });
        } else {
            abort(500, 'I cant to move Root element');
        }

        if ($moveItem->update(['parent_id' => $data['end']])) {
            return $this->forgetCache($data['tree_id']);
        }

        return false;
    }




}
