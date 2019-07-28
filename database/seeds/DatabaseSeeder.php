<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       /*$this->call(ArticlesTableSeeder::class);
        $this->call(AssignmentsTableSeeder::class); 
        $this->call(UsersTableSeeder::class);
        $this->call(AttendancesTableSeeder::class);
        $this->call(BooksTableSeeder::class);
      $this->call(DurationsTableSeeder::class);
       $this->call(EventsTableSeeder::class);
     $this->call(ExamsTableSeeder::class);
      $this->call(SubjectsTableSeeder::class);
      $this->call(TimetablesTableSeeder::class);*/
      

    //  $this->call(CountriesTableSeeder::class);

    //$this->call(SettingsTableSeeder::class);
    //$this->call(MessagesTableSeeder::class);
    //$this->call(RoomsTableSeeder::class);
    $this->call(EduyearsTableSeeder::class);
  }
}
