<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        Role::create(array(
            'name' => 'Administrador',
            'description' => 'Acceso total al sistema',
            'level' => '10'
        ));

        Role::create(array(
            'name' => 'Tutor',
            'description' => 'Puede publicar libretas modificar sus datos',
            'level' => '2'
        ));

        Role::create(array(
            'name' => 'Alumno',
            'description' => 'Puede loguearse en el sistema pero no puede acceder a la sección de administración',
            'level' => '1'
        ));
        /**/

        Typepublication::create(array(
            'name'=> 'Libreta de notas',
        ));

        Typepublication::create(array(
            'name'=> 'Comentario',
        ));

        Type::create(array(
            'name'=> 'Administrador',
        ));

        Type::create(array(
            'name'=> 'Tutor',
        ));

        Type::create(array(
            'name'=> 'Alumno',
        ));




        $user_a = User::create(array(
            'username' => 'admin',
            'email' => 'e.condori.v@gmail.com',
            'password' => '123456',
            'verified' => '1',
            'dni' => '11111111'
        ));

        Person::create(array(
            'firstname' => 'admin',
            'lastname' => 'admin',
            'dni' => '11111111',
            'user_id' => 1,
            'people_type_id' => 1
        ));


        $user_a->roles()->attach(1);

        /*---------------------------------------- Roles */

    }

}