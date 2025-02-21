<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TreeItem;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tree_items', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 12, 2);
            $table->string('name', 60);
            $table->unsignedInteger('order')->default(0);

            $table->foreignIdFor(TreeItem::class, 'parent_id')
                ->nullable()
                ->constrained('tree_items', 'id', 'parent_id')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tree_items');
    }
};
