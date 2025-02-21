<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tree\CreateRequest;
use App\Http\Resources\TreeResource;
use App\Service\TreeService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TreeController extends Controller
{

    public function __construct(private TreeService $treeService)
    {
    }
    public function index(): AnonymousResourceCollection
    {
        return TreeResource::collection($this->treeService->getPublicOrSelfList());
    }

    public function getById(int $id)
    {
        return $this->treeService->getTreeById($id);
    }

    public function delete(int $id): void
    {

    }

    public function update(int $id, Request $request): void
    {

    }

    public function create(CreateRequest $request): TreeResource
    {
       return TreeResource::make($this->treeService->create($request->validated()));
    }

}
