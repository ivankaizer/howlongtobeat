# howlongtobeat

![](https://github.com/ivankayzer/howlongtobeat/workflows/PHP%20Workflow/badge.svg)
![](https://img.shields.io/codeclimate/maintainability-percentage/ivankayzer/howlongtobeat)

## About
howlongtobeat provides information and data about games and how long it will take to finish them.

This library is a simple wrapper to fetch data from howlongtobeat.com. Please check their website and support them if you like what they are doing.

## Install

Use the package manager [composer](https://getcomposer.org/download/) to install howlongtobeat.

```bash
composer require ivankayzer/howlongtobeat
```

## Usage

#### Search

```php
use IvanKayzer\HowLongToBeat\HowLongToBeat;

$hl2b = new HowLongToBeat();
$hl2b->search('Lego');
```

returns

```js

{
  "Results": [
    {
      "ID": "5265",
      "Image": "https://howlongtobeat.com/gameimages/220px-Lego_Lord_of_the_Rings_cover.jpg",
      "Title": "LEGO The Lord of the Rings: The Video Game",
      "Time": {
        "Main Story": "10 Hours",
        "Main + Extra": "16 Hours",
        "Completionist": "33 Hours"
      }
    },
    {
      "ID": "5263",
      "Image": "https://howlongtobeat.com/gameimages/256px-Lego_Star_Wars-The_Complete_Saga.jpg",
      "Title": "LEGO Star Wars: The Complete Saga",
      "Time": {
        "Main Story": "14 Hours",
        "Main + Extra": "23 Hours",
        "Completionist": "39.5 Hours"
      }
    },
    {
      "ID": "16635",
      "Image": "https://howlongtobeat.com/gameimages/LegoTheHobbit.jpg",
      "Title": "LEGO The Hobbit",
      "Time": {
        "Main Story": "9 Hours",
        "Main + Extra": "16 Hours",
        "Completionist": "35.5 Hours"
      }
    },
  ...
  ],
  "Pagination": {
    "Current Page": 1,
    "Last Page": 4
  }
}
```

You can also pass a page number as a second argument to ``` search ```:

```php
$hl2b->search('Lego', 2);
```

<br>


#### Get time entries by game ID

```php
use IvanKayzer\HowLongToBeat\HowLongToBeat;

$hl2b = new HowLongToBeat();
$hl2b->search(5265);
```

returns

```js
{
  "ID": 5265,
  "Title": "LEGO The Lord of the Rings: The Video Game",
  "Image": "https://howlongtobeat.com/gameimages/220px-Lego_Lord_of_the_Rings_cover.jpg",
  "Description": "LEGO The Lord of the Rings is based on The Lord of the Rings motion picture trilogy and follows the original storylines of The Lord of the Rings: The Fellowship of the Ring, The Lord of the Rings: The Two Towers, and The Lord of the Rings: The Return of the King. Now the entire family can team up in pairs as adorable LEGO The Lord the Rings minifigures to experience countless dangers, solve riddles and battle formidable foes on their journey to Mount Doom.",
  "Developer": "Traveller's Tales",
  "Publisher": "Warner Bros. Interactive Entertainment",
  "Last Update": "4 Hours Ago",
  "Playable On": "PC, Nintendo 3DS, Nintendo DS, PlayStation 3, PlayStation Vita, Wii, Wii U, Xbox 360, Xbox One",
  "Genres": "Action, Adventure, Open World",
  "Statistics": {
    "Playing": "220",
    "Backlogs": "2300",
    "Replays": "34",
    "Retired": "5%",
    "Rating": "75%",
    "Beat": "1100"
  },
  "Summary": [
    {
      "Title": null,
      "Time": {
        "Main Story": "10 Hours",
        "Main + Extras": "16 Hours",
        "Completionist": "33 Hours",
        "All Styles": "17.5 Hours"
      }
    }
  ],
  "Single-Player": {
    "Main Story": {
      "Polled": "182",
      "Average": "9h 55m",
      "Median": "10h",
      "Rushed": "7h 25m",
      "Leisure": "14h 58m"
    },
    "Main + Extras": {
      "Polled": "109",
      "Average": "16h 48m",
      "Median": "15h",
      "Rushed": "11h 23m",
      "Leisure": "27h 57m"
    },
  ...
  },
  "Speedrun": {
    "Any%": {
      "Polled": "2",
      "Average": "4h 51m 43s",
      "Median": "4h 51m 43s",
      "Fastest": "4h 23m 56s",
      "Slowest": "5h 19m 30s"
    }
  },
  "Multi-Player": {
    "Co-Op": {
      "Polled": "14",
      "Average": "17h 12m",
      "Median": "13h 27m",
      "Least": "10h 54m",
      "Most": "28h 15m"
    }
  },
  "Platform": {
    "Nintendo 3DS": {
      "Polled": "24",
      "Main": "9h 34m",
      "Main +": "21h 15m",
      "100%": "22h 56m",
      "Fastest": "4h 52m",
      "Longest": "60h"
    },
  ...
  }
}
```


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)