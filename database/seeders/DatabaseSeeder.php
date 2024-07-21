<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage; 
use App\Models\Family;
use App\Models\Product;
use App\Models\Option;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
   
    

    public function run(): void
    {

        //Informacion asignada en crudo para el usuario principal

        \App\Models\User::factory()->create([
            'name'=>'Marco Antonio',
            'last_name'=>'Yanez Lopez',
            'document_type'=>1,
            'document_number'=> '987654321k',
            'email'=>'staroffic@gmail.com',
            'phone'=>'+56987654321',
            'password'=> bcrypt('12345678')
         ]);
     

        Storage::deleteDirectory('products');

        Storage::makeDirectory('products');


        $this->call([
            FamilySeeder::class,
            OptionSeeder::class,
        ]);

        Product::factory(150)->create();

    }

}
