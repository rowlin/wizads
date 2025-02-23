<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Tree;
use App\Models\TreeItem;
use App\Repository\TreeRepository;
use Illuminate\Database\Eloquent\Collection;

class TreeService
{
    public function __construct(private TreeRepository $treeRepository, private TreeItemService $treeItemService)
    {
    }

    public function getById(int $treeId): ?Tree
    {
        return $this->treeRepository->getById($treeId);
    }

    // @depricated
    // public function getUserTreeList(): Collection
    // {
    //     return $this->treeRepository->getListByUserId(auth()->id());
    // }

    public function getTreeById(int $treeId): TreeItem
    {
        $tree = $this->getById($treeId);

        if ($tree) {
            $rootItemId = $tree->tree_item_id;
        } else {
            abort(404, 'Tree not found');
        }

        return $this->treeItemService->getById($rootItemId);
    }

    public function getPublicOrSelfList(): Collection
    {
        return $this->treeRepository->getPublicOrSelfList(auth()->id());
    }

    public function create(array $treeData): Tree
    {
        $rootItem = $this->treeItemService->createRoot($treeData['name']);

        $data = array_merge($treeData, ['user_id' => auth()->id(), 'tree_item_id' => $rootItem->id]);

        return $this->treeRepository->create($data);
    }

    public function update(int $id, array $data): array
    {
        $tree = $this->getById($id);

        if ($tree) {
            $this->treeRepository->update($tree, $data);
        }
        //TODO: fix me
        return $tree->toArray();
    }

}
