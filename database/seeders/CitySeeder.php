<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City; // Import the City model

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the list of cities, ensuring there are no duplicates
        $cities = [
            'Lahore',
            'Karachi',
            'Islamabad',
            'Faisalabad',
            'Rawalpindi',
            'Multan',
            'Gujranwala',
            'Sialkot',
            'Bahawalpur',
            'Peshawar',
            'Hyderabad',
            'Quetta',
            'Abbottabad',
            'Mardan',
            'Sukkur',
            'Larkana',
            'Mirpurkhas',
            'Gwadar',
            'Swat',
            'Dera Ismail Khan',
            'Nawabshah',
            'Nowshera',
            'Jhang',
            'Sargodha',
            'Khuzdar',
            'Kasur',
            'Sheikhupura',
            'Okara',
            'Rahim Yar Khan',
            'Chiniot',
            'Attock',
            'Kamoke',
            'Batagram',
            'Hangu',
            'Kohat',
            'Dera Ghazi Khan',
            'Tando Allahyar',
            'Tando Adam',
            'Jacobabad',
            'Sahiwal',
            'Muzaffarabad',
            'Mirpur (AJK)',
            'Kotli (AJK)',
            'Skardu',
            'Hunza',
            'Ghotki',
            'Dadu',
            'Mandi Bahauddin',
            'Mianwali',
            'Gujrat',
            'Jhelum',
            'Khanewal',
            'Hafizabad',
            'Bhakkar',
            'Narowal',
            'Khanpur',
            'Chakwal',
            'Chaman',
            'Zhob',
            'Kalat',
            'Sibi',
            'Naseerabad',
            'Loralai',
            'Kharan',
            'Qila Abdullah',
            'Ziarat',
            'Dera Bugti',
            'Lasbela',
            'Pishin',
            'Dera Murad Jamali',
            'Panjgur',
            'Gilgit',
            'Gupis',
            'Astore',
            'Chitral',
            'Dir',
            'Mansehra',
            'Battagram',
            'Bannu',
            'Tank',
        ];

        // Insert each unique city into the database
        foreach ($cities as $cityName) {
            City::create(['city_name' => $cityName]);
        }
    }
}