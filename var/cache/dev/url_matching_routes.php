<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/projects' => [[['_route' => 'app_manage_projects', '_controller' => 'App\\Controller\\ProjectsController::index'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\RegistrationController::register'], null, null, null, false, false, null]],
        '/verify/email' => [[['_route' => 'app_verify_email', '_controller' => 'App\\Controller\\RegistrationController::verifyUserEmail'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
        '/main' => [[['_route' => 'app_main', '_controller' => 'App\\Controller\\SecurityController::main'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/projects/(?'
                    .'|edit/(?'
                        .'|([^/]++)(*:198)'
                        .'|critery/([^/]++)(*:222)'
                        .'|variant(?'
                            .'|/([^/]++)(*:249)'
                            .'|s_values/([^/]++)(*:274)'
                        .')'
                        .'|klas/([^/]++)(*:296)'
                        .'|profils_values/([^/]++)(*:327)'
                        .'|threshold_values/([^/]++)(*:360)'
                    .')'
                    .'|raport/(?'
                        .'|([^/]++)(*:387)'
                        .'|pdf/([^/]++)(*:407)'
                    .')'
                    .'|delete/([^/]++)(*:431)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        198 => [[['_route' => 'app_edit_project', '_controller' => 'App\\Controller\\ProjectsController::editProject'], ['slug'], null, null, false, true, null]],
        222 => [[['_route' => 'app_edit_critery_project', '_controller' => 'App\\Controller\\ProjectsController::editCritery'], ['slug'], null, null, false, true, null]],
        249 => [[['_route' => 'app_edit_variant_project', '_controller' => 'App\\Controller\\ProjectsController::editVariant'], ['slug'], null, null, false, true, null]],
        274 => [[['_route' => 'app_edit_variants_values_project', '_controller' => 'App\\Controller\\ProjectsController::editVariantValue'], ['slug'], null, null, false, true, null]],
        296 => [[['_route' => 'app_edit_klas_project', '_controller' => 'App\\Controller\\ProjectsController::editKlas'], ['slug'], null, null, false, true, null]],
        327 => [[['_route' => 'app_edit_profils_values_project', '_controller' => 'App\\Controller\\ProjectsController::editProfilValue'], ['slug'], null, null, false, true, null]],
        360 => [[['_route' => 'app_edit_threshold_values_project', '_controller' => 'App\\Controller\\ProjectsController::editThresholdValue'], ['slug'], null, null, false, true, null]],
        387 => [[['_route' => 'app_raport_project', '_controller' => 'App\\Controller\\ProjectsController::raportProject'], ['slug'], null, null, false, true, null]],
        407 => [[['_route' => 'app_raport_pdf_project', '_controller' => 'App\\Controller\\ProjectsController::raportPDFProject'], ['slug'], null, null, false, true, null]],
        431 => [
            [['_route' => 'app_delete_project', '_controller' => 'App\\Controller\\ProjectsController::deleteProject'], ['slug'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
