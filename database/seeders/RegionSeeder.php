<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region; // Import the Region model

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            // Lahore
            ['city_id' => 1, 'region_name' => 'Gulberg'],
            ['city_id' => 1, 'region_name' => 'Model Town'],
            ['city_id' => 1, 'region_name' => 'Defense'],
            ['city_id' => 1, 'region_name' => 'Allama Iqbal Town'],
            ['city_id' => 1, 'region_name' => 'Johar Town'],

            // Karachi
            ['city_id' => 2, 'region_name' => 'Clifton'],
            ['city_id' => 2, 'region_name' => 'Korangi'],
            ['city_id' => 2, 'region_name' => 'Nazimabad'],
            ['city_id' => 2, 'region_name' => 'Gulshan-e-Iqbal'],
            ['city_id' => 2, 'region_name' => 'Faisal Cantonment'],

            // Islamabad
            ['city_id' => 3, 'region_name' => 'F-6'],
            ['city_id' => 3, 'region_name' => 'F-7'],
            ['city_id' => 3, 'region_name' => 'G-9'],
            ['city_id' => 3, 'region_name' => 'G-11'],
            ['city_id' => 3, 'region_name' => 'I-8'],

            // Faisalabad
            ['city_id' => 4, 'region_name' => 'Samanabad'],
            ['city_id' => 4, 'region_name' => 'Madina Town'],
            ['city_id' => 4, 'region_name' => 'D Ground'],
            ['city_id' => 4, 'region_name' => 'Faisal Town'],
            ['city_id' => 4, 'region_name' => 'Iqbal Town'],

            // Rawalpindi
            ['city_id' => 5, 'region_name' => 'Murray Road'],
            ['city_id' => 5, 'region_name' => 'Satellite Town'],
            ['city_id' => 5, 'region_name' => 'Westridge'],
            ['city_id' => 5, 'region_name' => 'Liaquat Bagh'],
            ['city_id' => 5, 'region_name' => 'Chaklala'],

            // Multan
            ['city_id' => 6, 'region_name' => 'Liaquatabad'],
            ['city_id' => 6, 'region_name' => 'Bahar Colony'],
            ['city_id' => 6, 'region_name' => 'Shah Rukh Neelum'],
            ['city_id' => 6, 'region_name' => 'Kachehri'],
            ['city_id' => 6, 'region_name' => 'Pakpattan'],

            // Gujranwala
            ['city_id' => 7, 'region_name' => 'Allama Iqbal'],
            ['city_id' => 7, 'region_name' => 'Al-Madina'],
            ['city_id' => 7, 'region_name' => 'Al-Khalid'],
            ['city_id' => 7, 'region_name' => 'Gujranwala City'],
            ['city_id' => 7, 'region_name' => 'Gujranwala Chowk'],

            // Sialkot
            ['city_id' => 8, 'region_name' => 'Allama Iqbal Town Sialkot'],
            ['city_id' => 8, 'region_name' => 'Chowk Sialkot'],
            ['city_id' => 8, 'region_name' => 'Daska Road'],
            ['city_id' => 8, 'region_name' => 'Pasrur'],
            ['city_id' => 8, 'region_name' => 'Sialkot Cantt'],

            // Bahawalpur
            ['city_id' => 9, 'region_name' => 'Bahatwala'],
            ['city_id' => 9, 'region_name' => 'Bahawalpur City'],
            ['city_id' => 9, 'region_name' => 'Sadar Bahawalpur'],
            ['city_id' => 9, 'region_name' => 'Islamia University'],
            ['city_id' => 9, 'region_name' => 'Nawab Bahawal Khan'],

            // Peshawar
            ['city_id' => 10, 'region_name' => 'University Town'],
            ['city_id' => 10, 'region_name' => 'Ring Road Peshawar'],
            ['city_id' => 10, 'region_name' => 'Peshawar Cantt'],
            ['city_id' => 10, 'region_name' => 'Hayatabad'],
            ['city_id' => 10, 'region_name' => 'Charsadda Road'],

            // Hyderabad
            ['city_id' => 11, 'region_name' => 'Qasimabad'],
            ['city_id' => 11, 'region_name' => 'Latifabad'],
            ['city_id' => 11, 'region_name' => 'Auto Bhan Road'],
            ['city_id' => 11, 'region_name' => 'Sadar'],
            ['city_id' => 11, 'region_name' => 'Kacheri'],

            // Quetta
            ['city_id' => 12, 'region_name' => 'Saryab'],
            ['city_id' => 12, 'region_name' => 'Hana Road'],
            ['city_id' => 12, 'region_name' => 'Jinnah Road'],
            ['city_id' => 12, 'region_name' => 'Airport Road'],
            ['city_id' => 12, 'region_name' => 'Kachhi Abadi'],

            // Abbottabad
            ['city_id' => 13, 'region_name' => 'Khanaspur'],
            ['city_id' => 13, 'region_name' => 'Mirpur'],
            ['city_id' => 13, 'region_name' => 'Thandiani'],
            ['city_id' => 13, 'region_name' => 'Havelian'],
            ['city_id' => 13, 'region_name' => 'Khanaspur'],

            // Mardan
            ['city_id' => 14, 'region_name' => 'Mardan Cantt'],
            ['city_id' => 14, 'region_name' => 'Khanpur'],
            ['city_id' => 14, 'region_name' => 'Ghalibabad'],
            ['city_id' => 14, 'region_name' => 'Nowshera'],
            ['city_id' => 14, 'region_name' => 'Takkar'],

            // Sukkur
            ['city_id' => 15, 'region_name' => 'Kandhra'],
            ['city_id' => 15, 'region_name' => 'Sukkur City'],
            ['city_id' => 15, 'region_name' => 'Pano Aqil'],
            ['city_id' => 15, 'region_name' => 'Rohri'],
            ['city_id' => 15, 'region_name' => 'Shikarpur'],

            // Larkana
            ['city_id' => 16, 'region_name' => 'Larkana City'],
            ['city_id' => 16, 'region_name' => 'Ratodero'],
            ['city_id' => 16, 'region_name' => 'Dokri'],
            ['city_id' => 16, 'region_name' => 'Sujawal'],
            ['city_id' => 16, 'region_name' => 'Nawabshah'],

            // Mirpurkhas
            ['city_id' => 17, 'region_name' => 'Mirpurkhas City'],
            ['city_id' => 17, 'region_name' => 'Kot Ghulam Muhammad'],
            ['city_id' => 17, 'region_name' => 'Shahdadpur'],
            ['city_id' => 17, 'region_name' => 'Digri'],
            ['city_id' => 17, 'region_name' => 'Sanghar'],

            // Gwadar
            ['city_id' => 18, 'region_name' => 'Gwadar City'],
            ['city_id' => 18, 'region_name' => 'Pasni'],
            ['city_id' => 18, 'region_name' => 'Jewani'],
            ['city_id' => 18, 'region_name' => 'Turbat'],
            ['city_id' => 18, 'region_name' => 'Kech'],

            // Swat
            ['city_id' => 19, 'region_name' => 'Mingora'],
            ['city_id' => 19, 'region_name' => 'Bahrain'],
            ['city_id' => 19, 'region_name' => 'Kalam'],
            ['city_id' => 19, 'region_name' => 'Charbagh'],
            ['city_id' => 19, 'region_name' => 'Barikot'],

            // Dera Ismail Khan
            ['city_id' => 20, 'region_name' => 'Dera Ismail Khan City'],
            ['city_id' => 20, 'region_name' => 'Paharpur'],
            ['city_id' => 20, 'region_name' => 'Darazinda'],
            ['city_id' => 20, 'region_name' => 'Tota'],
            ['city_id' => 20, 'region_name' => 'Ghani Bacha'],


            ['city_id' => 21, 'region_name' => 'Jhelum City'],
            ['city_id' => 21, 'region_name' => 'Mirpur'],
            ['city_id' => 21, 'region_name' => 'Kharian'],
            ['city_id' => 21, 'region_name' => 'Dina'],
            ['city_id' => 21, 'region_name' => 'Shahkot'],

            // Sheikhupura
            ['city_id' => 22, 'region_name' => 'Sheikhupura City'],
            ['city_id' => 22, 'region_name' => 'Faisalabad Road'],
            ['city_id' => 22, 'region_name' => 'Kot Abdul Malik'],
            ['city_id' => 22, 'region_name' => 'Baddomalhi'],
            ['city_id' => 22, 'region_name' => 'Gohar Shahi'],

            // Sargodha
            ['city_id' => 23, 'region_name' => 'Sargodha City'],
            ['city_id' => 23, 'region_name' => 'Gulberg'],
            ['city_id' => 23, 'region_name' => 'Malkhanwala'],
            ['city_id' => 23, 'region_name' => 'Haq Nawaz'],
            ['city_id' => 23, 'region_name' => 'Aam Khas'],

            // Attock
            ['city_id' => 24, 'region_name' => 'Attock City'],
            ['city_id' => 24, 'region_name' => 'Jand'],
            ['city_id' => 24, 'region_name' => 'Hazro'],
            ['city_id' => 24, 'region_name' => 'Pindigheb'],
            ['city_id' => 24, 'region_name' => 'Makhad'],

            // Kasur
            ['city_id' => 25, 'region_name' => 'Kasur City'],
            ['city_id' => 25, 'region_name' => 'Raiwind'],
            ['city_id' => 25, 'region_name' => 'Pattoki'],
            ['city_id' => 25, 'region_name' => 'Khudian'],
            ['city_id' => 25, 'region_name' => 'Sakhi Sarwar'],

            // Mandi Bahauddin
            ['city_id' => 26, 'region_name' => 'Mandi Bahauddin City'],
            ['city_id' => 26, 'region_name' => 'Mandi Khas'],
            ['city_id' => 26, 'region_name' => 'Malakwal'],
            ['city_id' => 26, 'region_name' => 'Phalia'],
            ['city_id' => 26, 'region_name' => 'Naseerabad'],

            // Narowal
            ['city_id' => 27, 'region_name' => 'Narowal City'],
            ['city_id' => 27, 'region_name' => 'Shakargarh'],
            ['city_id' => 27, 'region_name' => 'Daska'],
            ['city_id' => 27, 'region_name' => 'Zafarwal'],
            ['city_id' => 27, 'region_name' => 'Waris Shah'],

            // Khushab
            ['city_id' => 28, 'region_name' => 'Khushab City'],
            ['city_id' => 28, 'region_name' => 'Noor Pur'],
            ['city_id' => 28, 'region_name' => 'Jauharabad'],
            ['city_id' => 28, 'region_name' => 'Mithra'],
            ['city_id' => 28, 'region_name' => 'Kehli Rattan'],

            // Sahiwal
            ['city_id' => 29, 'region_name' => 'Sahiwal City'],
            ['city_id' => 29, 'region_name' => 'Chichawatni'],
            ['city_id' => 29, 'region_name' => 'Kahror Pakka'],
            ['city_id' => 29, 'region_name' => 'Pakpattan'],
            ['city_id' => 29, 'region_name' => 'Arifwala'],

            // Thatta
            ['city_id' => 30, 'region_name' => 'Thatta City'],
            ['city_id' => 30, 'region_name' => 'Makli'],
            ['city_id' => 30, 'region_name' => 'Jati'],
            ['city_id' => 30, 'region_name' => 'Ghorabari'],
            ['city_id' => 30, 'region_name' => 'Keti Bunder'],


            ['city_id' => 31, 'region_name' => 'Nankana Sahib City'],
            ['city_id' => 31, 'region_name' => 'Sangla Hill'],
            ['city_id' => 31, 'region_name' => 'Shahkot'],
            ['city_id' => 31, 'region_name' => 'Buddhu Sukh'],
            ['city_id' => 31, 'region_name' => 'Kamoke'],

            // Mianwali
            ['city_id' => 32, 'region_name' => 'Mianwali City'],
            ['city_id' => 32, 'region_name' => 'Isakhel'],
            ['city_id' => 32, 'region_name' => 'Piplan'],
            ['city_id' => 32, 'region_name' => 'Makhad'],
            ['city_id' => 32, 'region_name' => 'Kalabagh'],

            // Shikarpur
            ['city_id' => 33, 'region_name' => 'Shikarpur City'],
            ['city_id' => 33, 'region_name' => 'Lakhi Ghulam Shah'],
            ['city_id' => 33, 'region_name' => 'Khanpur'],
            ['city_id' => 33, 'region_name' => 'Garhi Yasin'],
            ['city_id' => 33, 'region_name' => 'Sakrand'],

            // Khairpur
            ['city_id' => 34, 'region_name' => 'Khairpur City'],
            ['city_id' => 34, 'region_name' => 'Faiz Ganj'],
            ['city_id' => 34, 'region_name' => 'Kot Diji'],
            ['city_id' => 34, 'region_name' => 'Nao Sharif'],
            ['city_id' => 34, 'region_name' => 'Thari Mirwah'],

            // Jhang
            ['city_id' => 35, 'region_name' => 'Jhang City'],
            ['city_id' => 35, 'region_name' => 'Ahmadpur Sial'],
            ['city_id' => 35, 'region_name' => 'Shahkot'],
            ['city_id' => 35, 'region_name' => 'Chiniot'],
            ['city_id' => 35, 'region_name' => 'Mandi Shah Jewna'],

            // Bhakkar
            ['city_id' => 36, 'region_name' => 'Bhakkar City'],
            ['city_id' => 36, 'region_name' => 'Darya Khan'],
            ['city_id' => 36, 'region_name' => 'Dahranwala'],
            ['city_id' => 36, 'region_name' => 'Mankera'],
            ['city_id' => 36, 'region_name' => 'Kachhi Kacheri'],

            // Layyah
            ['city_id' => 37, 'region_name' => 'Layyah City'],
            ['city_id' => 37, 'region_name' => 'Chaubara'],
            ['city_id' => 37, 'region_name' => 'Karor Lal Esan'],
            ['city_id' => 37, 'region_name' => 'Fatehpur'],
            ['city_id' => 37, 'region_name' => 'Tareem'],

            // Tando Allahyar
            ['city_id' => 38, 'region_name' => 'Tando Allahyar City'],
            ['city_id' => 38, 'region_name' => 'Tando Jam'],
            ['city_id' => 38, 'region_name' => 'Sakrand'],
            ['city_id' => 38, 'region_name' => 'Shadi Palli'],
            ['city_id' => 38, 'region_name' => 'Dhoronaro'],

            // Hala
            ['city_id' => 39, 'region_name' => 'Hala City'],
            ['city_id' => 39, 'region_name' => 'Hala Naka'],
            ['city_id' => 39, 'region_name' => 'Bhit Shah'],
            ['city_id' => 39, 'region_name' => 'Jhando Mari'],
            ['city_id' => 39, 'region_name' => 'Khairpur Nathan Shah'],

            // Sukkur
            ['city_id' => 40, 'region_name' => 'Sukkur City'],
            ['city_id' => 40, 'region_name' => 'Pano Aqil'],
            ['city_id' => 40, 'region_name' => 'Rohri'],
            ['city_id' => 40, 'region_name' => 'Saleh Pat'],
            ['city_id' => 40, 'region_name' => 'Dokri'],
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}