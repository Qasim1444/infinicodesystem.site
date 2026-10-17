<?php

namespace App\Http\Controllers;

use App\Support\BlogContent;
use App\Support\SiteData;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $paths = [
            '/',
            '/about',
            '/services',
            '/engineers',
            '/work',
            '/academy',
            '/blog',
            '/technologies',
            '/student-projects',
            '/reviews',
            '/resources',
            '/faq',
            '/consultation',
            '/careers',
            '/contact',
        ];

        foreach (SiteData::services() as $service) {
            $paths[] = "/services/{$service['slug']}";
        }

        foreach ([
            'machine-learning-engineers',
            'data-scientist-engineers',
            'python-developers',
            'devops-developers',
            'react-js-developers',
            'flutter-developers',
            'react-native-developers',
            'android-developers',
            'ruby-on-rails-developers',
            'django-developers',
            'go-lang-developers',
        ] as $engineerSlug) {
            $paths[] = "/engineers/{$engineerSlug}";
        }

        foreach (SiteData::projects() as $project) {
            $paths[] = "/work/{$project['slug']}";
        }

        foreach (SiteData::courses() as $course) {
            $paths[] = "/academy/{$course['slug']}";
        }

        foreach (BlogContent::posts() as $post) {
            $paths[] = "/blog/{$post['slug']}";
        }

        $domain = (string) (SiteData::site()['company']['domain'] ?? config('app.url'));
        $baseUrl = str_starts_with($domain, 'http')
            ? rtrim($domain, '/')
            : 'https://'.trim($domain, '/');
        $entries = array_map(static function (string $path) use ($baseUrl): string {
            $location = htmlspecialchars($baseUrl.'/'.ltrim($path, '/'), ENT_XML1 | ENT_QUOTES, 'UTF-8');

            return "<url><loc>{$location}</loc></url>";
        }, array_values(array_unique($paths)));

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'.
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.
            implode('', $entries).
            '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
