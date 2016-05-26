<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Setup extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function($table)
        {
            $table->increments('id');
            $table->string('name',45);

            $table->timestamps();
        });

        Schema::create('people', function($table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('people_type_id')->unsigned();
            $table->foreign('people_type_id')->references('id')->on('types');
            $table->string('firstname',60);
            $table->string('lastname',60);
            $table->date('birthdate');
            $table->decimal('dni',8,0);
            $table->string('genre',2);
            $table->string('responsible',100);
            $table->string('address',150);
            $table->string('phone1',12);
            $table->string('phone2',12);
            $table->string('status');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('typepublications', function($table)
        {
            $table->increments('id');
            $table->string('name',45);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('levels',function($table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name',45);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('grades',function($table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name',45);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('sections',function($table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name',45);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('publications', function($table)
        {
            $table->increments('id');
            $table->string('detail',100);
            $table->string('status',2);
            $table->date('publicated_at');

            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('ratings', function($table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('path',100);
            $table->string('file',60);
            $table->integer('semester')->unsigned();
            $table->integer('year')->unsigned();
            $table->string('status',2);

            $table->softDeletes();
            $table->timestamps();
        });
        /**
         * Model: Sin modelo, tabla intermedia
         */
        Schema::create('publication_rating', function(Blueprint $table)
        {
            $table->integer('publication_id')->unsigned();
            $table->foreign('publication_id')->references('id')->on('publications');
            $table->integer('rating_id')->unsigned();
            $table->foreign('rating_id')->references('id')->on('ratings');
            $table->timestamps();
        });
        /**
         * Model: Sin modelo, tabla intermedia
         */
        Schema::create('user_publication', function(Blueprint $table)
        {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('publication_id')->unsigned();
            $table->foreign('publication_id')->references('id')->on('publications');
            $table->timestamps();
        });

        Schema::table('users', function($table)
        {
            $table->decimal('dni',8,0);
        });

        Schema::create('galleries', function($table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('images', function($table)
        {
            $table->increments('id');
            $table->integer('gallery_id')->unsigned()->nullable();
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
            $table->string('name');
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('comments', function($table)
        {
            $table->increments('id');
            $table->integer('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('people');
            $table->string('title',100);
            $table->string('abstract',120);
            $table->text('content');
            $table->integer('status')->unsigned();
            $table->integer('gallery_id')->unsigned()->nullable();
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
            $table->timestamp('publicated_at');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}