<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $users = User::factory(5)->create();
        }

        $sampleContents = [
            "# Introduction to Laravel\n\nLaravel is a powerful PHP framework that makes web development a breeze.\n\n## Key Features\n\n- **Eloquent ORM**: Beautiful database interactions\n- **Blade Templates**: Elegant templating engine\n- **Artisan CLI**: Powerful command-line tools\n\n```php\n<?php\n\nuse Illuminate\\Support\\Facades\\Route;\n\nRoute::get('/', function () {\n    return view('welcome');\n});\n```",
            "# Building Modern Web Applications\n\nModern web development requires understanding multiple technologies.\n\n## Frontend Technologies\n\n- React\n- Vue.js\n- Tailwind CSS\n\n## Backend Technologies\n\n- Laravel\n- Node.js\n- Python Django\n\n```javascript\nconst greeting = 'Hello, World!';\nconsole.log(greeting);\n```",
            "# Database Design Best Practices\n\nDesigning a good database schema is crucial for application performance.\n\n## Normalization\n\n1. First Normal Form (1NF)\n2. Second Normal Form (2NF)\n3. Third Normal Form (3NF)\n\n```sql\nCREATE TABLE users (\n    id INT PRIMARY KEY AUTO_INCREMENT,\n    name VARCHAR(255),\n    email VARCHAR(255) UNIQUE\n);\n```",
            '# API Development with Laravel\n\nBuilding RESTful APIs is straightforward with Laravel.\n\n## Creating API Routes\n\n```php\nRoute::apiResource(\'posts\', PostController::class);\n```\n\n## API Resources\n\nUse API Resources to transform your models:\n\n```php\nreturn new PostResource($post);\n```',
            '# Testing Your Application\n\nWriting tests ensures your application works correctly.\n\n## Feature Tests\n\n```php\nit(\'can create a post\', function () {\n    $user = User::factory()->create();\n    \n    $response = $this->actingAs($user)\n        ->post(\'/posts\', [\'title\' => \'Test\']);\n    \n    $response->assertSuccessful();\n});\n```',
            '# Authentication in Laravel\n\nLaravel provides built-in authentication scaffolding.\n\n## Features\n\n- User registration\n- Password reset\n- Email verification\n- Remember me functionality\n\n```php\nif (Auth::attempt($credentials)) {\n    return redirect()->intended(\'/dashboard\');\n}\n```',
            '# Working with Eloquent\n\nEloquent is Laravel\'s ORM, making database queries elegant.\n\n## Relationships\n\n```php\n// One to Many\npublic function posts() {\n    return $this->hasMany(Post::class);\n}\n\n// Many to Many\npublic function tags() {\n    return $this->belongsToMany(Tag::class);\n}\n```',
            '# Queue Jobs in Laravel\n\nQueues allow you to defer time-consuming tasks.\n\n## Creating Jobs\n\n```php\nphp artisan make:job SendEmail\n```\n\n## Dispatching Jobs\n\n```php\nSendEmail::dispatch($user);\n```',
            '# Caching Strategies\n\nCaching improves application performance significantly.\n\n## Cache Drivers\n\n- File\n- Redis\n- Memcached\n- Database\n\n```php\nCache::remember(\'key\', 3600, function () {\n    return expensiveOperation();\n});\n```',
            "# Deployment Best Practices\n\nDeploying Laravel applications requires careful planning.\n\n## Environment Configuration\n\n- Set `APP_ENV=production`\n- Use strong `APP_KEY`\n- Configure database credentials\n- Set up queue workers\n\n```bash\nphp artisan config:cache\nphp artisan route:cache\nphp artisan view:cache\n```",
        ];

        $titles = [
            'Getting Started with Laravel',
            'Understanding Eloquent ORM',
            'Building RESTful APIs',
            'Authentication Made Easy',
            'Testing Your Laravel Application',
            'Working with Queues',
            'Caching for Performance',
            'Deployment Strategies',
            'Database Migrations',
            'Blade Templating',
            'Middleware in Laravel',
            'Service Providers',
            'Event Broadcasting',
            'File Storage',
            'Email Configuration',
            'Task Scheduling',
            'Error Handling',
            'Logging Best Practices',
            'Security Considerations',
            'Performance Optimization',
            'Package Development',
            'API Rate Limiting',
            'Database Seeding',
            'Model Factories',
            'Form Validation',
            'File Uploads',
            'Image Processing',
            'Search Functionality',
            'Pagination',
            'Localization',
            'Multi-tenancy',
            'WebSockets',
            'Real-time Notifications',
            'Payment Integration',
            'Social Authentication',
            'Two-Factor Authentication',
            'API Documentation',
            'GraphQL with Laravel',
            'Microservices Architecture',
            'Docker Deployment',
            'CI/CD Pipeline',
            'Monitoring Applications',
            'Backup Strategies',
            'Database Optimization',
            'Frontend Integration',
            'Mobile API Development',
            'Webhook Handling',
            'Third-party Integrations',
            'Custom Artisan Commands',
            'Advanced Routing',
        ];

        $posts = [];

        for ($i = 0; $i < 50; $i++) {
            $user = $users->random();
            $title = $titles[$i] ?? fake()->sentence();
            $content = $sampleContents[$i % count($sampleContents)] ?? fake()->paragraphs(10, true);
            $isPublished = fake()->boolean(70);
            $publishedAt = $isPublished ? fake()->dateTimeBetween('-6 months', 'now') : null;

            $posts[] = [
                'user_id' => $user->id,
                'title' => $title,
                'slug' => \Illuminate\Support\Str::slug($title),
                'excerpt' => fake()->paragraph(),
                'content' => $content,
                'featured_image' => null,
                'is_published' => $isPublished,
                'published_at' => $publishedAt,
                'created_at' => now()->subDays(rand(0, 180)),
                'updated_at' => now()->subDays(rand(0, 180)),
            ];
        }

        Post::insert($posts);

        $this->command->info('Created 50 posts successfully!');
    }
}
