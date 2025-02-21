<?php

namespace Database\Seeders;

use App\Models\Tree;
use App\Models\TreeItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $this->createTree1();
        $this->createTree2();
    }


    public function createTree1(): void
    {
        $tree = Tree::factory()->create();

        $rootItem = $tree->rootItem;

        $firstLevelIds = [];
        for ($i = 0 ; $i < 3 ; $i++) {
            $firstLevelIds[] = TreeItem::factory()->create(['parent_id' => $rootItem->id, 'order' => $i ])->id;
        }

        $secondLevelIds = [];
        foreach ($firstLevelIds as $index => $id) {
            $secondLevelIds[] = TreeItem::factory()->create(['parent_id' => $id, 'order' => $index])->id;
        }

        $thirdLevelIds = [];
        foreach ($secondLevelIds as $index => $id) {
            $thirdLevelIds[] = TreeItem::factory()->create(['parent_id' => $id, 'order' => $index ])->id;
        }

    }


    public function createTree2(): void
    {
        $tree = Tree::factory()->create();

        $rootItem = $tree->rootItem;

        $firstLevelIds = [];
        for ($i = 0 ; $i < 2 ; $i++) {
            $firstLevelIds[] = TreeItem::factory()->create(['parent_id' => $rootItem->id, 'order' => $i ])->id;
        }

        $secondLevelIds = [];
        foreach ($firstLevelIds as $index => $id) {
            $secondLevelIds[] = TreeItem::factory()->create(['parent_id' => $id, 'order' => $index])->id;
            $secondLevelIds[] = TreeItem::factory()->create(['parent_id' => $id, 'order' => $index])->id;
            $secondLevelIds[] = TreeItem::factory()->create(['parent_id' => $id, 'order' => $index])->id;
            $secondLevelIds[] = TreeItem::factory()->create(['parent_id' => $id, 'order' => $index])->id;
            $secondLevelIds[] = TreeItem::factory()->create(['parent_id' => $id, 'order' => $index])->id;
        }

        $thirdLevelIds = [];
        foreach ($secondLevelIds as $index => $id) {
            $thirdLevelIds[] = TreeItem::factory()->create(['parent_id' => $id, 'order' => $index ])->id;
            $thirdLevelIds[] = TreeItem::factory()->create(['parent_id' => $id, 'order' => $index ])->id;
            $thirdLevelIds[] = TreeItem::factory()->create(['parent_id' => $id, 'order' => $index ])->id;
            $thirdLevelIds[] = TreeItem::factory()->create(['parent_id' => $id, 'order' => $index ])->id;
            $thirdLevelIds[] = TreeItem::factory()->create(['parent_id' => $id, 'order' => $index ])->id;
        }

    }



}
