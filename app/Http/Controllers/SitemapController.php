<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $today = '2026-11-25';
        $entries = [
            ['path' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['path' => '/about', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/services', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/work', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['path' => '/blog', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/contact', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['path' => '/consultation', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/services/ai-automation', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/services/api-development', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/services/crm-erp-development', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/services/custom-software', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/services/laravel-development', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/services/pos-inventory', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/services/react-native-development', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/services/saas-development', 'priority' => '0.8', 'changefreq' => 'monthly'],

            ['path' => '/blog/add-ai-to-existing-laravel-application', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/ai-automation-use-cases-business-operations', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/ai-document-processing-workflow', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/api-development-integration-planning', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/choose-laravel-development-company', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/crm-workflow-mapping-before-development', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/custom-crm-data-migration-checklist', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/custom-crm-vs-off-the-shelf-crm', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/custom-pos-vs-packaged-pos', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/custom-software-discovery-workshop-guide', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/custom-software-launch-roadmap', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/erp-software-development-where-to-start', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/laravel-codebase-handover-checklist', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/laravel-saas-development-features', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/multi-location-inventory-system-planning', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/plan-secure-laravel-api-integration', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/pos-and-inventory-integrations-guide', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/pos-software-discovery-checklist', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/prepare-before-hiring-react-native-team', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/rag-implementation-internal-knowledge-base', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/react-native-api-integration-guide', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/react-native-app-development-cost-drivers', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/react-native-app-qa-checklist', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/react-native-vs-native-mobile-development', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/reduce-custom-software-project-risk', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/replace-inventory-spreadsheets', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/role-based-business-dashboard-development', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/scalable-multi-tenant-saas-architecture', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/when-to-build-a-custom-crm', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/blog/workflow-automation-vs-ai-assistant', 'priority' => '0.7', 'changefreq' => 'monthly'],

        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($entries as $entry) {
            $loc = 'https://infinicodesystem.site' . $entry['path'];
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($loc, ENT_XML1, 'UTF-8') . '</loc>';
            $xml .= '<lastmod>' . $today . '</lastmod>';
            $xml .= '<changefreq>' . $entry['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $entry['priority'] . '</priority>';
            $xml .= '</url>';
        }
        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
