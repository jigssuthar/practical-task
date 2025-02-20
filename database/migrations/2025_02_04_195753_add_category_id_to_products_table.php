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
    Schema::table('products', function (Blueprint $table) {
        // Add category_id column with foreign key constraint
        $table->unsignedBigInteger('category_id')->after('price');
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        // Add user_id column with foreign key constraint
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Automatically references 'id' on 'users'
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop the foreign key and the category_id column in case of rollback
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
