@extends('layouts.base')

@section('head')
    {{ HTML::style('static/css/events.css') }}
@stop

@section('content')
    <div class="main-wrap">
      <h2>Upcoming <span class="fvbbc">&#35;FVBBC</span> Events</h2>

      <section class="events-table">

         <table class="table table-responsive">
            <tr>
               <th>Event</th>
               <th>Date</th>
               <th>Federation</th>
               <th>Location</th>
               <th>More Info</th>
            </tr>
            <tr class="first-row">
               <td>
                  <a href="http://images.aausports.org/event-files/flyers/CB9A84E7-C75D-4B4B-BDE4-4D14945174A1_flyer.PDF" target="_blank">
                     AAU American Feats of Strength and AAU American Weightlifting
                  </a>
               </td>
               <td>June 21-22</td>
               <td>AAU</td>
               <td>Vista, CA</td>
               <td>
                  <a href="http://images.aausports.org/event-files/flyers/CB9A84E7-C75D-4B4B-BDE4-4D14945174A1_flyer.PDF" target="_blank">
                     Event Flyer
                  </a>
               </td>
            </tr>
            <tr>
               <td>
                  <a href="https://www.facebook.com/events/564346767017089/?ref=22" target="_blank">
                     AAU Southern California Powerlifting, Bench, Deadlift, and Pushpull
                  </a>
               </td>
               <td>September 13</td>
               <td>AAU</td>
               <td>San Jacinto, CA</td>
               <td>
                  <a href="https://www.facebook.com/events/564346767017089/?ref=22" target="_blank">
                     Click Here
                  </a>
               </td>
            </tr>
            <tr>
               <td>
                  <a href="https://www.facebook.com/events/647210531975289/?ref=52&source=1" target="_blank">
                     AAU National Weightlifting Championships and AAU US Powerlifting &amp; Feats of Strength
                  </a>
               </td>
               <td>November 8</td>
               <td>AAU</td>
               <td>San Diego, CA</td>
               <td>
                  <a href="https://www.facebook.com/events/647210531975289/?ref=52&source=1" target="_blank">
                     Click Here
                  </a>
               </td>
            </tr>
         </table>

      </section>
    </div>
@stop
