<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\JobAd;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'felixdevberlin@gmail.com',
            'password' => Hash::make('12345678'),
            'id' => 1,
        ]);

        // Create job categories
        $jobCategories = [
            'Full-Time',
            'Part-Time',
            'Temporary',
            'Contract',
            'Freelance',
            'Internship',
            'Seasonal',
            'Remote',
            'On-Call',
            'Shift Work',
            'Per Diem',
        ];

        $categoryIds = [];
        foreach ($jobCategories as $categoryName) {
            $category = Category::create(['name' => $categoryName]);
            $categoryIds[] = $category->id;
        }

        // Create companies
        $companies = [
            'Tech Innovations Inc.',
            'Web Solutions LLC',
            'Data Insights Co.',
            'Cloud Services Ltd.',
            'Mobile Innovations',
            'SecureTech',
            'Creative Solutions',
            'Enterprise Tech',
            'AI Innovations',
            'Web Creators',
        ];

        $companyIds = [];
        foreach ($companies as $companyName) {
            $company = Company::create(['name' => $companyName, 'created_by' => 1,]);
            $companyIds[] = $company->id;
        }

        // Create mock job ads
        $jobAds = [
            [
                'title' => 'Senior Software Engineer',
                'description' => 'We are seeking a talented Senior Software Engineer to join our innovative team. The ideal candidate will have strong experience in PHP, Laravel, and modern JavaScript frameworks.',
                'location' => 'San Francisco, CA',
                'salary' => 150000.00,
                'contact_name' => 'Human Resource Manager',
                'contact_email' => 'hr@techinnovations.com',
            ],
            [
                'title' => 'Full Stack Developer',
                'description' => 'A dynamic Full Stack Developer is needed to enhance our web applications. Experience in React, Node.js, and MongoDB is required.',
                'location' => 'New York, NY',
                'salary' => 120000.00,
                'contact_name' => 'Recruitment Team',
                'contact_email' => 'careers@websolutions.com',
            ],
            [
                'title' => 'Data Scientist',
                'description' => 'Join our team as a Data Scientist to analyze complex datasets and drive data-driven decision making. Proficiency in Python, R, and SQL is essential.',
                'location' => 'Austin, TX',
                'salary' => 130000.00,
                'contact_name' => 'HR Department',
                'contact_email' => 'jobs@datainsights.com',
            ],
            [
                'title' => 'DevOps Engineer',
                'description' => 'We need a skilled DevOps Engineer to manage our cloud infrastructure. Experience with AWS, Docker, and Kubernetes is a must.',
                'location' => 'Seattle, WA',
                'salary' => 140000.00,
                'contact_name' => 'Tech Recruiter',
                'contact_email' => 'techrecruiter@cloudservices.com',
            ],
            [
                'title' => 'Mobile App Developer',
                'description' => 'Seeking a Mobile App Developer with expertise in iOS and Android development to build and maintain our mobile applications.',
                'location' => 'Los Angeles, CA',
                'salary' => 125000.00,
                'contact_name' => 'Hiring Manager',
                'contact_email' => 'hiring@mobileinnovations.com',
            ],
            [
                'title' => 'Cybersecurity Specialist',
                'description' => 'We are looking for a Cybersecurity Specialist to protect our systems and networks. Knowledge of security protocols, firewalls, and encryption is required.',
                'location' => 'Washington, DC',
                'salary' => 135000.00,
                'contact_name' => 'Security Team Lead',
                'contact_email' => 'security@securetech.com',
            ],
            [
                'title' => 'UI/UX Designer',
                'description' => 'Creative UI/UX Designer needed to design user-friendly interfaces. Proficiency in Adobe XD, Sketch, and Figma is essential.',
                'location' => 'Chicago, IL',
                'salary' => 110000.00,
                'contact_name' => 'Design Director',
                'contact_email' => 'design@creativesolutions.com',
            ],
            [
                'title' => 'Backend Developer',
                'description' => 'Backend Developer required to build and maintain server-side logic. Expertise in Java, Spring Boot, and SQL databases is necessary.',
                'location' => 'Houston, TX',
                'salary' => 128000.00,
                'contact_name' => 'IT Recruiter',
                'contact_email' => 'itjobs@enterprisetech.com',
            ],
            [
                'title' => 'Machine Learning Engineer',
                'description' => 'We are seeking a Machine Learning Engineer to develop and implement ML models. Strong background in Python, TensorFlow, and scikit-learn is required.',
                'location' => 'Boston, MA',
                'salary' => 145000.00,
                'contact_name' => 'AI Team Lead',
                'contact_email' => 'ai@aiinnovations.com',
            ],
            [
                'title' => 'Frontend Developer',
                'description' => 'A Frontend Developer is needed to create responsive web applications. Skills in HTML, CSS, JavaScript, and Angular are essential.',
                'location' => 'Miami, FL',
                'salary' => 115000.00,
                'contact_name' => 'Web Development Manager',
                'contact_email' => 'webdev@webcreators.com',
            ],
            [
                'title' => 'Data Scientist',
                'description' => 'Data Scientist needed to analyze and interpret complex data to help companies make better business decisions. Proficiency in Python, R, and SQL is required.',
                'location' => 'San Francisco, CA',
                'salary' => 150000.00,
                'contact_name' => 'Data Science Lead',
                'contact_email' => 'datascience@analyticscorp.com',
            ],
            [
                'title' => 'DevOps Engineer',
                'description' => 'Looking for a DevOps Engineer to manage infrastructure and deployment processes. Experience with Docker, Kubernetes, and CI/CD pipelines is necessary.',
                'location' => 'Seattle, WA',
                'salary' => 135000.00,
                'contact_name' => 'DevOps Manager',
                'contact_email' => 'devops@cloudtechsolutions.com',
            ],
            [
                'title' => 'UX/UI Designer',
                'description' => 'Seeking a UX/UI Designer to create engaging and user-friendly interfaces for web and mobile applications. Strong portfolio showcasing design skills in Adobe XD, Sketch, and Figma is a must.',
                'location' => 'New York, NY',
                'salary' => 105000.00,
                'contact_name' => 'Design Lead',
                'contact_email' => 'design@creativeworks.com',
            ],

        ];

        foreach ($jobAds as $jobAd) {
            JobAd::create(array_merge($jobAd, [
                'company_id' => $companyIds[array_rand($companyIds)],
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'created_by' => 1,
            ]));
        }
    }
}
