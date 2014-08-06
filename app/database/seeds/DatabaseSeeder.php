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

		$first_names =
			array('Jimmy', 'James', 'Doug', 'Pete', 'Brian', 'Max', 'Nick', 'Brent', 'Aaron', 'Tony', 'Tim', 'Zack', 'Peter', 'Jack', 'Mike', 'Robert', 'Jesus', 'Jeff', 'Shaun', 'Adrian', 'Donald', 'Yolo', 'Clark');

		$last_names =
			array('Johnson', 'Jennings', 'Rudd', 'Peterson', 'Foxx', 'Moseling', 'Renaux', 'Porter', 'Way', 'Bunn', 'Rummel', 'Sterling', 'Stone', 'Lambert', 'Lenaldo', 'Tuttle', 'Wilson', 'Washington', 'Swag', 'Brentwood', 'Parker', 'Kent', 'Shuttlesworth');

		for ($i = 0 ; $i <= 55 ; $i++)
        {
            $user = new User;
            $index = mt_rand(0, (count($first_names) - 1));

            shuffle($first_names);
            $firstname = $first_names[$index];
            $user->firstname = $firstname;

            shuffle($last_names);
            $lastname = $last_names[$index];
            $user->lastname = $lastname;

            $user->username = $firstname . mt_rand(0, 999);
            $user->email = $lastname . '@php.com';

            $password = $lastname . mt_rand(0, 999);
            $user->password = Hash::make($password);

            $user->active = 1;
            $user->height = mt_rand(0, 86);
            $user->gender = 'male';

            $big_three = mt_rand(500, 1300);
            $user->big_three = $big_three;

            $body_weight = mt_rand(145, 285);
            $user->weight = $body_weight;

            $total_lifted_kilo = $big_three / 2.2046;
        	$body_weight_kilo = $body_weight / 2.2046;
        	$wilks_rating = $total_lifted_kilo *
                        (500 /
                              (   (-216.0475144)
                                + (16.2606339 * $body_weight_kilo)
                                + (-0.002388645 * pow($body_weight_kilo, 2))
                                + (-0.00113732 * pow($body_weight_kilo, 3))
                                + (0.00000701863 * pow($body_weight_kilo, 4))
                                + (-0.00000001291 * pow($body_weight_kilo, 5)) )
                        );
            $wilks_rating = number_format($wilks_rating, 3, '.', '');
            $user->wilks_rating = $wilks_rating;

            $user->save();
        }
	}

}
