<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Tree;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class TreeRepository
{

    private Tree $tree;

    public function __construct()
    {
        $this->tree = new Tree();
    }

    public function getById(int $id): ?Tree
    {
        return $this->tree->query()->where('id', $id)->first();
    }

    public function getListByUserId(int $userId): Collection
    {
        return $this->tree->query()->where('user_id', $userId)->get();
    }

    public function getPublicOrSelfList(int $userId): Collection
    {
        return $this->tree->query()->where('is_public', true)->orWhere('user_id', $userId)->get();
    }

    public function create(array $data): Tree
    {
        try {
            return $this->tree->query()->create($data);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(Tree $tree, array $data): bool
    {
        try {
            return $tree->update($data);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        return $this->getById($id)->delete();
    }

}
