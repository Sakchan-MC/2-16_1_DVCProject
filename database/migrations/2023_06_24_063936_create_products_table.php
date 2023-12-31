<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name")
                ->unique();
            $table->string("desc")
                ->nullable();
            $table->string("img")
                ->nullable();
            $table->foreignId("id_category")
                ->nullable()
                ->constrained("categories")
                ->nullOnDelete();
            $table->foreignId("created_by")
                ->nullable()
                ->constrained("users")
                ->nullOnDelete();
            $table->foreignId("updated_by")
                ->nullable()
                ->constrained("users")
                ->nullOnDelete();
            $table->foreignId("deleted_by")
                ->nullable()
                ->constrained("users")
                ->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
