<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Rename category to category_name
            $table->renameColumn('category', 'category_name');
            
            // Add category_id column if it doesn't exist
            if (!Schema::hasColumn('products', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('category_name');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            }
        });
    }
    
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('category_name', 'category');
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
