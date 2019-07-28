<?php

use Illuminate\Database\Seeder;

class EduyearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eduyears')->delete();

		$eduyears = array(
			array('start' => '2008', 'end' => '2009', 'year' => '2008-2009' , 'semester' => 'first'),
            array('start' => '2008', 'end' => '2009', 'year' => '2008-2009' , 'semester' => 'second'),
			array('start' => '2009', 'end' => '2010', 'year' => '2009-2010' , 'semester' => 'first'),
			array('start' => '2009', 'end' => '2010', 'year' => '2009-2010' , 'semester' => 'second'),
			array('start' => '2010', 'end' => '2011', 'year' => '2010-2011' , 'semester' => 'first'),
			array('start' => '2010', 'end' => '2011', 'year' => '2010-2011' , 'semester' => 'second'),
			array('start' => '2011', 'end' => '2012', 'year' => '2011-2012' , 'semester' => 'first'),
			array('start' => '2011', 'end' => '2012', 'year' => '2011-2012' , 'semester' => 'second'),
			array('start' => '2012', 'end' => '2013', 'year' => '2012-2013' , 'semester' => 'first'),
			array('start' => '2012', 'end' => '2013', 'year' => '2012-2013' , 'semester' => 'second'),
			array('start' => '2013', 'end' => '2014', 'year' => '2013-2014' , 'semester' => 'first'),
			array('start' => '2013', 'end' => '2014', 'year' => '2013-2014' , 'semester' => 'second'),
			array('start' => '2014', 'end' => '2015', 'year' => '2014-2015' , 'semester' => 'first'),
			array('start' => '2014', 'end' => '2015', 'year' => '2014-2015' , 'semester' => 'second'),
			array('start' => '2015', 'end' => '2016', 'year' => '2015-2016' , 'semester' => 'first'),
			array('start' => '2015', 'end' => '2016', 'year' => '2015-2016' , 'semester' => 'second'),
			array('start' => '2016', 'end' => '2017', 'year' => '2016-2017' , 'semester' => 'first'),
			array('start' => '2016', 'end' => '2017', 'year' => '2016-2017' , 'semester' => 'second'),
			array('start' => '2017', 'end' => '2018', 'year' => '2017-2018' , 'semester' => 'first'),
			array('start' => '2017', 'end' => '2018', 'year' => '2017-2018' , 'semester' => 'second'),
            
		);

        DB::table('eduyears')->insert($eduyears);
    }
}
