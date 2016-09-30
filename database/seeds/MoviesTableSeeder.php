<?php

use Illuminate\Database\Seeder;
use App\Movie;
class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $movies = [
  ['id'=>'1', 'Title'=>'Batman vs Superman','description'=>'Action','year'=>'2016','director'=>'Zack Snyder',
  'id'=>'2', 'Title'=>'Fast and furious 7','description'=>'Cars','year'=>'2014','director'=>'James Wan',
  'id'=>'3', 'Title'=>'Fast and furious 6','description'=>'Cars','year'=>'2012','director'=>'Justin Lin'
  ]
];
  foreach ($movies as $movie) {
  Movie::create($movie);
  }
    }
}
