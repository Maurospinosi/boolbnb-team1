<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            "occasione unica",
            "prezzo ribassato",
            "nuovo appartamento",
            "solitamente occupato",
        ];

        foreach($tags as $tag) {
            $newTag = new Tag;
            $newTag->name = $tag;
            $newTag->save();
        }

    }
}
