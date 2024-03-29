<?php

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
        Schema::create('book', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name',100);
            $table->integer('year_publish');
            $table->integer('price_rent');
            $table->integer('weight');
            $table->integer('total_page');
            $table->integer('quantity');
            $table->string('thumbnail',100);
            $table->string('description',10000);
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
