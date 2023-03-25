<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\LiveRelationMessage;
use App\Services\LiveRelationService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       for($i=0;$i<20;$i++){
           (new LiveRelationService())->postMessage([
               'title'=>"test_{$i}",
               'relation_title'=>'test',
               'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin porttitor sed ipsum vitae aliquam. Vestibulum tincidunt posuere augue in blandit. Donec suscipit ultrices odio, molestie egestas sem lacinia sit amet.',
           ],LiveRelationMessage::where('id',6)->first());
       }
    }
}
