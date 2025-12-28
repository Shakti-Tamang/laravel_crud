<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // FIRST: Change column type from integer to string
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 50)->nullable()->change();
        });

        // SECOND: Now update the values (column is now string, so this works)
        DB::table('users')->where('role', '0')->update(['role' => 'user']);
        DB::table('users')->where('role', '1')->update(['role' => 'admin']);
        DB::table('users')->where('role', '2')->update(['role' => 'editor']);
        
        // THIRD: Set default value
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 50)->default('user')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Convert string values back to integers BEFORE changing column type
        DB::table('users')->where('role', 'user')->update(['role' => '0']);
        DB::table('users')->where('role', 'admin')->update(['role' => '1']);
        DB::table('users')->where('role', 'editor')->update(['role' => '2']);
        
        // Change back to integer
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role')->default(0)->change();
        });
    }
};