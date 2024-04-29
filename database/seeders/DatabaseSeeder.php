<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage; 
use App\Models\Family;
use App\Models\Product;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
   
    

    public function run(): void
    {

        //Informacion asignada en crudo para el usuario principal

        \App\Models\User::factory()->create([
            'name'=>'Marco A. yanez',
            'email'=>'staroffic@gmail.com',
            'password'=> bcrypt('12345678')
         ]);
     

        Storage::deleteDirectory('products');

        Storage::makeDirectory('products');


        $this->call([FamilySeeder::class]);

        Product::factory(150)->create();

    }

}
