<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Household;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $households = Household::all();

        // Sample members data
        $members = [
            // Family 1 (KK001)
            [
                'membership_number' => 'AHM001',
                'ic_number' => '750815105234',
                'full_name' => 'Ahmad bin Abdullah',
                'date_of_birth' => '1975-08-15',
                'gender' => 'male',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0199876543',
                'email' => 'ahmad.abdullah@email.com',
                'occupation' => 'Guru',
                'education_level' => 'degree',
                'household_id' => 1,
                'relationship' => 'head',
                'is_head' => true,
            ],
            [
                'membership_number' => 'AHM002',
                'ic_number' => '800203105678',
                'full_name' => 'Siti Fatimah binti Hassan',
                'date_of_birth' => '1980-02-03',
                'gender' => 'female',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0198765432',
                'email' => 'siti.fatimah@email.com',
                'occupation' => 'Suri Rumah',
                'education_level' => 'secondary',
                'household_id' => 1,
                'relationship' => 'spouse',
                'is_head' => false,
            ],
            [
                'membership_number' => 'AHM003',
                'ic_number' => '050612105890',
                'full_name' => 'Muhammad Hafiz bin Ahmad',
                'date_of_birth' => '2005-06-12',
                'gender' => 'male',
                'bangsa' => 'melayu',
                'marital_status' => 'single',
                'phone_number' => '0187654321',
                'email' => null,
                'occupation' => 'Pelajar',
                'education_level' => 'secondary',
                'household_id' => 1,
                'relationship' => 'child',
                'is_head' => false,
            ],

            // Family 2 (KK002)
            [
                'membership_number' => 'AHM004',
                'ic_number' => '701020105123',
                'full_name' => 'Ibrahim bin Yusof',
                'date_of_birth' => '1970-10-20',
                'gender' => 'male',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0195551234',
                'email' => 'ibrahim.yusof@email.com',
                'occupation' => 'Kontraktor',
                'education_level' => 'diploma',
                'household_id' => 2,
                'relationship' => 'head',
                'is_head' => true,
            ],
            [
                'membership_number' => 'AHM005',
                'ic_number' => '730415105567',
                'full_name' => 'Aminah binti Ismail',
                'date_of_birth' => '1973-04-15',
                'gender' => 'female',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0195552345',
                'email' => 'aminah.ismail@email.com',
                'occupation' => 'Jururawat',
                'education_level' => 'diploma',
                'household_id' => 2,
                'relationship' => 'spouse',
                'is_head' => false,
            ],

            // Family 3 (KK003)
            [
                'membership_number' => 'AHM006',
                'ic_number' => '650708105789',
                'full_name' => 'Hassan bin Omar',
                'date_of_birth' => '1965-07-08',
                'gender' => 'male',
                'bangsa' => 'melayu',
                'marital_status' => 'widowed',
                'phone_number' => '0193334567',
                'email' => null,
                'occupation' => 'Petani',
                'education_level' => 'primary',
                'household_id' => 3,
                'relationship' => 'head',
                'is_head' => true,
            ],
            [
                'membership_number' => 'AHM007',
                'ic_number' => '920315105234',
                'full_name' => 'Nurul Ain binti Hassan',
                'date_of_birth' => '1992-03-15',
                'gender' => 'female',
                'bangsa' => 'melayu',
                'marital_status' => 'single',
                'phone_number' => '0193335678',
                'email' => 'nurul.ain@email.com',
                'occupation' => 'Pembantu Kedai',
                'education_level' => 'secondary',
                'household_id' => 3,
                'relationship' => 'child',
                'is_head' => false,
            ],

            // Family 4 (KK004)
            [
                'membership_number' => 'AHM008',
                'ic_number' => '820522105890',
                'full_name' => 'Mohd Azmi bin Rahman',
                'date_of_birth' => '1982-05-22',
                'gender' => 'male',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0196667890',
                'email' => 'azmi.rahman@email.com',
                'occupation' => 'Pengurus',
                'education_level' => 'master',
                'household_id' => 4,
                'relationship' => 'head',
                'is_head' => true,
            ],
            [
                'membership_number' => 'AHM009',
                'ic_number' => '850918105345',
                'full_name' => 'Noor Azlina binti Hamid',
                'date_of_birth' => '1985-09-18',
                'gender' => 'female',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0196668901',
                'email' => 'azlina.hamid@email.com',
                'occupation' => 'Akauntan',
                'education_level' => 'degree',
                'household_id' => 4,
                'relationship' => 'spouse',
                'is_head' => false,
            ],
            [
                'membership_number' => 'AHM010',
                'ic_number' => '101205105678',
                'full_name' => 'Aisyah binti Mohd Azmi',
                'date_of_birth' => '2010-12-05',
                'gender' => 'female',
                'bangsa' => 'melayu',
                'marital_status' => 'single',
                'phone_number' => '0186669012',
                'email' => null,
                'occupation' => 'Pelajar',
                'education_level' => 'secondary',
                'household_id' => 4,
                'relationship' => 'child',
                'is_head' => false,
            ],

            // Family 5 (KK005)
            [
                'membership_number' => 'AHM011',
                'ic_number' => '780910105234',
                'full_name' => 'Zainuddin bin Ali',
                'date_of_birth' => '1978-09-10',
                'gender' => 'male',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0197778901',
                'email' => 'zain.ali@email.com',
                'occupation' => 'Pemandu Teksi',
                'education_level' => 'secondary',
                'household_id' => 5,
                'relationship' => 'head',
                'is_head' => true,
            ],
            [
                'membership_number' => 'AHM012',
                'ic_number' => '810725105567',
                'full_name' => 'Rohani binti Mahmud',
                'date_of_birth' => '1981-07-25',
                'gender' => 'female',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0197779012',
                'email' => null,
                'occupation' => 'Suri Rumah',
                'education_level' => 'secondary',
                'household_id' => 5,
                'relationship' => 'spouse',
                'is_head' => false,
            ],

            // Family 6 (KK006)
            [
                'membership_number' => 'AHM013',
                'ic_number' => '690305105890',
                'full_name' => 'Abdullah bin Mohamed',
                'date_of_birth' => '1969-03-05',
                'gender' => 'male',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0198889123',
                'email' => 'abdullah.m@email.com',
                'occupation' => 'Jurutera',
                'education_level' => 'degree',
                'household_id' => 6,
                'relationship' => 'head',
                'is_head' => true,
            ],
            [
                'membership_number' => 'AHM014',
                'ic_number' => '720812105345',
                'full_name' => 'Khadijah binti Ahmad',
                'date_of_birth' => '1972-08-12',
                'gender' => 'female',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0198889234',
                'email' => 'khadijah.ahmad@email.com',
                'occupation' => 'Pensyarah',
                'education_level' => 'master',
                'household_id' => 6,
                'relationship' => 'spouse',
                'is_head' => false,
            ],

            // Family 7 (KK007)
            [
                'membership_number' => 'AHM015',
                'ic_number' => '880420105678',
                'full_name' => 'Faizal bin Razak',
                'date_of_birth' => '1988-04-20',
                'gender' => 'male',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0192223456',
                'email' => 'faizal.razak@email.com',
                'occupation' => 'Peniaga',
                'education_level' => 'secondary',
                'household_id' => 7,
                'relationship' => 'head',
                'is_head' => true,
            ],
            [
                'membership_number' => 'AHM016',
                'ic_number' => '900615105234',
                'full_name' => 'Haslina binti Ibrahim',
                'date_of_birth' => '1990-06-15',
                'gender' => 'female',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0192224567',
                'email' => 'haslina.ibrahim@email.com',
                'occupation' => 'Suri Rumah',
                'education_level' => 'diploma',
                'household_id' => 7,
                'relationship' => 'spouse',
                'is_head' => false,
            ],
            [
                'membership_number' => 'AHM017',
                'ic_number' => '150308105567',
                'full_name' => 'Danial bin Faizal',
                'date_of_birth' => '2015-03-08',
                'gender' => 'male',
                'bangsa' => 'melayu',
                'marital_status' => 'single',
                'phone_number' => '0182225678',
                'email' => null,
                'occupation' => 'Pelajar',
                'education_level' => 'primary',
                'household_id' => 7,
                'relationship' => 'child',
                'is_head' => false,
            ],

            // Family 8 (KK008)
            [
                'membership_number' => 'AHM018',
                'ic_number' => '760228105890',
                'full_name' => 'Rosli bin Hassan',
                'date_of_birth' => '1976-02-28',
                'gender' => 'male',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0194445678',
                'email' => 'rosli.hassan@email.com',
                'occupation' => 'Pegawai Kerajaan',
                'education_level' => 'degree',
                'household_id' => 8,
                'relationship' => 'head',
                'is_head' => true,
            ],
            [
                'membership_number' => 'AHM019',
                'ic_number' => '781110105345',
                'full_name' => 'Zaleha binti Mansor',
                'date_of_birth' => '1978-11-10',
                'gender' => 'female',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0194446789',
                'email' => 'zaleha.mansor@email.com',
                'occupation' => 'Guru',
                'education_level' => 'degree',
                'household_id' => 8,
                'relationship' => 'spouse',
                'is_head' => false,
            ],

            // Family 9 (KK009)
            [
                'membership_number' => 'AHM020',
                'ic_number' => '830505105678',
                'full_name' => 'Hafiz bin Karim',
                'date_of_birth' => '1983-05-05',
                'gender' => 'male',
                'bangsa' => 'melayu',
                'marital_status' => 'divorced',
                'phone_number' => '0195556789',
                'email' => 'hafiz.karim@email.com',
                'occupation' => 'Mekanik',
                'education_level' => 'secondary',
                'household_id' => 9,
                'relationship' => 'head',
                'is_head' => true,
            ],

            // Family 10 (KK010)
            [
                'membership_number' => 'AHM021',
                'ic_number' => '741218105234',
                'full_name' => 'Sulaiman bin Abdul Rahman',
                'date_of_birth' => '1974-12-18',
                'gender' => 'male',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0196667890',
                'email' => 'sulaiman.ar@email.com',
                'occupation' => 'Doktor',
                'education_level' => 'phd',
                'household_id' => 10,
                'relationship' => 'head',
                'is_head' => true,
            ],
            [
                'membership_number' => 'AHM022',
                'ic_number' => '770822105567',
                'full_name' => 'Mariam binti Kamal',
                'date_of_birth' => '1977-08-22',
                'gender' => 'female',
                'bangsa' => 'melayu',
                'marital_status' => 'married',
                'phone_number' => '0196668901',
                'email' => 'mariam.kamal@email.com',
                'occupation' => 'Farmasi',
                'education_level' => 'degree',
                'household_id' => 10,
                'relationship' => 'spouse',
                'is_head' => false,
            ],
        ];

        // Create members and attach to households
        foreach ($members as $memberData) {
            $householdId = $memberData['household_id'];
            $relationship = $memberData['relationship'];
            $isHead = $memberData['is_head'];

            // Remove household-related data from member array
            unset($memberData['household_id']);
            unset($memberData['relationship']);
            unset($memberData['is_head']);

            // Create member
            $member = Member::create($memberData);

            // Attach to household
            $member->households()->attach($householdId, [
                'relationship' => $relationship,
                'is_head' => $isHead,
            ]);
        }

        $this->command->info('22 members created and assigned to households successfully!');
    }
}