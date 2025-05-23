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
        $timezone = $this->timezone->getTimezone($lat, $lng, $country);
        $holidays = $this->calendar->getHolidays($country, $year);
        $quote = $this->favqs->getQuoteOfTheDay();

        return [
            'status' => 200,
            'data' => [
                'task' => $this->normalizeResponse($task),
                'weather' => $this->normalizeResponse($weather),
                'timezone' => $this->normalizeResponse($timezone),
                'holidays' => $this->normalizeResponse($holidays),
                'quote' => $this->normalizeResponse($quote),
            ],
        ];
    }

    protected function normalizeResponse(array $response): array
    {
        if (isset($response['data'])) {
            return $response['data'];
        }

        if (isset($response['error'])) {
            return ['error' => $response['error']];
        }

        return ['error' => 'Unknown error'];
    }
}
