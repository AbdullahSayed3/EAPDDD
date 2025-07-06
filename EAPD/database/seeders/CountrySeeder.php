<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    $data = [
    [
        'name_ar' => 'هيئة دولية',
        'name_en' => 'International Body',
        'name_fr' => 'Organisme International',
        'code' => 'EGGOVERN',
        'lat' => null,
        'lng' => null
    ],
    [
        'name_ar' => 'جزر أولان',
        'name_en' => 'Åland Islands',
        'name_fr' => 'Îles Åland',
        'code' => 'AX',
        'lat' => 60.1785,
        'lng' => 19.9156
    ],
    [
        'name_ar' => 'ألبانيا',
        'name_en' => 'Albania',
        'name_fr' => 'Albanie',
        'code' => 'AL',
        'lat' => 41.1533,
        'lng' => 20.1683
    ],
    [
        'name_ar' => 'الجزائر',
        'name_en' => 'Algeria',
        'name_fr' => 'Algérie',
        'code' => 'DZ',
        'lat' => 28.0339,
        'lng' => 1.6596
    ],
    [
        'name_ar' => 'ساموا الأمريكية',
        'name_en' => 'American Samoa',
        'name_fr' => 'Samoa américaines',
        'code' => 'AS',
        'lat' => -14.2710,
        'lng' => -170.1322
    ],
    [
        'name_ar' => 'أندورا',
        'name_en' => 'Andorra',
        'name_fr' => 'Andorre',
        'code' => 'AD',
        'lat' => 42.5462,
        'lng' => 1.6016
    ],
    [
        'name_ar' => 'أنجولا',
        'name_en' => 'Angola',
        'name_fr' => 'Angola',
        'code' => 'AO',
        'lat' => -11.2027,
        'lng' => 17.8739
    ],
    [
        'name_ar' => 'أنجويلا',
        'name_en' => 'Anguilla',
        'name_fr' => 'Anguilla',
        'code' => 'AI',
        'lat' => 18.2206,
        'lng' => -63.0686
    ],
    [
        'name_ar' => 'القارة القطبية الجنوبية',
        'name_en' => 'Antarctica',
        'name_fr' => 'Antarctique',
        'code' => 'AQ',
        'lat' => -75.2509,
        'lng' => -0.0713
    ],
    [
        'name_ar' => 'أنتيغوا وباربودا',
        'name_en' => 'Antigua and Barbuda',
        'name_fr' => 'Antigua-et-Barbuda',
        'code' => 'AG',
        'lat' => 17.0608,
        'lng' => -61.7964
    ],
    [
        'name_ar' => 'الأرجنتين',
        'name_en' => 'Argentina',
        'name_fr' => 'Argentine',
        'code' => 'AR',
        'lat' => -38.4161,
        'lng' => -63.6167
    ],
    [
        'name_ar' => 'أرمينيا',
        'name_en' => 'Armenia',
        'name_fr' => 'Arménie',
        'code' => 'AM',
        'lat' => 40.0691,
        'lng' => 45.0382
    ],
    [
        'name_ar' => 'آروبا',
        'name_en' => 'Aruba',
        'name_fr' => 'Aruba',
        'code' => 'AW',
        'lat' => 12.5211,
        'lng' => -69.9683
    ],
    [
        'name_ar' => 'جزيرة أسينشين',
        'name_en' => 'Ascension Island',
        'name_fr' => 'Île de l\'Ascension',
        'code' => 'AC',
        'lat' => -7.9467,
        'lng' => -14.3559
    ],
    [
        'name_ar' => 'أستراليا',
        'name_en' => 'Australia',
        'name_fr' => 'Australie',
        'code' => 'AU',
        'lat' => -25.2744,
        'lng' => 133.7751
    ],
    [
        'name_ar' => 'النمسا',
        'name_en' => 'Austria',
        'name_fr' => 'Autriche',
        'code' => 'AT',
        'lat' => 47.5162,
        'lng' => 14.5501
    ],
    [
        'name_ar' => 'أذربيجان',
        'name_en' => 'Azerbaijan',
        'name_fr' => 'Azerbaïdjan',
        'code' => 'AZ',
        'lat' => 40.1431,
        'lng' => 47.5769
    ],
    [
        'name_ar' => 'جزر البهاما',
        'name_en' => 'Bahamas',
        'name_fr' => 'Bahamas',
        'code' => 'BS',
        'lat' => 25.0343,
        'lng' => -77.3963
    ],
    [
        'name_ar' => 'البحرين',
        'name_en' => 'Bahrain',
        'name_fr' => 'Bahreïn',
        'code' => 'BH',
        'lat' => 25.9304,
        'lng' => 50.6378
    ],
    [
        'name_ar' => 'بنجلاديش',
        'name_en' => 'Bangladesh',
        'name_fr' => 'Bangladesh',
        'code' => 'BD',
        'lat' => 23.6850,
        'lng' => 90.3563
    ],
    [
        'name_ar' => 'بربادوس',
        'name_en' => 'Barbados',
        'name_fr' => 'Barbade',
        'code' => 'BB',
        'lat' => 13.1939,
        'lng' => -59.5432
    ],
    [
        'name_ar' => 'روسيا البيضاء',
        'name_en' => 'Belarus',
        'name_fr' => 'Bélarus',
        'code' => 'BY',
        'lat' => 53.7098,
        'lng' => 27.9534
    ],
    [
        'name_ar' => 'بلجيكا',
        'name_en' => 'Belgium',
        'name_fr' => 'Belgique',
        'code' => 'BE',
        'lat' => 50.5039,
        'lng' => 4.4699
    ],
    [
        'name_ar' => 'بليز',
        'name_en' => 'Belize',
        'name_fr' => 'Belize',
        'code' => 'BZ',
        'lat' => 17.1899,
        'lng' => -88.4976
    ],
    [
        'name_ar' => 'بنين',
        'name_en' => 'Benin',
        'name_fr' => 'Bénin',
        'code' => 'BJ',
        'lat' => 9.3077,
        'lng' => 2.3158
    ],
    [
        'name_ar' => 'برمودا',
        'name_en' => 'Bermuda',
        'name_fr' => 'Bermudes',
        'code' => 'BM',
        'lat' => 32.3078,
        'lng' => -64.7505
    ],
    [
        'name_ar' => 'بوتان',
        'name_en' => 'Bhutan',
        'name_fr' => 'Bhoutan',
        'code' => 'BT',
        'lat' => 27.5142,
        'lng' => 90.4336
    ],
    [
        'name_ar' => 'بوليفيا',
        'name_en' => 'Bolivia',
        'name_fr' => 'Bolivie',
        'code' => 'BO',
        'lat' => -16.2902,
        'lng' => -63.5887
    ],
    [
        'name_ar' => 'البوسنة والهرسك',
        'name_en' => 'Bosnia and Herzegovina',
        'name_fr' => 'Bosnie-Herzégovine',
        'code' => 'BA',
        'lat' => 43.9159,
        'lng' => 17.6791
    ],
    [
        'name_ar' => 'بتسوانا',
        'name_en' => 'Botswana',
        'name_fr' => 'Botswana',
        'code' => 'BW',
        'lat' => -22.3285,
        'lng' => 24.6849
    ],
    [
        'name_ar' => 'جزيرة بوفيه',
        'name_en' => 'Bouvet Island',
        'name_fr' => 'Île Bouvet',
        'code' => 'BV',
        'lat' => -54.4208,
        'lng' => 3.3464
    ],
    [
        'name_ar' => 'البرازيل',
        'name_en' => 'Brazil',
        'name_fr' => 'Brésil',
        'code' => 'BR',
        'lat' => -14.2350,
        'lng' => -51.9253
    ],
    [
        'name_ar' => 'إقليم المحيط الهندي البريطاني',
        'name_en' => 'British Indian Ocean Territory',
        'name_fr' => 'Territoire britannique de l\'océan Indien',
        'code' => 'IO',
        'lat' => -6.3432,
        'lng' => 71.8765
    ],
    [
        'name_ar' => 'جزر العذراء البريطانية',
        'name_en' => 'British Virgin Islands',
        'name_fr' => 'Îles Vierges britanniques',
        'code' => 'VG',
        'lat' => 18.4207,
        'lng' => -64.6399
    ],
    [
        'name_ar' => 'بروناي',
        'name_en' => 'Brunei Darussalam',
        'name_fr' => 'Brunéi Darussalam',
        'code' => 'BN',
        'lat' => 4.5353,
        'lng' => 114.7277
    ],
    [
        'name_ar' => 'بلغاريا',
        'name_en' => 'Bulgaria',
        'name_fr' => 'Bulgarie',
        'code' => 'BG',
        'lat' => 42.7339,
        'lng' => 25.4858
    ],
    [
        'name_ar' => 'بوركينا فاسو',
        'name_en' => 'Burkina Faso',
        'name_fr' => 'Burkina Faso',
        'code' => 'BF',
        'lat' => 12.2383,
        'lng' => -1.5616
    ],
    [
        'name_ar' => 'بوروندي',
        'name_en' => 'Burundi',
        'name_fr' => 'Burundi',
        'code' => 'BI',
        'lat' => -3.3731,
        'lng' => 29.9189
    ],
    [
        'name_ar' => 'كمبوديا',
        'name_en' => 'Cambodia',
        'name_fr' => 'Cambodge',
        'code' => 'KH',
        'lat' => 12.5657,
        'lng' => 104.9910
    ],
    [
        'name_ar' => 'الكاميرون',
        'name_en' => 'Cameroon',
        'name_fr' => 'Cameroun',
        'code' => 'CM',
        'lat' => 7.3697,
        'lng' => 12.3547
    ],
    [
        'name_ar' => 'كندا',
        'name_en' => 'Canada',
        'name_fr' => 'Canada',
        'code' => 'CA',
        'lat' => 56.1304,
        'lng' => -106.3468
    ],
    [
        'name_ar' => 'جزر الكناري',
        'name_en' => 'Canary Islands',
        'name_fr' => 'Îles Canaries',
        'code' => 'IC',
        'lat' => 28.2916,
        'lng' => -16.6291
    ],
    [
        'name_ar' => 'الرأس الأخضر',
        'name_en' => 'Cabo Verde',
        'name_fr' => 'Cap-Vert',
        'code' => 'CV',
        'lat' => 16.5388,
        'lng' => -24.0132
    ],
    [
        'name_ar' => 'الجزر الكاريبية الهولندية',
        'name_en' => 'Bonaire, Sint Eustatius and Saba',
        'name_fr' => 'Bonaire, Saint-Eustache et Saba',
        'code' => 'BQ',
        'lat' => 12.1784,
        'lng' => -68.2385
    ],
    [
        'name_ar' => 'جزر كايمان',
        'name_en' => 'Cayman Islands',
        'name_fr' => 'Îles Caïmans',
        'code' => 'KY',
        'lat' => 19.3133,
        'lng' => -81.2546
    ],
    [
        'name_ar' => 'جمهورية أفريقيا الوسطى',
        'name_en' => 'Central African Republic',
        'name_fr' => 'République centrafricaine',
        'code' => 'CF',
        'lat' => 6.6111,
        'lng' => 20.9394
    ],
    [
        'name_ar' => 'سبته ومليلية',
        'name_en' => 'Ceuta and Melilla',
        'name_fr' => 'Ceuta et Melilla',
        'code' => 'EA',
        'lat' => 35.8894,
        'lng' => -5.3213
    ],
    [
        'name_ar' => 'تشاد',
        'name_en' => 'Chad',
        'name_fr' => 'Tchad',
        'code' => 'TD',
        'lat' => 15.4542,
        'lng' => 18.7322
    ],
    [
        'name_ar' => 'شيلي',
        'name_en' => 'Chile',
        'name_fr' => 'Chili',
        'code' => 'CL',
        'lat' => -35.6751,
        'lng' => -71.5430
    ],
    [
        'name_ar' => 'الصين',
        'name_en' => 'China',
        'name_fr' => 'Chine',
        'code' => 'CN',
        'lat' => 35.8617,
        'lng' => 104.1954
    ],
    [
        'name_ar' => 'جزيرة عيد الميلاد',
        'name_en' => 'Christmas Island',
        'name_fr' => 'Île Christmas',
        'code' => 'CX',
        'lat' => -10.4475,
        'lng' => 105.6904
    ],
    [
        'name_ar' => 'جزيرة كليبرتون',
        'name_en' => 'Clipperton Island',
        'name_fr' => 'Île Clipperton',
        'code' => 'CP',
        'lat' => 10.2989,
        'lng' => -109.2191
    ],
    [
        'name_ar' => 'جزر كوكوس',
        'name_en' => 'Cocos (Keeling) Islands',
        'name_fr' => 'Îles Cocos',
        'code' => 'CC',
        'lat' => -12.1642,
        'lng' => 96.8710
    ],
    [
        'name_ar' => 'كولومبيا',
        'name_en' => 'Colombia',
        'name_fr' => 'Colombie',
        'code' => 'CO',
        'lat' => 4.5709,
        'lng' => -74.2973
    ],
    [
        'name_ar' => 'جزر القمر',
        'name_en' => 'Comoros',
        'name_fr' => 'Comores',
        'code' => 'KM',
        'lat' => -11.6455,
        'lng' => 43.3333
    ],
    [
        'name_ar' => 'جمهورية الكونغو الديمقراطية',
        'name_en' => 'Congo (Democratic Republic)',
        'name_fr' => 'Congo (République démocratique)',
        'code' => 'CD',
        'lat' => -4.0383,
        'lng' => 21.7587
    ],
    [
        'name_ar' => 'جمهورية الكونغو',
        'name_en' => 'Congo',
        'name_fr' => 'Congo',
        'code' => 'CG',
        'lat' => -0.2280,
        'lng' => 15.8277
    ],
    [
        'name_ar' => 'جزر كوك',
        'name_en' => 'Cook Islands',
        'name_fr' => 'Îles Cook',
        'code' => 'CK',
        'lat' => -21.2367,
        'lng' => -159.7777
    ],
    [
        'name_ar' => 'كوستاريكا',
        'name_en' => 'Costa Rica',
        'name_fr' => 'Costa Rica',
        'code' => 'CR',
        'lat' => 9.7489,
        'lng' => -83.7534
    ],
    [
        'name_ar' => 'ساحل العاج',
        'name_en' => 'Côte d\'Ivoire',
        'name_fr' => 'Côte d\'Ivoire',
        'code' => 'CI',
        'lat' => 7.5399,
        'lng' => -5.5471
    ],
    [
        'name_ar' => 'كرواتيا',
        'name_en' => 'Croatia',
        'name_fr' => 'Croatie',
        'code' => 'HR',
        'lat' => 45.1000,
        'lng' => 15.2000
    ],
    [
        'name_ar' => 'كوبا',
        'name_en' => 'Cuba',
        'name_fr' => 'Cuba',
        'code' => 'CU',
        'lat' => 21.5218,
        'lng' => -77.7812
    ],
    [
        'name_ar' => 'كوراساو',
        'name_en' => 'Curaçao',
        'name_fr' => 'Curaçao',
        'code' => 'CW',
        'lat' => 12.1696,
        'lng' => -68.9900
    ],
    [
        'name_ar' => 'قبرص',
        'name_en' => 'Cyprus',
        'name_fr' => 'Chypre',
        'code' => 'CY',
        'lat' => 35.1264,
        'lng' => 33.4299
    ],
    [
        'name_ar' => 'جمهورية التشيك',
        'name_en' => 'Czechia',
        'name_fr' => 'Tchéquie',
        'code' => 'CZ',
        'lat' => 49.8175,
        'lng' => 15.4730
    ],
    [
        'name_ar' => 'الدانمرك',
        'name_en' => 'Denmark',
        'name_fr' => 'Danemark',
        'code' => 'DK',
        'lat' => 56.2639,
        'lng' => 9.5018
    ],
    [
        'name_ar' => 'دييغو غارسيا',
        'name_en' => 'Diego Garcia',
        'name_fr' => 'Diego Garcia',
        'code' => 'DG',
        'lat' => -7.3194,
        'lng' => 72.4227
    ],
    [
        'name_ar' => 'جيبوتي',
        'name_en' => 'Djibouti',
        'name_fr' => 'Djibouti',
        'code' => 'DJ',
        'lat' => 11.8251,
        'lng' => 42.5903
    ],
    [
        'name_ar' => 'دومينيكا',
        'name_en' => 'Dominica',
        'name_fr' => 'Dominique',
        'code' => 'DM',
        'lat' => 15.4140,
        'lng' => -61.3710
    ],
    [
        'name_ar' => 'جمهورية الدومينيكان',
        'name_en' => 'Dominican Republic',
        'name_fr' => 'République dominicaine',
        'code' => 'DO',
        'lat' => 18.7357,
        'lng' => -70.1627
    ],
    [
        'name_ar' => 'الاكوادور',
        'name_en' => 'Ecuador',
        'name_fr' => 'Équateur',
        'code' => 'EC',
        'lat' => -1.8312,
        'lng' => -78.1834
    ],
    [
        'name_ar' => 'مصر',
        'name_en' => 'Egypt',
        'name_fr' => 'Égypte',
        'code' => 'EG',
        'lat' => 26.0975,
        'lng' => 31.1009
    ],
    [
        'name_ar' => 'السلفادور',
        'name_en' => 'El Salvador',
        'name_fr' => 'Salvador',
        'code' => 'SV',
        'lat' => 13.7942,
        'lng' => -88.8965
    ],
    [
        'name_ar' => 'غينيا الاستوائية',
        'name_en' => 'Equatorial Guinea',
        'name_fr' => 'Guinée équatoriale',
        'code' => 'GQ',
        'lat' => 1.6508,
        'lng' => 10.2679
    ],
    [
        'name_ar' => 'اريتريا',
        'name_en' => 'Eritrea',
        'name_fr' => 'Érythrée',
        'code' => 'ER',
        'lat' => 15.1794,
        'lng' => 39.7823
    ],
    [
        'name_ar' => 'استونيا',
        'name_en' => 'Estonia',
        'name_fr' => 'Estonie',
        'code' => 'EE',
        'lat' => 58.5953,
        'lng' => 25.0136
    ],
    [
        'name_ar' => 'اثيوبيا',
        'name_en' => 'Ethiopia',
        'name_fr' => 'Éthiopie',
        'code' => 'ET',
        'lat' => 9.1450,
        'lng' => 40.4897
    ],
    [
        'name_ar' => 'جزر فوكلاند',
        'name_en' => 'Falkland Islands',
        'name_fr' => 'Îles Malouines',
        'code' => 'FK',
        'lat' => -51.7963,
        'lng' => -59.5236
    ],
    [
        'name_ar' => 'جزر فارو',
        'name_en' => 'Faroe Islands',
        'name_fr' => 'Îles Féroé',
        'code' => 'FO',
        'lat' => 61.8926,
        'lng' => -6.9118
    ],
    [
        'name_ar' => 'فيجي',
        'name_en' => 'Fiji',
        'name_fr' => 'Fidji',
        'code' => 'FJ',
        'lat' => -16.5782,
        'lng' => 179.4144
    ],
    [
        'name_ar' => 'فنلندا',
        'name_en' => 'Finland',
        'name_fr' => 'Finlande',
        'code' => 'FI',
        'lat' => 61.9241,
        'lng' => 25.7482
    ],
    [
        'name_ar' => 'فرنسا',
        'name_en' => 'France',
        'name_fr' => 'France',
        'code' => 'FR',
        'lat' => 46.6034,
        'lng' => 1.8883
    ],
    [
        'name_ar' => 'غويانا',
        'name_en' => 'French Guiana',
        'name_fr' => 'Guyane française',
        'code' => 'GF',
        'lat' => 3.9339,
        'lng' => -53.1258
    ],
    [
        'name_ar' => 'بولينزيا الفرنسية',
        'name_en' => 'French Polynesia',
        'name_fr' => 'Polynésie française',
        'code' => 'PF',
        'lat' => -17.5792,
        'lng' => -149.6086
    ],
    [
        'name_ar' => 'أراض فرنسية جنوبية وأنتارتيكية',
        'name_en' => 'French Southern Territories',
        'name_fr' => 'Terres australes françaises',
        'code' => 'TF',
        'lat' => -49.2804,
        'lng' => 69.3486
    ],

    [
        'name_ar' => 'الجابون',
        'name_en' => 'Gabon',
        'name_fr' => 'Gabon',
        'code' => 'GA',
        'lat' => -0.8037,
        'lng' => 11.6094
    ],
    [
        'name_ar' => 'غامبيا',
        'name_en' => 'Gambia',
        'name_fr' => 'Gambie',
        'code' => 'GM',
        'lat' => 13.4432,
        'lng' => -15.3101
    ],
    [
        'name_ar' => 'جورجيا',
        'name_en' => 'Georgia',
        'name_fr' => 'Géorgie',
        'code' => 'GE',
        'lat' => 42.3154,
        'lng' => 43.3569
    ],
    [
        'name_ar' => 'ألمانيا',
        'name_en' => 'Germany',
        'name_fr' => 'Allemagne',
        'code' => 'DE',
        'lat' => 51.1657,
        'lng' => 10.4515
    ],
    [
        'name_ar' => 'غانا',
        'name_en' => 'Ghana',
        'name_fr' => 'Ghana',
        'code' => 'GH',
        'lat' => 7.9465,
        'lng' => -1.0232
    ],
    [
        'name_ar' => 'جبل طارق',
        'name_en' => 'Gibraltar',
        'name_fr' => 'Gibraltar',
        'code' => 'GI',
        'lat' => 36.1408,
        'lng' => -5.3536
    ],
    [
        'name_ar' => 'اليونان',
        'name_en' => 'Greece',
        'name_fr' => 'Grèce',
        'code' => 'GR',
        'lat' => 39.0742,
        'lng' => 21.8243
    ],
    [
        'name_ar' => 'جرينلاند',
        'name_en' => 'Greenland',
        'name_fr' => 'Groenland',
        'code' => 'GL',
        'lat' => 71.7069,
        'lng' => -42.6043
    ],
    [
        'name_ar' => 'جرينادا',
        'name_en' => 'Grenada',
        'name_fr' => 'Grenade',
        'code' => 'GD',
        'lat' => 12.1165,
        'lng' => -61.6790
    ],
    [
        'name_ar' => 'جوادلوب',
        'name_en' => 'Guadeloupe',
        'name_fr' => 'Guadeloupe',
        'code' => 'GP',
        'lat' => 16.9950,
        'lng' => -62.0677
    ],
    [
        'name_ar' => 'جوام',
        'name_en' => 'Guam',
        'name_fr' => 'Guam',
        'code' => 'GU',
        'lat' => 13.4443,
        'lng' => 144.7937
    ],
    [
        'name_ar' => 'جواتيمالا',
        'name_en' => 'Guatemala',
        'name_fr' => 'Guatemala',
        'code' => 'GT',
        'lat' => 15.7835,
        'lng' => -90.2308
    ],
    [
        'name_ar' => 'جيرنزي',
        'name_en' => 'Guernsey',
        'name_fr' => 'Guernesey',
        'code' => 'GG',
        'lat' => 49.4658,
        'lng' => -2.5854
    ],
    [
        'name_ar' => 'غينيا',
        'name_en' => 'Guinea',
        'name_fr' => 'Guinée',
        'code' => 'GN',
        'lat' => 9.9456,
        'lng' => -9.6966
    ],
    [
        'name_ar' => 'غينيا بيساو',
        'name_en' => 'Guinea-Bissau',
        'name_fr' => 'Guinée-Bissau',
        'code' => 'GW',
        'lat' => 11.8037,
        'lng' => -15.1804
    ],
    [
        'name_ar' => 'غيانا',
        'name_en' => 'Guyana',
        'name_fr' => 'Guyana',
        'code' => 'GY',
        'lat' => 4.8604,
        'lng' => -58.9302
    ],
    [
        'name_ar' => 'هايتي',
        'name_en' => 'Haiti',
        'name_fr' => 'Haïti',
        'code' => 'HT',
        'lat' => 18.9712,
        'lng' => -72.2852
    ],
    [
        'name_ar' => 'جزيرة هيرد وجزر ماكدونالد',
        'name_en' => 'Heard Island and McDonald Islands',
        'name_fr' => 'Îles Heard-et-MacDonald',
        'code' => 'HM',
        'lat' => -53.0818,
        'lng' => 73.5042
    ],
    [
        'name_ar' => 'هندوراس',
        'name_en' => 'Honduras',
        'name_fr' => 'Honduras',
        'code' => 'HN',
        'lat' => 15.2000,
        'lng' => -86.2419
    ],
    [
        'name_ar' => 'هونغ كونغ',
        'name_en' => 'Hong Kong',
        'name_fr' => 'Hong Kong',
        'code' => 'HK',
        'lat' => 22.3193,
        'lng' => 114.1694
    ],
    [
        'name_ar' => 'المجر',
        'name_en' => 'Hungary',
        'name_fr' => 'Hongrie',
        'code' => 'HU',
        'lat' => 47.1625,
        'lng' => 19.5033
    ],
    [
        'name_ar' => 'أيسلندا',
        'name_en' => 'Iceland',
        'name_fr' => 'Islande',
        'code' => 'IS',
        'lat' => 64.9631,
        'lng' => -19.0208
    ],
    [
        'name_ar' => 'الهند',
        'name_en' => 'India',
        'name_fr' => 'Inde',
        'code' => 'IN',
        'lat' => 20.5937,
        'lng' => 78.9629
    ],
    [
        'name_ar' => 'اندونيسيا',
        'name_en' => 'Indonesia',
        'name_fr' => 'Indonésie',
        'code' => 'ID',
        'lat' => -0.7893,
        'lng' => 113.9213
    ],
    [
        'name_ar' => 'ايران',
        'name_en' => 'Iran',
        'name_fr' => 'Iran',
        'code' => 'IR',
        'lat' => 32.4279,
        'lng' => 53.6880
    ],
    [
        'name_ar' => 'العراق',
        'name_en' => 'Iraq',
        'name_fr' => 'Irak',
        'code' => 'IQ',
        'lat' => 33.2232,
        'lng' => 43.6793
    ],
    [
        'name_ar' => 'أيرلندا',
        'name_en' => 'Ireland',
        'name_fr' => 'Irlande',
        'code' => 'IE',
        'lat' => 53.4129,
        'lng' => -8.2439
    ],
    [
        'name_ar' => 'جزيرة مان',
        'name_en' => 'Isle of Man',
        'name_fr' => 'Île de Man',
        'code' => 'IM',
        'lat' => 54.2361,
        'lng' => -4.5481
    ],
    [
        'name_ar' => 'إسرائيل',
        'name_en' => 'Israel',
        'name_fr' => 'Israël',
        'code' => 'IL',
        'lat' => 31.0461,
        'lng' => 34.8516
    ],
    [
        'name_ar' => 'ايطاليا',
        'name_en' => 'Italy',
        'name_fr' => 'Italie',
        'code' => 'IT',
        'lat' => 41.8719,
        'lng' => 12.5674
    ],
    [
        'name_ar' => 'جامايكا',
        'name_en' => 'Jamaica',
        'name_fr' => 'Jamaïque',
        'code' => 'JM',
        'lat' => 18.1096,
        'lng' => -77.2975
    ],
    [
        'name_ar' => 'اليابان',
        'name_en' => 'Japan',
        'name_fr' => 'Japon',
        'code' => 'JP',
        'lat' => 36.2048,
        'lng' => 138.2529
    ],
    [
        'name_ar' => 'جيرسي',
        'name_en' => 'Jersey',
        'name_fr' => 'Jersey',
        'code' => 'JE',
        'lat' => 49.2144,
        'lng' => -2.1312
    ],
    [
        'name_ar' => 'الأردن',
        'name_en' => 'Jordan',
        'name_fr' => 'Jordanie',
        'code' => 'JO',
        'lat' => 30.5852,
        'lng' => 36.2384
    ],
    [
        'name_ar' => 'كازاخستان',
        'name_en' => 'Kazakhstan',
        'name_fr' => 'Kazakhstan',
        'code' => 'KZ',
        'lat' => 48.0196,
        'lng' => 66.9237
    ],
    [
        'name_ar' => 'كينيا',
        'name_en' => 'Kenya',
        'name_fr' => 'Kenya',
        'code' => 'KE',
        'lat' => -0.0236,
        'lng' => 37.9062
    ],
    [
        'name_ar' => 'كيريباتي',
        'name_en' => 'Kiribati',
        'name_fr' => 'Kiribati',
        'code' => 'KI',
        'lat' => -3.3704,
        'lng' => -168.7340
    ],
    [
        'name_ar' => 'كوسوفو',
        'name_en' => 'Kosovo',
        'name_fr' => 'Kosovo',
        'code' => 'XK',
        'lat' => 42.6026,
        'lng' => 20.9030
    ],
    [
        'name_ar' => 'الكويت',
        'name_en' => 'Kuwait',
        'name_fr' => 'Koweït',
        'code' => 'KW',
        'lat' => 29.3117,
        'lng' => 47.4818
    ],
    [
        'name_ar' => 'قرغيزستان',
        'name_en' => 'Kyrgyzstan',
        'name_fr' => 'Kirghizistan',
        'code' => 'KG',
        'lat' => 41.2044,
        'lng' => 74.7661
    ],
    [
        'name_ar' => 'لاوس',
        'name_en' => 'Laos',
        'name_fr' => 'Laos',
        'code' => 'LA',
        'lat' => 19.8563,
        'lng' => 102.4955
    ],
    [
        'name_ar' => 'لاتفيا',
        'name_en' => 'Latvia',
        'name_fr' => 'Lettonie',
        'code' => 'LV',
        'lat' => 56.8796,
        'lng' => 24.6032
    ],
    [
        'name_ar' => 'لبنان',
        'name_en' => 'Lebanon',
        'name_fr' => 'Liban',
        'code' => 'LB',
        'lat' => 33.8547,
        'lng' => 35.8623
    ],
    [
        'name_ar' => 'ليسوتو',
        'name_en' => 'Lesotho',
        'name_fr' => 'Lesotho',
        'code' => 'LS',
        'lat' => -29.6099,
        'lng' => 28.2336
    ],
    [
        'name_ar' => 'ليبيريا',
        'name_en' => 'Liberia',
        'name_fr' => 'Libéria',
        'code' => 'LR',
        'lat' => 6.4281,
        'lng' => -9.4295
    ],
    [
        'name_ar' => 'ليبيا',
        'name_en' => 'Libya',
        'name_fr' => 'Libye',
        'code' => 'LY',
        'lat' => 26.3351,
        'lng' => 17.2283
    ],
    [
        'name_ar' => 'ليختنشتاين',
        'name_en' => 'Liechtenstein',
        'name_fr' => 'Liechtenstein',
        'code' => 'LI',
        'lat' => 47.1660,
        'lng' => 9.5554
    ],
    [
        'name_ar' => 'ليتوانيا',
        'name_en' => 'Lithuania',
        'name_fr' => 'Lituanie',
        'code' => 'LT',
        'lat' => 55.1694,
        'lng' => 23.8813
    ],
    [
        'name_ar' => 'لوكسمبورج',
        'name_en' => 'Luxembourg',
        'name_fr' => 'Luxembourg',
        'code' => 'LU',
        'lat' => 49.8153,
        'lng' => 6.1296
    ],
    [
        'name_ar' => 'ماكاو',
        'name_en' => 'Macao',
        'name_fr' => 'Macao',
        'code' => 'MO',
        'lat' => 22.1987,
        'lng' => 113.5439
    ],
    [
        'name_ar' => 'مقدونيا',
        'name_en' => 'North Macedonia',
        'name_fr' => 'Macédoine du Nord',
        'code' => 'MK',
        'lat' => 41.6086,
        'lng' => 21.7453
    ],
    [
        'name_ar' => 'مدغشقر',
        'name_en' => 'Madagascar',
        'name_fr' => 'Madagascar',
        'code' => 'MG',
        'lat' => -18.7669,
        'lng' => 46.8691
    ],
    [
        'name_ar' => 'ملاوي',
        'name_en' => 'Malawi',
        'name_fr' => 'Malawi',
        'code' => 'MW',
        'lat' => -13.2543,
        'lng' => 34.3015
    ],
    [
        'name_ar' => 'ماليزيا',
        'name_en' => 'Malaysia',
        'name_fr' => 'Malaisie',
        'code' => 'MY',
        'lat' => 4.2105,
        'lng' => 101.9758
    ],
    [
        'name_ar' => 'جزر المالديف',
        'name_en' => 'Maldives',
        'name_fr' => 'Maldives',
        'code' => 'MV',
        'lat' => 3.2028,
        'lng' => 73.2207
    ],
    [
        'name_ar' => 'مالي',
        'name_en' => 'Mali',
        'name_fr' => 'Mali',
        'code' => 'ML',
        'lat' => 17.5707,
        'lng' => -3.9962
    ],
    [
        'name_ar' => 'مالطا',
        'name_en' => 'Malta',
        'name_fr' => 'Malte',
        'code' => 'MT',
        'lat' => 35.9375,
        'lng' => 14.3754
    ],
    [
        'name_ar' => 'جزر مارشال',
        'name_en' => 'Marshall Islands',
        'name_fr' => 'Îles Marshall',
        'code' => 'MH',
        'lat' => 7.1315,
        'lng' => 171.1845
    ],
    [
        'name_ar' => 'مارتينيك',
        'name_en' => 'Martinique',
        'name_fr' => 'Martinique',
        'code' => 'MQ',
        'lat' => 14.6415,
        'lng' => -61.0242
    ],
    [
        'name_ar' => 'موريتانيا',
        'name_en' => 'Mauritania',
        'name_fr' => 'Mauritanie',
        'code' => 'MR',
        'lat' => 21.0079,
        'lng' => -10.9408
    ],
    [
        'name_ar' => 'موريشيوس',
        'name_en' => 'Mauritius',
        'name_fr' => 'Maurice',
        'code' => 'MU',
        'lat' => -20.3484,
        'lng' => 57.5522
    ],
    [
        'name_ar' => 'مايوت',
        'name_en' => 'Mayotte',
        'name_fr' => 'Mayotte',
        'code' => 'YT',
        'lat' => -12.8275,
        'lng' => 45.1662
    ],
    [
        'name_ar' => 'المكسيك',
        'name_en' => 'Mexico',
        'name_fr' => 'Mexique',
        'code' => 'MX',
        'lat' => 23.6345,
        'lng' => -102.5528
    ],
    [
        'name_ar' => 'ميكرونيزيا',
        'name_en' => 'Micronesia',
        'name_fr' => 'Micronésie',
        'code' => 'FM',
        'lat' => 7.4256,
        'lng' => 150.5508
    ],
    [
        'name_ar' => 'مولدافيا',
        'name_en' => 'Moldova',
        'name_fr' => 'Moldavie',
        'code' => 'MD',
        'lat' => 47.4116,
        'lng' => 28.3699
    ],
    [
        'name_ar' => 'موناكو',
        'name_en' => 'Monaco',
        'name_fr' => 'Monaco',
        'code' => 'MC',
        'lat' => 43.7384,
        'lng' => 7.4246
    ],
    [
        'name_ar' => 'منغوليا',
        'name_en' => 'Mongolia',
        'name_fr' => 'Mongolie',
        'code' => 'MN',
        'lat' => 46.8625,
        'lng' => 103.8467
    ],
    [
        'name_ar' => 'الجبل الأسود',
        'name_en' => 'Montenegro',
        'name_fr' => 'Monténégro',
        'code' => 'ME',
        'lat' => 42.7087,
        'lng' => 19.3744
    ],
    [
        'name_ar' => 'مونتسرات',
        'name_en' => 'Montserrat',
        'name_fr' => 'Montserrat',
        'code' => 'MS',
        'lat' => 16.7425,
        'lng' => -62.1874
    ],
    [
        'name_ar' => 'المغرب',
        'name_en' => 'Morocco',
        'name_fr' => 'Maroc',
        'code' => 'MA',
        'lat' => 31.7917,
        'lng' => -7.0926
    ],
    [
        'name_ar' => 'موزمبيق',
        'name_en' => 'Mozambique',
        'name_fr' => 'Mozambique',
        'code' => 'MZ',
        'lat' => -18.6657,
        'lng' => 35.5296
    ],
    [
        'name_ar' => 'ميانمار',
        'name_en' => 'Myanmar',
        'name_fr' => 'Myanmar',
        'code' => 'MM',
        'lat' => 21.9162,
        'lng' => 95.9560
    ],
    [
        'name_ar' => 'ناميبيا',
        'name_en' => 'Namibia',
        'name_fr' => 'Namibie',
        'code' => 'NA',
        'lat' => -22.9576,
        'lng' => 18.4904
    ],
    [
        'name_ar' => 'نورو',
        'name_en' => 'Nauru',
        'name_fr' => 'Nauru',
        'code' => 'NR',
        'lat' => -0.5228,
        'lng' => 166.9315
    ],
    [
        'name_ar' => 'نيبال',
        'name_en' => 'Nepal',
        'name_fr' => 'Népal',
        'code' => 'NP',
        'lat' => 28.3949,
        'lng' => 84.1240
    ],
    [
        'name_ar' => 'هولندا',
        'name_en' => 'Netherlands',
        'name_fr' => 'Pays-Bas',
        'code' => 'NL',
        'lat' => 52.1326,
        'lng' => 5.2913
    ],
    [
        'name_ar' => 'كاليدونيا الجديدة',
        'name_en' => 'New Caledonia',
        'name_fr' => 'Nouvelle-Calédonie',
        'code' => 'NC',
        'lat' => -20.9043,
        'lng' => 165.6180
    ],
    [
        'name_ar' => 'نيوزيلاندا',
        'name_en' => 'New Zealand',
        'name_fr' => 'Nouvelle-Zélande',
        'code' => 'NZ',
        'lat' => -40.9006,
        'lng' => 174.8860
    ],
    [
        'name_ar' => 'نيكاراجوا',
        'name_en' => 'Nicaragua',
        'name_fr' => 'Nicaragua',
        'code' => 'NI',
        'lat' => 12.8654,
        'lng' => -85.2072
    ],
    [
        'name_ar' => 'النيجر',
        'name_en' => 'Niger',
        'name_fr' => 'Niger',
        'code' => 'NE',
        'lat' => 17.6078,
        'lng' => 8.0817
    ],
    [
        'name_ar' => 'نيجيريا',
        'name_en' => 'Nigeria',
        'name_fr' => 'Nigéria',
        'code' => 'NG',
        'lat' => 9.0820,
        'lng' => 8.6753
    ],
    [
        'name_ar' => 'نيوي',
        'name_en' => 'Niue',
        'name_fr' => 'Niue',
        'code' => 'NU',
        'lat' => -19.0544,
        'lng' => -169.8672
    ],
    [
        'name_ar' => 'جزيرة نورفولك',
        'name_en' => 'Norfolk Island',
        'name_fr' => 'Île Norfolk',
        'code' => 'NF',
        'lat' => -29.0408,
        'lng' => 167.9547
    ],
    [
        'name_ar' => 'جزر ماريانا الشمالية',
        'name_en' => 'Northern Mariana Islands',
        'name_fr' => 'Îles Mariannes du Nord',
        'code' => 'MP',
        'lat' => 17.3308,
        'lng' => 145.3846
    ],
    [
        'name_ar' => 'كوريا الشمالية',
        'name_en' => 'North Korea',
        'name_fr' => 'Corée du Nord',
        'code' => 'KP',
        'lat' => 40.3399,
        'lng' => 127.5101
    ],
    [
        'name_ar' => 'النرويج',
        'name_en' => 'Norway',
        'name_fr' => 'Norvège',
        'code' => 'NO',
        'lat' => 60.4720,
        'lng' => 8.4689
    ],
    [
        'name_ar' => 'عمان',
        'name_en' => 'Oman',
        'name_fr' => 'Oman',
        'code' => 'OM',
        'lat' => 21.4735,
        'lng' => 55.9754
    ],
    [
        'name_ar' => ' أفغانستان',
        'name_en' => 'Afghanistan',
        'name_fr' => 'Afghanistan',
        'code' => 'AF',
        'lat' => 33.9391,
        'lng' => 67.7100
    ],
    [
        'name_ar' => 'باكستان',
        'name_en' => 'Pakistan',
        'name_fr' => 'Pakistan',
        'code' => 'PK',
        'lat' => 30.3753,
        'lng' => 69.3451
    ],
    [
        'name_ar' => 'بالاو',
        'name_en' => 'Palau',
        'name_fr' => 'Palaos',
        'code' => 'PW',
        'lat' => 7.5150,
        'lng' => 134.5825
    ],
    [
        'name_ar' => 'فلسطين',
        'name_en' => 'Palestine',
        'name_fr' => 'Palestine',
        'code' => 'PS',
        'lat' => 31.9522,
        'lng' => 35.2332
    ],
    [
        'name_ar' => 'بنما',
        'name_en' => 'Panama',
        'name_fr' => 'Panama',
        'code' => 'PA',
        'lat' => 8.5380,
        'lng' => -80.7821
    ],
    [
        'name_ar' => 'بابوا غينيا الجديدة',
        'name_en' => 'Papua New Guinea',
        'name_fr' => 'Papouasie-Nouvelle-Guinée',
        'code' => 'PG',
        'lat' => -6.3150,
        'lng' => 143.9555
    ],
    [
        'name_ar' => 'باراجواي',
        'name_en' => 'Paraguay',
        'name_fr' => 'Paraguay',
        'code' => 'PY',
        'lat' => -23.4425,
        'lng' => -58.4438
    ],
    [
        'name_ar' => 'بيرو',
        'name_en' => 'Peru',
        'name_fr' => 'Pérou',
        'code' => 'PE',
        'lat' => -9.1900,
        'lng' => -75.0152
    ],
    [
        'name_ar' => 'الفيلبين',
        'name_en' => 'Philippines',
        'name_fr' => 'Philippines',
        'code' => 'PH',
        'lat' => 12.8797,
        'lng' => 121.7740
    ],
     [
        'name_ar' => 'بتكايرن',
        'name_en' => 'Pitcairn',
        'name_fr' => 'Pitcairn',
        'code' => 'PN',
        'lat' => -24.3768,
        'lng' => -128.3242
    ],
    [
        'name_ar' => 'بولندا',
        'name_en' => 'Poland',
        'name_fr' => 'Pologne',
        'code' => 'PL',
        'lat' => 51.9194,
        'lng' => 19.1451
    ],
    [
        'name_ar' => 'البرتغال',
        'name_en' => 'Portugal',
        'name_fr' => 'Portugal',
        'code' => 'PT',
        'lat' => 39.3999,
        'lng' => -8.2245
    ],
    [
        'name_ar' => 'بورتوريكو',
        'name_en' => 'Puerto Rico',
        'name_fr' => 'Porto Rico',
        'code' => 'PR',
        'lat' => 18.2208,
        'lng' => -66.5901
    ],
    [
        'name_ar' => 'قطر',
        'name_en' => 'Qatar',
        'name_fr' => 'Qatar',
        'code' => 'QA',
        'lat' => 25.3548,
        'lng' => 51.1839
    ],
    [
        'name_ar' => 'روينيون',
        'name_en' => 'Réunion',
        'name_fr' => 'Réunion',
        'code' => 'RE',
        'lat' => -21.1151,
        'lng' => 55.5364
    ],
    [
        'name_ar' => 'رومانيا',
        'name_en' => 'Romania',
        'name_fr' => 'Roumanie',
        'code' => 'RO',
        'lat' => 45.9432,
        'lng' => 24.9668
    ],
    [
        'name_ar' => 'روسيا',
        'name_en' => 'Russia',
        'name_fr' => 'Russie',
        'code' => 'RU',
        'lat' => 61.5240,
        'lng' => 105.3188
    ],
    [
        'name_ar' => 'رواندا',
        'name_en' => 'Rwanda',
        'name_fr' => 'Rwanda',
        'code' => 'RW',
        'lat' => -1.9403,
        'lng' => 29.8739
    ],
    [
        'name_ar' => 'سان بارتيلمي',
        'name_en' => 'Saint Barthélemy',
        'name_fr' => 'Saint-Barthélemy',
        'code' => 'BL',
        'lat' => 17.9000,
        'lng' => -62.8333
    ],
    [
        'name_ar' => 'سانت هيلينا وأسينشين وتريستان دا كونا',
        'name_en' => 'Saint Helena, Ascension and Tristan da Cunha',
        'name_fr' => 'Sainte-Hélène, Ascension et Tristan da Cunha',
        'code' => 'SH',
        'lat' => -15.9650,
        'lng' => -5.7089
    ],
    [
        'name_ar' => 'سانت كيتس ونيفيس',
        'name_en' => 'Saint Kitts and Nevis',
        'name_fr' => 'Saint-Kitts-et-Nevis',
        'code' => 'KN',
        'lat' => 17.3578,
        'lng' => -62.7830
    ],
    [
        'name_ar' => 'سانت لوسيا',
        'name_en' => 'Saint Lucia',
        'name_fr' => 'Sainte-Lucie',
        'code' => 'LC',
        'lat' => 13.9094,
        'lng' => -60.9789
    ],
    [
        'name_ar' => 'تجمع سان مارتين',
        'name_en' => 'Saint Martin',
        'name_fr' => 'Saint-Martin',
        'code' => 'MF',
        'lat' => 18.0708,
        'lng' => -63.0501
    ],
    [
        'name_ar' => 'سان بيير وميكلون',
        'name_en' => 'Saint Pierre and Miquelon',
        'name_fr' => 'Saint-Pierre-et-Miquelon',
        'code' => 'PM',
        'lat' => 46.8852,
        'lng' => -56.3159
    ],
    [
        'name_ar' => 'ساموا',
        'name_en' => 'Samoa',
        'name_fr' => 'Samoa',
        'code' => 'WS',
        'lat' => -13.7590,
        'lng' => -172.1046
    ],
    [
        'name_ar' => 'سان مارينو',
        'name_en' => 'San Marino',
        'name_fr' => 'Saint-Marin',
        'code' => 'SM',
        'lat' => 43.9424,
        'lng' => 12.4578
    ],
    [
        'name_ar' => 'ساو تومي وبرينسيب',
        'name_en' => 'São Tomé and Príncipe',
        'name_fr' => 'São Tomé-et-Príncipe',
        'code' => 'ST',
        'lat' => 0.1864,
        'lng' => 6.6131
    ],
    [
        'name_ar' => 'السعودية',
        'name_en' => 'Saudi Arabia',
        'name_fr' => 'Arabie saoudite',
        'code' => 'SA',
        'lat' => 23.8859,
        'lng' => 45.0792
    ],
    [
        'name_ar' => 'السنغال',
        'name_en' => 'Senegal',
        'name_fr' => 'Sénégal',
        'code' => 'SN',
        'lat' => 14.4974,
        'lng' => -14.4524
    ],
    [
        'name_ar' => 'صربيا',
        'name_en' => 'Serbia',
        'name_fr' => 'Serbie',
        'code' => 'RS',
        'lat' => 44.0165,
        'lng' => 21.0059
    ],
    [
        'name_ar' => 'سيشل',
        'name_en' => 'Seychelles',
        'name_fr' => 'Seychelles',
        'code' => 'SC',
        'lat' => -4.6796,
        'lng' => 55.4920
    ],
    [
        'name_ar' => 'سيراليون',
        'name_en' => 'Sierra Leone',
        'name_fr' => 'Sierra Leone',
        'code' => 'SL',
        'lat' => 8.4606,
        'lng' => -11.7799
    ],
    [
        'name_ar' => 'سنغافورة',
        'name_en' => 'Singapore',
        'name_fr' => 'Singapour',
        'code' => 'SG',
        'lat' => 1.3521,
        'lng' => 103.8198
    ],
    [
        'name_ar' => 'سينت مارتن',
        'name_en' => 'Sint Maarten',
        'name_fr' => 'Saint-Martin',
        'code' => 'SX',
        'lat' => 18.0425,
        'lng' => -63.0548
    ],
    [
        'name_ar' => 'سلوفاكيا',
        'name_en' => 'Slovakia',
        'name_fr' => 'Slovaquie',
        'code' => 'SK',
        'lat' => 48.6690,
        'lng' => 19.6990
    ],
    [
        'name_ar' => 'سلوفينيا',
        'name_en' => 'Slovenia',
        'name_fr' => 'Slovénie',
        'code' => 'SI',
        'lat' => 46.1512,
        'lng' => 14.9955
    ],
    [
        'name_ar' => 'جزر سليمان',
        'name_en' => 'Solomon Islands',
        'name_fr' => 'Îles Salomon',
        'code' => 'SB',
        'lat' => -9.6457,
        'lng' => 160.1562
    ],
    [
        'name_ar' => 'الصومال',
        'name_en' => 'Somalia',
        'name_fr' => 'Somalie',
        'code' => 'SO',
        'lat' => 5.1521,
        'lng' => 46.1996
    ],
    [
        'name_ar' => 'جنوب أفريقيا',
        'name_en' => 'South Africa',
        'name_fr' => 'Afrique du Sud',
        'code' => 'ZA',
        'lat' => -30.5595,
        'lng' => 22.9375
    ],
    [
        'name_ar' => 'جورجيا الجنوبية وجزر ساندويتش الجنوبية',
        'name_en' => 'South Georgia and the South Sandwich Islands',
        'name_fr' => 'Géorgie du Sud-et-les Îles Sandwich du Sud',
        'code' => 'GS',
        'lat' => -54.4296,
        'lng' => -36.5880
    ],
    [
        'name_ar' => 'كوريا الجنوبية',
        'name_en' => 'South Korea',
        'name_fr' => 'Corée du Sud',
        'code' => 'KR',
        'lat' => 35.9078,
        'lng' => 127.7669
    ],
    [
        'name_ar' => 'جنوب السودان',
        'name_en' => 'South Sudan',
        'name_fr' => 'Soudan du Sud',
        'code' => 'SS',
        'lat' => 6.8770,
        'lng' => 31.3070
    ],
    [
        'name_ar' => 'أسبانيا',
        'name_en' => 'Spain',
        'name_fr' => 'Espagne',
        'code' => 'ES',
        'lat' => 40.4637,
        'lng' => -3.7492
    ],
    [
        'name_ar' => 'سريلانكا',
        'name_en' => 'Sri Lanka',
        'name_fr' => 'Sri Lanka',
        'code' => 'LK',
        'lat' => 7.8731,
        'lng' => 80.7718
    ],
    [
        'name_ar' => 'سانت فينسنت والغرينادين',
        'name_en' => 'Saint Vincent and the Grenadines',
        'name_fr' => 'Saint-Vincent-et-les-Grenadines',
        'code' => 'VC',
        'lat' => 12.9843,
        'lng' => -61.2872
    ],
    [
        'name_ar' => 'السودان',
        'name_en' => 'Sudan',
        'name_fr' => 'Soudan',
        'code' => 'SD',
        'lat' => 12.8628,
        'lng' => 30.2176
    ],
    [
        'name_ar' => 'سورينام',
        'name_en' => 'Suriname',
        'name_fr' => 'Suriname',
        'code' => 'SR',
        'lat' => 3.9193,
        'lng' => -56.0278
    ],
    [
        'name_ar' => 'سفالبارد ويان ماين',
        'name_en' => 'Svalbard and Jan Mayen',
        'name_fr' => 'Svalbard et Jan Mayen',
        'code' => 'SJ',
        'lat' => 77.5536,
        'lng' => 23.6703
    ],
    [
        'name_ar' => 'سوازيلاند',
        'name_en' => 'Eswatini',
        'name_fr' => 'Eswatini',
        'code' => 'SZ',
        'lat' => -26.5225,
        'lng' => 31.4659
    ],
    [
        'name_ar' => 'السويد',
        'name_en' => 'Sweden',
        'name_fr' => 'Suède',
        'code' => 'SE',
        'lat' => 60.1282,
        'lng' => 18.6435
    ],
    [
        'name_ar' => 'سويسرا',
        'name_en' => 'Switzerland',
        'name_fr' => 'Suisse',
        'code' => 'CH',
        'lat' => 46.8182,
        'lng' => 8.2275
    ],
    [
        'name_ar' => 'سوريا',
        'name_en' => 'Syria',
        'name_fr' => 'Syrie',
        'code' => 'SY',
        'lat' => 34.8021,
        'lng' => 38.9968
    ],
    [
        'name_ar' => 'تايوان',
        'name_en' => 'Taiwan',
        'name_fr' => 'Taïwan',
        'code' => 'TW',
        'lat' => 23.6978,
        'lng' => 120.9605
    ],
    [
        'name_ar' => 'طاجكستان',
        'name_en' => 'Tajikistan',
        'name_fr' => 'Tadjikistan',
        'code' => 'TJ',
        'lat' => 38.8610,
        'lng' => 71.2761
    ],
    [
        'name_ar' => 'تانزانيا',
        'name_en' => 'Tanzania',
        'name_fr' => 'Tanzanie',
        'code' => 'TZ',
        'lat' => -6.3690,
        'lng' => 34.8888
    ],
    [
        'name_ar' => 'تايلند',
        'name_en' => 'Thailand',
        'name_fr' => 'Thaïlande',
        'code' => 'TH',
        'lat' => 15.8700,
        'lng' => 100.9925
    ],
    [
        'name_ar' => 'تيمور الشرقية',
        'name_en' => 'Timor-Leste',
        'name_fr' => 'Timor oriental',
        'code' => 'TL',
        'lat' => -8.8742,
        'lng' => 125.7275
    ],
    [
        'name_ar' => 'توجو',
        'name_en' => 'Togo',
        'name_fr' => 'Togo',
        'code' => 'TG',
        'lat' => 8.6195,
        'lng' => 0.8248
    ],
    [
        'name_ar' => 'توكيلو',
        'name_en' => 'Tokelau',
        'name_fr' => 'Tokelau',
        'code' => 'TK',
        'lat' => -8.9671,
        'lng' => -171.8555
    ],
    [
        'name_ar' => 'تونجا',
        'name_en' => 'Tonga',
        'name_fr' => 'Tonga',
        'code' => 'TO',
        'lat' => -21.1789,
        'lng' => -175.1982
    ],
    [
        'name_ar' => 'ترينيداد وتوباغو',
        'name_en' => 'Trinidad and Tobago',
        'name_fr' => 'Trinité-et-Tobago',
        'code' => 'TT',
        'lat' => 10.6918,
        'lng' => -61.2225
    ],
    [
        'name_ar' => 'تريستان دا كونا',
        'name_en' => 'Tristan da Cunha',
        'name_fr' => 'Tristan da Cunha',
        'code' => 'TA',
        'lat' => -37.0662,
        'lng' => -12.2777
    ],
    [
        'name_ar' => 'تونس',
        'name_en' => 'Tunisia',
        'name_fr' => 'Tunisie',
        'code' => 'TN',
        'lat' => 33.8869,
        'lng' => 9.5375
    ],
    [
        'name_ar' => 'تركيا',
        'name_en' => 'Turkey',
        'name_fr' => 'Turquie',
        'code' => 'TR',
        'lat' => 38.9637,
        'lng' => 35.2433
    ],
    [
        'name_ar' => 'تركمانستان',
        'name_en' => 'Turkmenistan',
        'name_fr' => 'Turkménistan',
        'code' => 'TM',
        'lat' => 38.9697,
        'lng' => 59.5563
    ],
    [
        'name_ar' => 'جزر توركس وكايكوس',
        'name_en' => 'Turks and Caicos Islands',
        'name_fr' => 'Îles Turques-et-Caïques',
        'code' => 'TC',
        'lat' => 21.6940,
        'lng' => -71.7979
    ],
    [
        'name_ar' => 'توفالو',
        'name_en' => 'Tuvalu',
        'name_fr' => 'Tuvalu',
        'code' => 'TV',
        'lat' => -7.1095,
        'lng' => 177.6493
    ],
    [
        'name_ar' => 'جزر الولايات المتحدة الصغيرة النائية',
        'name_en' => 'United States Minor Outlying Islands',
        'name_fr' => 'Îles mineures éloignées des États-Unis',
        'code' => 'UM',
        'lat' => 19.3000,
        'lng' => 166.6500
    ],
    [
        'name_ar' => 'جزر العذراء الأمريكية',
        'name_en' => 'U.S. Virgin Islands',
        'name_fr' => 'Îles Vierges américaines',
        'code' => 'VI',
        'lat' => 18.3358,
        'lng' => -64.8963
    ],
    [
        'name_ar' => 'أوغندا',
        'name_en' => 'Uganda',
        'name_fr' => 'Ouganda',
        'code' => 'UG',
        'lat' => 1.3733,
        'lng' => 32.2903
    ],
    [
        'name_ar' => 'أوكرانيا',
        'name_en' => 'Ukraine',
        'name_fr' => 'Ukraine',
        'code' => 'UA',
        'lat' => 48.3794,
        'lng' => 31.1656
    ],
    [
        'name_ar' => 'الامارات العربية المتحدة',
        'name_en' => 'United Arab Emirates',
        'name_fr' => 'Émirats arabes unis',
        'code' => 'AE',
        'lat' => 23.4241,
        'lng' => 53.8478
    ],
    [
        'name_ar' => 'المملكة المتحدة',
        'name_en' => 'United Kingdom',
        'name_fr' => 'Royaume-Uni',
        'code' => 'GB',
        'lat' => 55.3781,
        'lng' => -3.4360
    ],
    [
        'name_ar' => 'الولايات المتحدة',
        'name_en' => 'United States',
        'name_fr' => 'États-Unis',
        'code' => 'US',
        'lat' => 37.0902,
        'lng' => -95.7129
    ],
    [
        'name_ar' => 'أورجواي',
        'name_en' => 'Uruguay',
        'name_fr' => 'Uruguay',
        'code' => 'UY',
        'lat' => -32.5228,
        'lng' => -55.7658
    ],
    [
        'name_ar' => 'أوزبكستان',
        'name_en' => 'Uzbekistan',
        'name_fr' => 'Ouzbékistan',
        'code' => 'UZ',
        'lat' => 41.3775,
        'lng' => 64.5853
    ],
    [
        'name_ar' => 'فانواتو',
        'name_en' => 'Vanuatu',
        'name_fr' => 'Vanuatu',
        'code' => 'VU',
        'lat' => -15.3767,
        'lng' => 166.9592
    ],
    [
        'name_ar' => 'الفاتيكان',
        'name_en' => 'Vatican City',
        'name_fr' => 'Vatican',
        'code' => 'VA',
        'lat' => 41.9029,
        'lng' => 12.4534
    ],
    [
        'name_ar' => 'فنزويلا',
        'name_en' => 'Venezuela',
        'name_fr' => 'Venezuela',
        'code' => 'VE',
        'lat' => 6.4238,
        'lng' => -66.5897
    ],
    [
        'name_ar' => 'فيتنام',
        'name_en' => 'Vietnam',
        'name_fr' => 'Viet Nam',
        'code' => 'VN',
        'lat' => 14.0583,
        'lng' => 108.2772
    ],
    [
        'name_ar' => 'والس وفوتونا',
        'name_en' => 'Wallis and Futuna',
        'name_fr' => 'Wallis-et-Futuna',
        'code' => 'WF',
        'lat' => -13.7687,
        'lng' => -177.1562
    ],
    [
        'name_ar' => 'الصحراء الغربية',
        'name_en' => 'Western Sahara',
        'name_fr' => 'Sahara occidental',
        'code' => 'EH',
        'lat' => 24.2155,
        'lng' => -12.8858
    ],
    [
        'name_ar' => 'اليمن',
        'name_en' => 'Yemen',
        'name_fr' => 'Yémen',
        'code' => 'YE',
        'lat' => 15.5527,
        'lng' => 48.5164
    ],
    [
        'name_ar' => 'زامبيا',
        'name_en' => 'Zambia',
        'name_fr' => 'Zambie',
        'code' => 'ZM',
        'lat' => -13.1339,
        'lng' => 27.8493
    ],
    [
        'name_ar' => 'زيمبابوي',
        'name_en' => 'Zimbabwe',
        'name_fr' => 'Zimbabwe',
        'code' => 'ZW',
        'lat' => -19.0154,
        'lng' => 29.1549
    ]];
        foreach($data as $d)
        {
            Country::firstOrCreate($d);
        }
    }
}
