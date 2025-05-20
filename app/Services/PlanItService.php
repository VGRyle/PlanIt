<?php

namespace App\Services;

use App\Services\TodoistService;
use App\Services\WeatherService;
use App\Services\TimezoneService;
use App\Services\CalendarService;
use App\Services\FavQsService;

class PlanItService
{
    protected $todoist, $weather, $timezone, $calendar, $favqs;

    public function __construct(
        TodoistService $todoist,
        WeatherService $weather,
        TimezoneService $timezone,
        CalendarService $calendar,
        FavQsService $favqs
    ) {
        $this->todoist = $todoist;
        $this->weather = $weather;
        $this->timezone = $timezone;
        $this->calendar = $calendar;
        $this->favqs = $favqs;
    }

    public function compilePlan($content, $city, $lat, $lng, $country, $year)
    {
        $task = $this->todoist->createTask($content);
        $weather = $this->weather->getWeather($city);
        $timezone = $this->timezone->getTimezone($lat, $lng);
        $holidays = $this->calendar->getHolidays($country, $year);
        $quote = $this->favqs->getQuoteOfTheDay();

        return [
            'status' => 200,
            'data' => [
                'task' => $task['data'] ?? ['error' => $task['error']],
                'weather' => $weather['data'] ?? ['error' => $weather['error']],
                'timezone' => $timezone['data'] ?? ['error' => $timezone['error']],
                'holidays' => $holidays['data'] ?? ['error' => $holidays['error']],
                'quote' => $quote['data'] ?? ['error' => $quote['error']]
            ]
        ];
    }
}
