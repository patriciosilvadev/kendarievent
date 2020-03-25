@extends('Shared.Layouts.MasterLandingPage')

@section('header')
<header id="header" class="header-fixed">
@stop

@section('content')
<main id="main" class="main-page">
    <!-- ======= Speakers Section ======= -->
    <section id="speakers" class="wow fadeInUp">
        <div class="container">
          <div class="section-header">
            <h2>Event</h2>
            <p>Upcoming Events</p>
          </div>
  
          <div class="row">
            @foreach ( $events as $event )
            <div class="col-lg-4 col-md-6">
              <div class="speaker">
                <img src="{{asset( $event->bg_image_path )}}" alt="Speaker 1" class="img-fluid">
                <div class="details">
                  <h3><a href="speaker-details.html">{{ $event->title }}</a></h3>
                  <p>{{ $event->venue_name }}</p>
                  <div class="social">
                    <p>{{ $event->start_date }}</p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
  
      </section><!-- End Speakers Section -->

  </main><!-- End #main -->
  @stop