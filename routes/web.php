<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;
use App\Support\BlogContent;
use App\Support\SiteData;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('HomeView', [
        'homeServices' => SiteData::homeServices(),
        'featuredProjects' => SiteData::projects(),
        'stats' => SiteData::stats(),
        'clientTestimonials' => SiteData::clientTestimonials(),
        'recentPosts' => array_slice(BlogContent::posts(), 0, 3),
        'techCategories' => SiteData::techCategories(),
        'differentiators' => SiteData::differentiators(),
        'processSteps' => SiteData::processSteps(),
        'courses' => SiteData::courses(),
    ]);
})->name('home');

Route::get('/about', function () {
    return Inertia::render('AboutView', [
        'team' => SiteData::team(),
        'values' => SiteData::values(),
        'timeline' => SiteData::timeline(),
        'stats' => SiteData::stats(),
    ]);
})->name('about');

// Services
Route::get('/services', function () {
    return Inertia::render('ServicesView', [
        'services' => SiteData::services(),
    ]);
})->name('services');

// Static SEO service pages
$staticServiceComponents = array(
    'laravel-development' => 'Services/LaravelDevelopment',
    'react-native-development' => 'Services/ReactNativeDevelopment',
    'crm-erp-development' => 'Services/CrmErpDevelopment',
    'pos-inventory' => 'Services/PosInventory',
    'ai-automation' => 'Services/AiAutomation',
    'saas-development' => 'Services/SaasDevelopment',
    'api-development' => 'Services/ApiDevelopment',
    'custom-software' => 'Services/CustomSoftware',
);
foreach ($staticServiceComponents as $staticSlug => $staticComponent) {
    Route::get("/services/{staticSlug}", function (string $staticSlug) use ($staticComponent) {
        return Inertia::render($staticComponent, ['slug' => $staticSlug]);
    })->where('staticSlug', implode('|', array_keys($staticServiceComponents)))->name('static-service-'.$staticSlug);
}

Route::get('/services/{slug}', function (string $slug) {
    return Inertia::render('ServiceDetailView', [
        'service' => SiteData::getService($slug),
        'services' => SiteData::services(),
        'slug' => $slug,
    ]);
})->name('service-detail');

// Engineering talent
Route::get('/engineers', function () {
    return Inertia::render('EngineersView');
})->name('engineers');

Route::get('/engineers/{slug}', function (string $slug) {
    return Inertia::render('EngineerDetailView', [
        'slug' => $slug,
    ]);
})->name('engineer-detail');

// Work / case studies
Route::get('/work', function () {
    return Inertia::render('WorkView', [
        'projects' => SiteData::projects(),
        'projectCategories' => SiteData::projectCategories(),
    ]);
})->name('work');

Route::get('/work/{slug}', function (string $slug) {
    return Inertia::render('WorkDetailView', [
        'project' => SiteData::getProject($slug),
        'projects' => SiteData::projects(),
        'slug' => $slug,
    ]);
})->name('work-detail');

// Academy / courses
Route::get('/academy', function () {
    return Inertia::render('AcademyView', [
        'courses' => SiteData::courses(),
        'academyStats' => SiteData::academyStats(),
        'studentProjects' => SiteData::studentProjects(),
    ]);
})->name('academy');

Route::get('/academy/{slug}', function (string $slug) {
    return Inertia::render('CourseDetailView', [
        'course' => SiteData::getCourse($slug),
        'courses' => SiteData::courses(),
        'slug' => $slug,
    ]);
})->name('course-detail');

// Static code-based blog
$staticBlogComponents = array(
    'choose-laravel-development-company' => 'Blog/ChooseLaravelDevelopmentCompany',
    'laravel-saas-development-features' => 'Blog/LaravelSaasDevelopmentFeatures',
    'when-to-build-a-custom-crm' => 'Blog/WhenToBuildACustomCrm',
    'plan-secure-laravel-api-integration' => 'Blog/PlanSecureLaravelApiIntegration',
    'laravel-codebase-handover-checklist' => 'Blog/LaravelCodebaseHandoverChecklist',
    'prepare-before-hiring-react-native-team' => 'Blog/PrepareBeforeHiringReactNativeTeam',
    'react-native-app-development-cost-drivers' => 'Blog/ReactNativeAppDevelopmentCostDrivers',
    'react-native-vs-native-mobile-development' => 'Blog/ReactNativeVsNativeMobileDevelopment',
    'react-native-app-qa-checklist' => 'Blog/ReactNativeAppQaChecklist',
    'react-native-api-integration-guide' => 'Blog/ReactNativeApiIntegrationGuide',
    'custom-crm-vs-off-the-shelf-crm' => 'Blog/CustomCrmVsOffTheShelfCrm',
    'crm-workflow-mapping-before-development' => 'Blog/CrmWorkflowMappingBeforeDevelopment',
    'erp-software-development-where-to-start' => 'Blog/ErpSoftwareDevelopmentWhereToStart',
    'role-based-business-dashboard-development' => 'Blog/RoleBasedBusinessDashboardDevelopment',
    'custom-crm-data-migration-checklist' => 'Blog/CustomCrmDataMigrationChecklist',
    'custom-pos-vs-packaged-pos' => 'Blog/CustomPosVsPackagedPos',
    'multi-location-inventory-system-planning' => 'Blog/MultiLocationInventorySystemPlanning',
    'pos-and-inventory-integrations-guide' => 'Blog/PosAndInventoryIntegrationsGuide',
    'replace-inventory-spreadsheets' => 'Blog/ReplaceInventorySpreadsheets',
    'pos-software-discovery-checklist' => 'Blog/PosSoftwareDiscoveryChecklist',
    'ai-automation-use-cases-business-operations' => 'Blog/AiAutomationUseCasesBusinessOperations',
    'workflow-automation-vs-ai-assistant' => 'Blog/WorkflowAutomationVsAiAssistant',
    'rag-implementation-internal-knowledge-base' => 'Blog/RagImplementationInternalKnowledgeBase',
    'ai-document-processing-workflow' => 'Blog/AiDocumentProcessingWorkflow',
    'add-ai-to-existing-laravel-application' => 'Blog/AddAiToExistingLaravelApplication',
    'custom-software-discovery-workshop-guide' => 'Blog/CustomSoftwareDiscoveryWorkshopGuide',
    'scalable-multi-tenant-saas-architecture' => 'Blog/ScalableMultiTenantSaasArchitecture',
    'api-development-integration-planning' => 'Blog/ApiDevelopmentIntegrationPlanning',
    'reduce-custom-software-project-risk' => 'Blog/ReduceCustomSoftwareProjectRisk',
    'custom-software-launch-roadmap' => 'Blog/CustomSoftwareLaunchRoadmap',
);

Route::get('/blog', function () {
    return Inertia::render('StaticBlogView');
})->name('blog');

Route::get('/blog/{slug}', function (string $slug) use ($staticBlogComponents) {
    abort_unless(isset($staticBlogComponents[$slug]), 404);
    return Inertia::render($staticBlogComponents[$slug], ['slug' => $slug]);
})->where('slug', implode('|', array_keys($staticBlogComponents)))->name('blog-post');

// Standalone secondary pages
Route::get('/technologies', function () {
    return Inertia::render('TechnologiesView', [
        'techCategories' => SiteData::techCategories(),
    ]);
})->name('technologies');

Route::get('/student-projects', function () {
    return Inertia::render('StudentProjectsView', [
        'studentProjects' => SiteData::studentProjects(),
    ]);
})->name('student-projects');

Route::get('/reviews', function () {
    return Inertia::render('ReviewsView', [
        'clientTestimonials' => SiteData::clientTestimonials(),
        'studentTestimonials' => SiteData::studentTestimonials(),
    ]);
})->name('reviews');

Route::get('/resources', function () {
    return Inertia::render('ResourcesView', [
        'resources' => SiteData::resources(),
        'resourceTypes' => SiteData::resourceTypes(),
    ]);
})->name('resources');

Route::get('/faq', function () {
    return Inertia::render('FaqView', [
        'faqGroups' => SiteData::faqGroups(),
        'allFaqs' => SiteData::allFaqs(),
    ]);
})->name('faq');

Route::get('/consultation', function () {
    return Inertia::render('ConsultationView', [
        'services' => SiteData::services(),
    ]);
})->name('consultation');

Route::get('/careers', function () {
    return Inertia::render('CareersView', [
        'values' => SiteData::values(),
    ]);
})->name('careers');

Route::get('/contact', [ContactController::class, 'view'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::fallback(function () {
    return Inertia::render('NotFoundView');
})->name('not-found');
