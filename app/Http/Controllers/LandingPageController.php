<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use View;

class LandingPageController extends MyBaseController
{
    /**
     * Shows Home Landing Page.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function showHome(  )
    {
        $news = News::orderBy('id', 'desc')->paginate(3);

        $upcoming_events = Event::leftJoin('event_images', 'events.id', '=', 'event_images.event_id')
                                ->select('events.*', 'event_images.image_path')
                                ->where('end_date', '>=', Carbon::now())
                                ->where('is_live', '>=', 1)
                                ->orderBy('start_date', 'desc')->get();
        $past_events = Event::leftJoin('event_images', 'events.id', '=', 'event_images.event_id')
                                ->select('events.*', 'event_images.image_path')
                                ->where('end_date', '<', Carbon::now())
                                ->where('is_live', '>=', 1)
                                ->orderBy('start_date', 'desc')->limit(10)->get();

        $data = [
            'upcoming_events' => $upcoming_events,
            'past_events' => $past_events,
            'news' => $news
        ];
        return view('LandingPage.Dashboard', $data);
    }

    public function showEvents(  )
    {
        $events = Event::leftJoin('event_images', 'events.id', '=', 'event_images.event_id')
                        ->select('events.*', 'event_images.image_path')
                        ->where('is_live', '>=', 1)
                        ->orderBy('start_date', 'desc')->get();
        $data = [
            'events' => $events
        ];
        return view('LandingPage.Event', $data);
    }

    public function showNews(  )
    {
        $news = News::all();
        $data = [
            'news' => $news
        ];
        return view('LandingPage.News', $data);
    }

    public function showPostNews(Request $request, $news_id)
    {
        $latest_news = News::orderBy('id', 'desc')->paginate(3);
        $news = News::findOrFail($news_id);
        $data = [
            'news' => $news,
            'latest_news' => $latest_news,
        ];
        return view('LandingPage.Article', $data);
    }
}