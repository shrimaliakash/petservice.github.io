<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar', 50);
            $table->string('name_en', 50);
            $table->text('permissions')->nullable();
            $table->timestamps();
        });

        $id = DB::table('groups')->insert([
          'name_ar' => 'المديرون',
          'name_en' => 'Adminstrators',
          'permissions' => json_encode(array('groups', 'admins')),
          'created_at' => date('Y-m-d'),
          'updated_at' => date('Y-m-d')
        ]);

        DB::table('users')->insert([
          'name'        => 'default admin',
          'email'       => 'admin@admin.com',
          'password'    => Hash::make('123456'),
          'user_type'   => 'admin',
          'group_id'    => $id,
          'created_at'  => date('Y-m-d'),
          'updated_at'  => date('Y-m-d')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
