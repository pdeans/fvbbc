<?php


class SidebarController extends BaseController {

    /**
     *  ------------------------------------------
     *  Left-Sidebar (GET)
     *  ------------------------------------------
     */

    /**
     * Upcoming Events
     *
     * @return View
     */
    public function getEvents()
    {
        return View::make('sidebar.events');
    }

    /**
     * Workout Routines
     *
     * @return View
     */
    public function getRoutines()
    {
        return View::make('sidebar.routines');
    }

    /**
     * Training Tools (GET)
     *
     * @return View
     */
    public function getTools()
    {
        return View::make('sidebar.tools');
    }

    /**
     * Training Tools (POST)
     *
     * @return Redirect
     */
    public function postTools()
    {
        $rules = array(
            'mr_weight'     => 'numeric',
            'mr_reps'       => 'numeric',
            'conv_weight'   => 'numeric',
            'wilks_lifted'  => 'numeric',
            'wilks_bweight' => 'numeric'
        );

        $message = array(
            'numeric' => 'Value entered must be a number.',
        );

        $validator = Validator::make(Input::all(), $rules, $message);

        if ($validator->fails()) {

            return Redirect::to('extras/tools')
                    ->withErrors($validator)
                    ->withInput();
        }
        else {
            // Max-rep Calculator
            $mr_weight = Input::get('mr_weight');
            $mr_reps   = Input::get('mr_reps');
            $mr_total  = number_format($mr_weight * (1 + ($mr_reps / 30)));

            if(!empty($mr_total)) {
                return Redirect::to('extras/tools')
                    ->withInput()
                    ->with('mr_total', $mr_total);
            }

            // Lbs - Kg Converter
            $conv_weight    = Input::get('conv_weight');
            $choice         = Input::get('conv_choice');
            if (($choice == 'lbs') && (!empty($conv_weight))) {
                $conv_total = number_format($conv_weight / 2.20462262, 1, '.', ',');

                return Redirect::to('extras/tools')
                                    ->withInput()
                                    ->with('conv_total', $conv_total);
            }
            elseif (($choice == 'kg') && (!empty($conv_weight))) {
                $conv_total = number_format($conv_weight * 2.20462262, 1, '.', ',');

                return Redirect::to('extras/tools')
                                    ->withInput()
                                    ->with('conv_total', $conv_total);
            }

            // Wilks Rating Calculator
            $wilks_lifted   = Input::get('wilks_lifted');
            $wilks_bweight  = Input::get('wilks_bweight');
            $wilks_gender   = Input::get('wilks_gender');

            if (!empty($wilks_lifted) && !empty($wilks_bweight)) {
                if ($wilks_gender == 'female') {

                    $wilks_total = $this->wilksCalculatorFemale($wilks_lifted, $wilks_bweight);
                }
                else {

                    $wilks_total = $this->wilksCalculatorMale($wilks_lifted, $wilks_bweight);
                }

                return Redirect::to('extras/tools')
                        ->with('wilks_total', $wilks_total)
                        ->withInput();
            }

            return Redirect::to('extras/tools')
                    ->withInput();
        }
    }

    /**
     * Member Wilks Ratings
     *
     * @return View
     */
    public function getWilks()
    {
        $wilks = User::where('wilks_rating', '>', 100)->take(50)->orderBy('wilks_rating', 'DESC')->get();
        $rank = 0;

        return View::make('sidebar.wilks', compact('rank', 'wilks'));
    }

    /**
     *  ------------------------------------------
     *  Sidebar Methods
     *  ------------------------------------------
     */

    /**
     * Wilks Rating Calculator for Males
     *
     * @param  $total_lifted [Total weight lifted], $body_weight [Body weight]
     * @return $wilks_rating [Wilks Rating]
     */
    public function wilksCalculatorMale($total_lifted, $body_weight) {

        $total_lifted_kilo = (double)($total_lifted / 2.2046);
        $body_weight_kilo = (double)($body_weight / 2.2046);

        $wilks_rating = $total_lifted_kilo *
                        (500 /
                              (   (-216.0475144)
                                + (16.2606339 * $body_weight_kilo)
                                + (-0.002388645 * pow($body_weight_kilo, 2))
                                + (-0.00113732 * pow($body_weight_kilo, 3))
                                + (0.00000701863 * pow($body_weight_kilo, 4))
                                + (-0.00000001291 * pow($body_weight_kilo, 5)) )
                        );

        return $wilks_rating = number_format($wilks_rating, 3, '.', ',');
    }

    /**
     * Wilks Rating Calculator for Females
     *
     * @param  $total_lifted [Total weight lifted], $body_weight [Body weight]
     * @return $wilks_rating [Wilks Rating]
     */
    public function wilksCalculatorFemale($total_lifted, $body_weight) {

        $total_lifted_kilo = (double)($total_lifted / 2.2046);
        $body_weight_kilo = (double)($body_weight / 2.2046);

        $wilks_rating = $total_lifted_kilo *
                        (500 /
                              (   (594.31747775582)
                                + (-27.23842536447 * $body_weight_kilo)
                                + (0.82112226871 * pow($body_weight_kilo, 2))
                                + (-0.00930733913 * pow($body_weight_kilo, 3))
                                + (0.00004731582 * pow($body_weight_kilo, 4))
                                + (-0.00000009054 * pow($body_weight_kilo, 5)) )
                        );

        return $wilks_rating = number_format($wilks_rating, 3, '.', ',');
    }

}
