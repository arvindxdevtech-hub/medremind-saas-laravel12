<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicine;
use App\Models\User;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            return;
        }

        $medicines = [

            [
                'name' => 'Crocin 650',
                'description' => 'Take 1 tablet after food for fever and body pain.'
            ],

            [
                'name' => 'Pantop 40',
                'description' => 'Take 1 tablet before breakfast for acidity control.'
            ],

            [
                'name' => 'Limcee 500',
                'description' => 'Take 1 tablet daily after lunch as Vitamin C supplement.'
            ],

            [
                'name' => 'Cetirizine 10',
                'description' => 'Take 1 tablet at night for allergy relief.'
            ],

            [
                'name' => 'Shelcal 500',
                'description' => 'Take 1 tablet daily after dinner for calcium support.'
            ],

        ];

        foreach ($medicines as $medicine) {

            Medicine::create([
                'user_id' => $user->id,
                'name' => $medicine['name'],
                'description' => $medicine['description'],
            ]);
        }
    }
}
