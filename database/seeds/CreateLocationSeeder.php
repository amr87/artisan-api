<?php

use Illuminate\Database\Seeder;

class CreateLocationSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $egypt = App\Modules\locations\models\Country::create(['name' => 'مصر']);

        $cairo = App\Modules\locations\models\State::create([
                    'name' => 'القاهرة',
                    'country_id' => $egypt->id
        ]);

        /*
         * 
         * insert Cairo Districts
         *  
         */

        \App\Modules\locations\models\District::create([
            'name' => 'الزيتون',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الزاوية الحمراء',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'حدائق القبة',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الشرابية',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الظاهر',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'غمرة',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'القللى',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الساحل',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'شبرا',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'روض الفرج',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الأميرية',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'السلام',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'المرج',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'المطرية',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'عين شمس',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'النزهة',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'مصر الجديدة',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'مدينة نصر',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الوايلى',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'منشية ناصر',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'منشية البكرى',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الدويقة',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الأباجية',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'المقطم',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'باب الشعرية',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'العباسية',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'وسط البلد',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الأزبكية',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'بولاق أبو العلا',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'السبتية',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'التوفيقية',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الموسكى',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'العتبة',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'عابدين',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الدرب الأحمر',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'السيدة زينب',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'السيدة عائشة',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'السيدة نفيسة',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'مصر القديمة',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'دار السلام',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'المنيل',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'المعادى',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'البساتين',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'التبين',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => '15 مايو',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'حلوان',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الشروق',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'بدر',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'التجمع الثالث',
            'state_id' => $cairo->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'التجمع الخامس',
            'state_id' => $cairo->id,
        ]);

        /*
         * 
         * AlEXANDRIA 
         * 
         */

        $alex = App\Modules\locations\models\State::create([
                    'name' => 'الإسكندرية',
                    'country_id' => $egypt->id
        ]);

        /*
         * 
         * insert Alexandria Districts
         *  
         */

        \App\Modules\locations\models\District::create([
            'name' => 'العجمي',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'العامرية',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الأنفوشي',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'العصافرة',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'العطارين',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الأزاريطة',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'المندرة',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'بحري',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'باكوس',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'بولكلي',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'كامب شيزار',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'كليوباترا',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'فلمنج',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'جناكليس',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'جليم',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الجمرك',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الحضرة',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الإبراهيمية',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'كفر عبده',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'كرموز',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'كوم الدكة',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'اللبان',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'لوران',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'المعمورة',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'محطة الرمل',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'المنشية',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'المكس',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'محرم بك',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'سيدي بشر',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'سيدي جابر',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'سموحة',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الشاطبي',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'شدس',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'السيوف',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'صفر',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'سان ستيفانو',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'السرايا',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'الصالحية',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'العوايد',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'سبورتنج',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'ستانلي',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'ثروت',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'فكتوريا',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'الورديان',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'زيزينيا',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'رأس التين',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'المتراس',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'أبو قير',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'طوسون',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'المنتزة',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'الفلكى',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'برج العرب',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'الدخيلة',
            'state_id' => $alex->id,
        ]);


        \App\Modules\locations\models\District::create([
            'name' => 'الهانوفيل',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'البيطاش',
            'state_id' => $alex->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'غبريال',
            'state_id' => $alex->id,
        ]);

        /*
         * 
         *  GIZA
         * 
         * 
         */

        $giza = App\Modules\locations\models\State::create([
                    'name' => 'الجيزة',
                    'country_id' => $egypt->id
        ]);


        /*
         * 
         * insert Giza Districts
         *  
         */

        \App\Modules\locations\models\District::create([
            'name' => '6 أكتوبر',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الشيخ زايد',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الحوامدية',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'البدرشين',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الصف',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'أطفيح',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'العياط',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'منشية القناطر',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'أوسيم',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'كرداسة',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'أبو النمرس',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'ناهيا',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الكيت كات',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'أرض اللواء',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'أمبابة',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الزمالك',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الدقى',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'العجوزة',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'المهندسين',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'بولاق الدكرور',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الهرم',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'العمرانية',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الوراق',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'المنيب',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'بين السرايات',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'أم المصريين',
            'state_id' => $giza->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'ساقية مكى',
            'state_id' => $giza->id,
        ]);

        /*
         * 
         *  Qalubia
         * 
         * 
         */

        $qalubia = App\Modules\locations\models\State::create([
                    'name' => 'القليوبية',
                    'country_id' => $egypt->id
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'بنها',
            'state_id' => $qalubia->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'قليوب',
            'state_id' => $qalubia->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'قها',
            'state_id' => $qalubia->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'طوخ',
            'state_id' => $qalubia->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'شبرا الخيمة',
            'state_id' => $qalubia->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'القناطر',
            'state_id' => $qalubia->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الخانكة',
            'state_id' => $qalubia->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'كفر شكر',
            'state_id' => $qalubia->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'العبور',
            'state_id' => $qalubia->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الخصوص',
            'state_id' => $qalubia->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'شبين القناطر',
            'state_id' => $qalubia->id,
        ]);


        /*
         * 
         *  Buhiera
         * 
         * 
         */

        $buhiera = App\Modules\locations\models\State::create([
                    'name' => 'البحيرة',
                    'country_id' => $egypt->id
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'دمنهور',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'كفر الدوار',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'أبو حمص',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'أيتاى البارود',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'أبو المطامير',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'رشيد',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'إدكو',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الدلنجات',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'المحمودية',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الرحمانية',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'حوش عيسى',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'شبراخيت',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'كوم حمادة',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'بدر',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'وادى النطرون',
            'state_id' => $buhiera->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'النوبارية',
            'state_id' => $buhiera->id,
        ]);



        /*
         * 
         *  'Matruh
         * 
         * 
         */

        $matruh = App\Modules\locations\models\State::create([
                    'name' => 'مرسى مطروح',
                    'country_id' => $egypt->id
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'مطروح',
            'state_id' => $matruh->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الحمام',
            'state_id' => $matruh->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'العلمين',
            'state_id' => $matruh->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الضبعة',
            'state_id' => $matruh->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'سيدى برانى',
            'state_id' => $matruh->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'السلوم',
            'state_id' => $matruh->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'سيوة',
            'state_id' => $matruh->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'النجيلة',
            'state_id' => $matruh->id,
        ]);
        
        
        /*
         * 
         *  Damietta
         * 
         * 
         */

        $damietta = App\Modules\locations\models\State::create([
                    'name' => 'دمياط',
                    'country_id' => $egypt->id
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'دمياط',
            'state_id' => $damietta->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'دمياط الجديدة',
            'state_id' => $damietta->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'رأس البر',
            'state_id' => $damietta->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'فارسكور',
            'state_id' => $damietta->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'كفر سعد',
            'state_id' => $damietta->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الزرقا',
            'state_id' => $damietta->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'السرو',
            'state_id' => $damietta->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الروضة',
            'state_id' => $damietta->id,
        ]);
        

        \App\Modules\locations\models\District::create([
            'name' => 'كفر البطيخ',
            'state_id' => $damietta->id,
        ]);
        

        \App\Modules\locations\models\District::create([
            'name' => 'عزبة البرج',
            'state_id' => $damietta->id,
        ]);
        

        \App\Modules\locations\models\District::create([
            'name' => 'ميت أبو غالب',
            'state_id' => $damietta->id,
        ]);
        
        
        
        /*
         * 
         *  Daqhlya
         * 
         * 
         */

        $daqhlya = App\Modules\locations\models\State::create([
                    'name' => 'الدقهلية',
                    'country_id' => $egypt->id
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'المنصورة',
            'state_id' => $daqhlya->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'طلخا',
            'state_id' => $daqhlya->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'ميت غمر',
            'state_id' => $daqhlya->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'دكرنس',
            'state_id' => $daqhlya->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'أجا',
            'state_id' => $daqhlya->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'منية النصر',
            'state_id' => $daqhlya->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'السنبلاوين',
            'state_id' => $daqhlya->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'الكردى',
            'state_id' => $daqhlya->id,
        ]);
        

        \App\Modules\locations\models\District::create([
            'name' => 'بنى عبيد',
            'state_id' => $daqhlya->id,
        ]);
        

        \App\Modules\locations\models\District::create([
            'name' => 'المنزلة',
            'state_id' => $daqhlya->id,
        ]);
        

        \App\Modules\locations\models\District::create([
            'name' => 'تمى الأمديد',
            'state_id' => $daqhlya->id,
        ]);
        

        \App\Modules\locations\models\District::create([
            'name' => 'الجمالية',
            'state_id' => $daqhlya->id,
        ]);
        

        \App\Modules\locations\models\District::create([
            'name' => 'شربين',
            'state_id' => $daqhlya->id,
        ]);
        

        \App\Modules\locations\models\District::create([
            'name' => 'المطرية',
            'state_id' => $daqhlya->id,
        ]);
        

        \App\Modules\locations\models\District::create([
            'name' => 'بلقاس',
            'state_id' => $daqhlya->id,
        ]);
        

        \App\Modules\locations\models\District::create([
            'name' => 'ميت سلسيل',
            'state_id' => $daqhlya->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'جمصة',
            'state_id' => $daqhlya->id,
        ]);

        \App\Modules\locations\models\District::create([
            'name' => 'محلة دمنة',
            'state_id' => $daqhlya->id,
        ]);
        
        \App\Modules\locations\models\District::create([
            'name' => 'نبروه',
            'state_id' => $daqhlya->id,
        ]);
        

    }

}
