<?php

namespace Database\Seeders;
use App\Models\Country;
use App\Models\City;
use App\Models\Area;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $data = [
            'Egypt' => [
                'Cairo' => [
                    'Abbassia',
                    'Ain Shams',
                    'Al-Wayli and al-Daher',
                    'Azbakeya',
                    'Bab al-Louq',
                    'Boulaq',
                    'Coptic Cairo',
                    'Downtown Cairo',
                    'El Manial',
                    'El Marg',
                    'El Matareya, Cairo',
                    'El Qobbah',
                    'El Rehab',
                    'El Sahel',
                    'El Sakkakini',
                    'Ezbet El Haggana',
                    'Ezbet El Nakhl',
                    'Faggala',
                    'Fifth Settlement',
                    'Fustat',
                    'Garden City, Cairo',
                    'Gezira (Cairo)',
                    'Heliopolis, Cairo',
                    'Islamic Cairo',
                    'Maadi',
                    'Old Cairo',
                    'Roda Island',
                    'Shubra (administrative region)',
                    'Shubra',
                    'Shubra El Kheima',
                    'Wagh El Birket',
                    'Zamalek',
                    'Zeitoun',
                    'Garden City',
                    'Al-Sayeda Zainab',
                    'Al-Khalifa',
                    'Mokattam',
                    'Al-Basateen',
                    'Dar Al-Salaam',
                    'Tura',
                    'Helwan',
                    'Al-Tebbin',
                    'May 15th',
                    'New Cairo',
                ],
                'Giza' => [
                    'Imbaba',
                    'Agouza',
                    'Dokki',
                    '6 October ',
                    'Warraq',
                    'Shaykh Zâyid',
                    'Haram',
                    'Monib',
                    'Mohandsen',
                    'Al Saf',
                    'Al Hawamdya',
                    'Monshaat Al Kanater',
                    'Auseem ',
                    'Kerdasa ',
                    'Abo Al Nomros',
                    'Ayaat ',
                ],
                'Alexandria' => [
                    'Al Hadrah Qebli',
                    'Amreya',
                    'Anfoushi',
                    'Asafra',
                    'Azarita',
                    'Bahary',
                    'Bakos, Alexandria',
                    'Baucalis',
                    'Bolkly',
                    'Camp Chezar',
                    'Cleopatra (neighborhood)',
                    'Dekhela',
                    'Downtown, Alexandria',
                    'El Atareen',
                    'El Gomrok',
                    'El Ibrahimiya (neighborhood)',
                    'El Labban',
                    'El Maamora Beach',
                    'El Maamora, Alexandria',
                    'El Mandara',
                    'El Manshiyya',
                    'El Max, Alexandria',
                    'El Qabary',
                    'El Saraya (neighborhood)',
                    'El Soyof',
                    'Fleming (neighborhood)',
                    'Gianaclis',
                    'Glim',
                    'Kafr Abdu',
                    'Karmoz',
                    'Kom El Deka',
                    'Louran (neighborhood)',
                    'Louran, Alexandria',
                    'Mahatet El Raml',
                    'Miami (neighborhood)',
                    'Moharam Bek',
                    'Montaza',
                    'Roshdy',
                    'Saba Pasha',
                    'Safar (neighborhood)',
                    'San Stefano (neighborhood)',
                    'Shatby',
                    'Shods',
                    'Sidi Bishr',
                    'Sidi Gaber',
                    'Smouha',
                    'Sporting (neighborhood)',
                    'Stanley (neighborhood)',
                    'Tharwat',
                    'Victoria (neighborhood)',
                    'Wardeyan',
                    'Zezenia',
                ],
                'Aswan' => [
                    'Kom Ombo',
                    'Edfu',
                    'Daraw',
                    'Al-Basaliyah Bahri',
                    'As-Sibaiyah Gharb',
                ],
                'Asyut' => [
                    'Manfalut',
                    'Dairut',
                    'Abu Tig',
                    'Qis',
                    'Abnub',
                    'El-Ghanayem',
                    'El-Badari',
                    'Sahel Selim',
                    'Sedfa',
                ],
                'Beheira' => [
                    'Damanhur',
                    'Kafr el-Dawwar',
                    'Edko',
                    'Rosetta',
                    'Hosh Issa',
                    'Abul Matamir',
                    'El-Delengat',
                    'Etay el-Barud',
                    'Abu Hummus',
                    'Kom Hamadah',
                    'El-Rahmaniyah',
                    'Shubrakhit',
                    'El-Mahmoudiyah',
                    'Wadi al-Natrun',
                    'Badr',
                ],
                'Beni Suef' => [
                    'Bush',
                    'Al-Fashn',
                    'Biba',
                    'Sumusta al-Waqf',
                    'Al-Wasta',
                    'Ihnasiya',
                    'New Beni Suef',
                ],
                'Dakahlia' => [
                    'El Mansoura',
                    'Mit Ghamr',
                    'El-Matareya',
                    'Bilqas',
                    'Senbellawein',
                    'Talkha',
                    'Manzala',
                    'Dikirnis',
                    'El-Gamalia',
                    'Minyet al-Nasr',
                    'Sherbin',
                    'Nabaroh',
                    'Mit Salsil',
                    'Bani Ubayd',
                    'Aga',
                ],
                'Damietta' => [
                    'Ezbet el-Borg',
                    'Faraskur',
                    'Kafr el-Batikh',
                    'New Damietta City',
                    'Kafr Saad',
                    'As-Sarw',
                    'Ar-Ruda',
                    'Al-Zarqa',
                ],
                'Fayoum' => [
                    'Senuris',
                    'Ibshawai',
                    'Tamiya',
                    'Itsa',
                    'Yusuf as-Siddiq',
                ],
                'Gharbia' => [
                    'El Mahalla el Kubra',
                    'Tanta',
                    'Zifta',
                    'Kafr al-Zayat',
                    'Samannoud',
                    'Basyoun',
                    'El-Santa',
                    'Kotoor',
                ],
                'Ismailia' => [
                    'At-Tall al-Kabir',
                    'El-Qantara',
                    'Abu Suweir-el-Mahatta',
                    'Fayed',
                    'El-Qantara ash-Sharqiya',
                ],
                'Kafr el-Sheikh' => [
                    'Desouk',
                    'Beila',
                    'Fuwa',
                    'Al-Hamool',
                    'Sidi Salem',
                    'Baltim',
                    'Qallin',
                    'Metoubes',
                    'Riyadh',
                ],
                'Luxor' => [
                    'Al-Bayadiyah',
                ],
                'Matruh' => [
                    'Al-Hammam',
                    'Sidi Barrani',
                    'Ad-Dabah',
                    'Siwa',
                ],
                'El-Minya' => [
                    'Mallawi',
                    'Samalut',
                    'Beni Mazar',
                    'Maghagha',
                    'Abu Qirqas',
                    'Matai',
                    'Deir Mawas',
                    'El-Idwa',
                ],
                'Monufia' => [
                    'Shibin el-Kom',
                    'Menouf',
                    'Ashmoun',
                    'Sers el-Lyan',
                    'Tala',
                    'Ash-Shuhada',
                    'Sadat City',
                    'Quesna',
                    'Bagour',
                    'Birkat al-Sab',
                ],
                'New Valley' => [
                    'Kharga',
                    'Mut',
                ],
                'North Sinai' => [
                    'El Arish',
                    'Rafah',
                    'Ash-Shaykh Zawid',
                ],
                'Port Said' => [
                    'Port Said',
                ],
                'Qalyubia' => [
                    'Shubra el-Khema',
                    'Khusus',
                    'Banha',
                    'Qalyub',
                    'El-Kanater al-Khiria',
                    'Khanka',
                    'Shibin al-Qanater',
                    'El Ubour',
                    'Tukh',
                    'Qaha',
                    'Kafr Shukr',
                ],
                'Qena' => [
                    'Armant',
                    'Esna',
                    'Qus',
                    'Dishna',
                    'Farshut',
                    'Naj Hammadi',
                    'Al-Waqf',
                    'Qift',
                    'Naqadah',
                ],
                'Red Sea' => [
                    'Hurghada',
                    'Al-Quseir',
                    'Safaga',
                    'Ras Gharib',
                ],
                'Sharqia' => [
                    'Zagazig',
                    'Belbeis',
                    '10th of Ramadan City',
                    'Abu Kabir',
                    'Faqous',
                    'Al-Kareen',
                    'Minya al-Qamh',
                    'Drib Nigm',
                    'Mashtul el-Sook',
                    'Hehya',
                    'Al-Kanayat',
                    'Abu Hammad',
                    'Al-Ibrahimiya',
                    'Al-Husseinieh',
                    'Kafr Saqr',
                    'Awlad Saqr',
                    'New Salhia',
                ],
                'Sohag' => [
                    'Girga',
                    'Akhmim',
                    'Tahta',
                    'Tima',
                    'Al-Mansha',
                    'Al-Baliyana',
                    'Juhayna',
                    'Al-Maragha',
                    'Dar as-Salam',
                    'Saqultah',
                ],
                'South Sinai' => [
                    'Sharm el-Sheikh',
                    'Al-Tur',
                ],
                'Suez' => [
                    'Suez',
                ],
            ],

            'Algeria' => [],
            'Bahrain' => [],
            'Iraq' => [],
            'Jordan' => [],
            'Kuwait' => [],
            'Lebanon' => [],
            'Libya' => [],
            'Mauritania' => [],
            'Morocco' => [],
            'Oman' => [],
            'Palestine' => [],
            'Qatar' => [],
            'Saudi Arabia' => [],
            'Sudan' => [],
            'Syria' => [],
            'Tunisia' => [],
            'United Arab Emirates' => [],
            'Yemen' => [],
        ];








        foreach($data as $countryname => $country){
            $created_country = Country::create([
                'name' => $countryname
            ]);

            if(count($country) > 0 ){
                foreach($country as $cityname => $city){
                    $created_city = City::create([
                        'name' => $cityname,
                        'country_id' => $created_country->id,
                    ]);
                    if($city){
                        foreach($city as $area){
                            // $geo_address = get_latitude_longitude($area, $cityname, $countryname);
                            $geo_address = ['lat' =>  null, 'lon' => null];
                            $lat = $geo_address['lat'];
                            $lon = $geo_address['lon'];
                            $created_area = Area::create([
                                'name' => $area,
                                'lat' => $lat,
                                'lon' => $lon,
                                'country_id' => $created_country->id,
                                'city_id' => $created_city->id,
                            ]);
                        }
                    }
                }
            }

        }
    }
}
