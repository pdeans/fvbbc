@extends('layouts.base')

@section('head')
   {{ HTML::style('static/css/routines.css') }}
@stop

@section('content')
   <div class="main-wrap">
      <h2>Current <span class="fvbbc">&#35;FVBBC</span> Workout Routines</h2>

      <div class="main-pic">
         <img src="{{ asset('static/img/routine-bench.png') }}" alt="Competition bench press">
      </div>

      <p>
         The <span class="fvbbc">FVBBC</span> currently implements a modified version of <a href="http://www.jimwendler.com" target="_blank">Jim Wendler's 5/3/1</a> powerlifting program. The program emphasizes starting with very light weights while progressing SLOWLY and CONSISTENTLY. <br /><br />
         Wendler's 5/3/1 is built around cycles. Each cycle consists of 4 weeks. Training consists of 3 or 4 days of intense workouts per week (four days being ideal). Each training day should be focused around one core lift. These core lifts include: Military Press, Deadlift, Bench Press, and Squat. Throughout the routine, the amount of weight lifted per set is based off of percentages of your maximum rep (<a href="{{ URL::to('extras/tools') }}">click here</a> for max rep calculator). <br /><br />
         As a result of the slow and consistent progressions, the lifter is eventually put in a situation where they are striving to hit rep PR's each workout. For more details on the Wendler 5/3/1 program, <a href="http://www.jimwendler.com" target="_blank">go here</a>.
      </p>
   </div>
@stop
