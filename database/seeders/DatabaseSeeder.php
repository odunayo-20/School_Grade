<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Grade;
use App\Models\Session;
use App\Models\Subject;
use App\Models\Semester;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\StudentClass;
use App\Models\SchoolSession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Grade::factory()->create(
        //     [
        //         'min_score' => '20',
        //         'max_score' => '40',
        //         'grade' => 'A',
        //         'remark' => 'Good'
        //     // ],
        //     // [
        //     //     'min_score' => '20',
        //     //     'max_score' => '40',
        //     //     'grade' => 'A',
        //     //     'remark' => 'Good'
        //     // ],
        //     // [
        //     //     'min_score' => '20',
        //     //     'max_score' => '40',
        //     //     'grade' => 'A',
        //     //     'remark' => 'Good'
        //     ]
        // );

        // Admin::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('12345'),
        // ]);

        StudentClass::factory()->createMany([
            ['name' => 'JSS1', 'slug' => 'jss1'],
            ['name' => 'JSS2', 'slug' => 'jss2'],
            ['name' => 'JSS3', 'slug' => 'jss3'],
            ['name' => 'SSS1', 'slug' => 'sss1'],
            ['name' => 'SSS2', 'slug' => 'sss2'],
            ['name' => 'SSS3', 'slug' => 'sss3'],
        ]);

        // Semester::factory()->createMany([
        //     ['name' => 'first semester', 'slug' => 'first semester', 'start_of' => '2012', 'end_of' => '2013'],
        //     ['name' => 'second semester', 'slug' => 'second semester', 'start_of' => '2013', 'end_of' => '2014'],
        //     ['name' => 'third semester', 'slug' => 'third semester', 'start_of' => '2014', 'end_of' => '2015'],
        //     ['name' => 'fourth semester', 'slug' => 'fourth semester', 'start_of' => '2015', 'end_of' => '2016'],
        //     ['name' => 'fifth semester', 'slug' => 'fifth semester', 'start_of' => '2016', 'end_of' => '2017'],
        //     ['name' => 'sixth semester', 'slug' => 'sixth semester', 'start_of' => '2017', 'end_of' => '2018'],
        //     ['name' => 'seventh semester', 'slug' => 'seventh semester', 'start_of' => '2018', 'end_of' => '2019'],
        //     ['name' => 'eighth semester', 'slug' => 'eighth semester', 'start_of' => '2019', 'end_of' => '2020'],
        //     ['name' => 'nineth semester', 'slug' => 'nineth semester', 'start_of' => '2020', 'end_of' => '2021'],
        //     ['name' => 'tenth semester', 'slug' => 'tenth semester', 'start_of' => '2021', 'end_of' => '2022'],
        // ]);
//         Subject::factory()->createMany([
//             ['name' => 'math', 'code' => 'math 501', 'class_id' => '5', 'status' => '0'],
//             ['name' => 'english', 'code' => 'eng 501', 'class_id' => '5', 'status' => '0'],
//             ['name' => 'chemistry', 'code' => 'chem 501', 'class_id' => '5', 'status' => '0'],
//             ['name' => 'physics', 'code' => 'phy 501', 'class_id' => '5', 'status' => '0'],
//             ['name' => 'biology', 'code' => 'bio 501', 'class_id' => '5', 'status' => '0'],
//             ['name' => 'computer', 'code' => 'com 501', 'class_id' => '5', 'status' => '0'],
//             ['name' => 'geography', 'code' => 'geo 501', 'class_id' => '5', 'status' => '0'],
//             ['name' => 'history', 'code' => 'his 501', 'class_id' => '5', 'status' => '0'],
//             ['name' => 'economics', 'code' => 'eco 501', 'class_id' => '5', 'status' => '0'],
//             ['name' => 'government', 'code' => 'gov 501', 'class_id' => '5', 'status' => '0'],
//             ['name' => 'yoruba', 'code' => 'you 501', 'class_id' => '5', 'status' => '0'],

//         ]);



//         SchoolSession::factory()->createMany([
// ['name'=>'2027/2028', 'status' => '0' ],
// ['name'=>'2026/2027', 'status' => '0' ],
// ['name'=>'2025/2026', 'status' => '0' ],
// ['name'=>'2024/2025', 'status' => '0' ],
// ['name'=>'2023/2024', 'status' => '0' ],
// ['name'=>'2022/2023', 'status' => '0' ],
// ['name'=>'2021/2022', 'status' => '0' ],
// ['name'=>'2020/2021', 'status' => '0' ],
//         ]);
    }
}
