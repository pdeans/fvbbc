<?php


class HomeController extends BaseController {

    /**
     * Hompage (GET)
     *
     * @return View
     */
	public function home()
    {
        # $youtube = new Madcoda\Youtube(array('key' => 'AIzaSyDhuWt-LW1R0_b4pC57yr1Qpza8gVQKl-s'));

        # $vid_info = $youtube->getVideoInfo(Input::get('vid')));

		return View::make('layouts.home', compact('vid_info'));
	}

    /**
     * About Us (GET)
     *
     * @return View
     */
    public function about()
    {
        return View::make('layouts.about');
    }

    /**
     * Contact Page (GET)
     *
     * @return View
     */
    public function contact()
    {
        return View::make('layouts.contact');
    }

    /**
     * Test Page (GET)
     *
     * @return View
     */
    public function testpage()
    {  /***
        $code = '1234';
        $username = 'pdeans';
        Mail::send('emails.auth.activate',
                    array('link' => URL::route('user-activate', $code), 'username' => $username),
                        function($message) {
                            $message->to('pdeans1986@gmail.com', 'username')->subject('Activate your account');
                });
       ***/
    }

}
