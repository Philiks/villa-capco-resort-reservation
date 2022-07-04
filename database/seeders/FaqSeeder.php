<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::create([
            'question' => "What is the contact number?",
            'answer' => "0917 546 7499",
        ]);

        Faq::create([
            'question' => "Where is Villa Capco?",
            'answer' => "55 Axis Road, Kalawaan, Pasig, Philippines",
        ]);

        Faq::create([
            'question' => "Does Villa Capco has Facebook Page?",
            'answer' => "Yes, you can visit our Facebook Page at https://www.facebook.com/villacapco",
        ]);
    }
}
