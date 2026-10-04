<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserRolePermissionTypesTable extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {
        Schema::create('user_role_permission_types', function (Blueprint $table) {
            $table->id('perm_type_id');
            $table->text('description');
            $table->boolean('is_admin_link')->default(0);
            $table->timestamps();
        });

        /**
         * Default roles permission types
         */
        $defaultData = [
            //  Administrative Permissions
            [
                'perm_type_id' => 1,
                'description' => 'App Settings',
                'is_admin_link' => 1,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'perm_type_id' => 2,
                'description' => 'Manage Users',
                'is_admin_link' => 1,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'perm_type_id' => 3,
                'description' => 'Manage Permissions',
                'is_admin_link' => 1,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
        ];

        DB::table('user_role_permission_types')->insert($defaultData);
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('user_role_permission_types');
    }
}
