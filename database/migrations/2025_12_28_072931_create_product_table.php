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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            
            // Basic product information
            $table->string('productName');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2); // Use decimal for prices
            
            // Foreign key to category table
            $table->foreignId('category_id')
                ->nullable() // Product can exist without category
                ->constrained('category') // References category table
                ->onDelete('set null'); // If category is deleted, set category_id to null
                
            // Additional fields for better product management
            $table->string('sku')->unique()->nullable(); // Stock Keeping Unit
            $table->integer('stock_quantity')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('image_url')->nullable();
            $table->json('specifications')->nullable(); // For additional product specs
            
            $table->timestamps();
            
            // Add indexes for better performance
            $table->index('category_id');
            $table->index('is_active');
            $table->index('sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};