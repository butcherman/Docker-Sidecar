<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->bigInteger('role_id')->unsigned();
            $table->string('username')->unique;
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
                 $table->text('two_factor_secret')
                ->nullable();
            $table->text('two_factor_recovery_codes')
                ->after('two_factor_secret')
                ->nullable();
            $table->timestamp('two_factor_confirmed_at')
                ->after('two_factor_recovery_codes')
                ->nullable();
            $table->text('two_factor_via')
                ->after('two_factor_confirmed_at')
                ->nullable();
            $table->rememberToken();
            $table->timestamp('password_expires')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('role_id')
                ->references('role_id')
                ->on('user_roles')
                ->onUpdate('cascade');
        });

        /**
         * Create the initial default user
         */
        $default = [
            'user_id' => 1,
            'role_id' => 1,
            'username' => 'admin',
            'first_name' => 'System',
            'last_name' => 'Administrator',
            'email' => 'admin@em.com',
            'password' => bcrypt('password'),
            'password_expires' => '2000-01-01 00:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('users')->insert($default);
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });

        Schema::dropIfExists('users');
    }
}
