# LiteracyPro
## Test for LiteracyPro - Uses PHP with Laravel

This project was created using php 7.1.4 and Laravel 5. For best results, use the latest version of Chrome though it should work fine on most browsers.

For Task #2:

The tables as an EAV model would look like such:

EAV table
===============================================================
| id | fk_id | attribute        | value                       |
===============================================================
| 1  | 1     | band_name        | Pink Floyd                  |
| 2  | 1     | start_date       | 1965                        |
| 3  | 1     | website          | http://pinkfloyd.com        |
| 4  | 1     | still_active     | no                          |
| 5  | 2     | name             | Led Zeppelin                |
| 6  | 2     | start_date       | 1968                        |
| 7  | 2     | website          | http://ledzeppelin.com      |
| 8  | 2     | still_active     | no                          |
| 9  | 3     | band_id          | 1                           | 
| 10 | 3     | album_name       | Dark Side of the Moon       |
| 11 | 3     | recorded_date    | March 1, 1973               |
| 12 | 3     | release_date     | March 1, 1973               |
| 8  | 3     | number_of_tracks | 8                           |
| 9  | 3     | label            | Harvest Records             | 
| 10 | 3     | producer         | Dark Side of the Moon       |
| 11 | 3     | genre            | Rock                        |
---------------------------------------------------------------




