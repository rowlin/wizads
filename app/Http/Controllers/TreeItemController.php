<?php

namespace App\Http\Controllers;

use App\Http\Requests\TreeItem\CreateRequest;
use App\Http\Requests\TreeItem\UpdateRequest;
use App\Models\TreeItem;
use App\Service\TreeItemService;

class TreeItemController extends Controller
{
    public function __construct(private TreeItemService $treeItemService)
    {
    }

    public function create(CreateRequest $request): TreeItem
    {
        return $this->treeItemService->create($request->validated());
    }

    public function update(int $treeItemId , UpdateRequest $request): bool
    {
        return $this->treeItemService->update($treeItemId, $request->validated());
    }

    public function delete(int $treeItemId): bool
    {
        return $this->treeItemService->delete($treeItemId);
    }


}
