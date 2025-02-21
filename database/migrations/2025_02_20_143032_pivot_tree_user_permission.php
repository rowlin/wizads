<?php

use App\Models\Tree;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pivot_tree_user_permission', function (Blueprint $table) {
            $table->foreignIdFor(Tree::class, 'tree_id')->constrained();
            $table->foreignIdFor(User::class, 'user_id')->constrained();
            $table->foreignIdFor(Permission::class, 'permission_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_tree_user_permission');
    }
};
