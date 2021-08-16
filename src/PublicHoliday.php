<?php

namespace LazHoliday;

use Exception;
use Symfony\Component\Dotenv\Dotenv;

class PublicHoliday
{
    private array $data = [];

    public function __construct()
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../.env');
    }

    /**
     * @param string $country
     * @return $this
     * @throws Exception
     */
    public function fetch(string $country): PublicHoliday
    {
        try {
            $apiKey = $_ENV['GOOGLE_CALENDAR_API_KEY'];

            $json = file_get_contents("https://www.googleapis.com/calendar/v3/calendars/en.{$country}%23holiday%40group.v.calendar.google.com/events?key={$apiKey}");
            $this->data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param int $year
     * @return array
     */
    public function getDataForYear(int $year): array
    {
        return array_reduce($this->getItems(), static function ($holidays, $item) use ($year) {
            if (FALSE !== strpos($item['start']['date'], $year)) {
                $holidays[] = $item;
            }
            return $holidays;
        }, []);
    }

    /**
     * @return array
     */
    private function getItems(): array
    {
        return $this->data['items'];
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return array_reduce($this->getItems(), static function ($holidays, $item) {
            $holidays[] = [
                'name' => $item['summary'],
                'date' => $item['start']['date'],
            ];

            return $holidays;
        }, []);
    }

}