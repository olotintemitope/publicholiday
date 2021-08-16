# Public Holiday
This package uses the Google Calendar API to fetch public holidays.
The data always comes with 3 years data; the previous year, the current year and next year.

# How to use
- `composer require topaz/holidays`
- Register for an API key on Google console [https://phpcoder.tech/get-list-of-holidays-using-google-calendar-api/](https://phpcoder.tech/get-list-of-holidays-using-google-calendar-api/)
- Add your key to your `.env` file
- Import `LazHoliday\PublicHoliday`

## Sample Usage

```php
<?php
require_once 'vendor/autoload.php';

use LazHoliday\PublicHoliday;

try {
    $holiday = new PublicHoliday();
    var_dump($holiday->fetch('usa')->getDataForYear(2021));
} catch (Exception $e) {
    var_dump($e->getMessage());
}
```

### Available methods
- fetch(string $country): PublicHoliday - Get all the calendar data when a country is passed
- getData(): array - Return all the 3 years calendar data with some info
- getItems(): array - Return all the 3 years calendar data
- getDataForYear(int $year): array - Filter holiday data by year
- getSummary(): array - Get the summary and dates of the holidays

## License
--- 
This project uses the MIT License feel free to contribute.