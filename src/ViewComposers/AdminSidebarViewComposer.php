<?php

namespace BitPixel\SpringCms\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use BitPixel\SpringCms\Constants;
use BitPixel\SpringCms\Models\DataType;
use BitPixel\SpringCms\Utility\RolesCache;

class AdminSidebarViewComposer
{

    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param \App\Repositories\UserRepository $users
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $datatypes = $this->getDataTypeMenus();

        $menus[] = [
            'label' => 'Dashboard',
            'route' => 'river.admin.dashboard',
            'icon' => 'feather icon-home'
        ];

        if (count($datatypes)) {
            $menus = array_merge($menus, $datatypes);
        }

        $system_menus = [
            [
                'label' => 'Website',
                'icon' => 'fas fa-tv',
                'is_active' =>
                    request()->routeIs('river.sliders.*') ||
                    request()->routeIs('river.banners.*')||
                    request()->routeIs('river.store.front')||
                    request()->routeIs('river.api.index')||
                    request()->routeIs('river.store-social-links')||
                    request()->routeIs('river.store-email-setting')||
                    request()->routeIs('river.site-backup')||
                    request()->routeIs('river.code-snippets')||
                    request()->routeIs('river.store-global-css')||
                    request()->routeIs('river.store-global-js'),
                'role' => [Constants::ROLE_SITE_ADMIN, Constants::ROLE_WRITER],
                'children' => [
                    [
                        'label' => 'Sliders',
                        'route' => 'river.sliders.index',
                        'is_active' => request()->routeIs('river.sliders.*'),
                    ],
                    [
                        'label' => 'Banners',
                        'route' => 'river.banners.index',
                        'is_active' => request()->routeIs('river.banners.*'),
                    ],
                    [
                        'label' => 'Settings',
                        'route' => 'river.store.front',
                        'is_active' => request()->routeIs('river.store.front'),
                    ],
                    [
                        'label' => 'API',
                        'icon' => 'fa-solid fa-comment-dots',
                        'is_active' => request()->routeIs('river.api.*'),
                        'route' => 'river.api.index'
                    ],
                    // [
                    //     'label' => 'Social Links',
                    //     'route' => 'river.store-social-links',
                    //     'is_active' => request()->routeIs('river.store-social-links'),
                    // ],
                    [
                        'label' => 'Email settings',
                        'route' => 'river.store-email-setting',
                        'is_active' => request()->routeIs('river.store-email-setting'),
                    ],
                    [
                        'label' => "Backup",
                        'route' => 'river.site-backup',
                        'is_active' => request()->routeIs('river.site-backup'),
                    ],
                    [
                        'label' => 'Code snippets',
                        'route' => 'river.code-snippets',
                        'is_active' => request()->routeIs('river.code-snippets'),
                    ],
                    [
                        'label' => 'Global Css',
                        'route' => 'river.store-global-css',
                        'is_active' => request()->routeIs('river.store-global-css'),
                    ],
                    [
                        'label' => 'Global Js',
                        'route' => 'river.store-global-js',
                        'is_active' => request()->routeIs('river.store-global-js'),
                    ]
                ]
            ],
            [
                'label' => 'Template manager',
                'is_active' =>
                    request()->routeIs('river.template-pages.*') ||
                    request()->routeIs('river.template-assets.*'),
                'children' => [
                    /*[
                        'label' => 'Pages',
                        'route' => 'river.templates.pages',
                    ],*/
                    [
                        'label' => 'Pages',
                        'route' => 'river.template-pages.index',
                        'is_active' => request()->routeIs('river.template-pages.*'),
                    ],
                    [
                        'label' => 'Assets',
                        'route' => 'river.template-assets.index',
                        'is_active' => request()->routeIs('river.template-assets.*'),
                    ],

                ]
            ],
            [
                'label' => 'Data Types',
                'icon' => 'fas fa-tv', //feather icon-box
                'is_active' => request()->routeIs('river.datatypes.*'),
                'children' => [
                    [
                        'label' => 'All types',
                        'route' => 'river.datatypes.index',
                        'is_active' => request()->routeIs('river.datatypes.*'),
                    ]
                ]
            ],
            [
                'label' => 'Users',
                'icon' => 'fas fa-user', //feather icon-box
                'is_active' => request()->routeIs('river.users.*'),
                'route' => 'river.users.index',
            ],
            // [
            //     'label' => 'User Role',
            //     'icon' => 'fas fa-user', //feather icon-box
            //     'route' => 'river.users-role.index',
            // ],
            [
                'label' => 'Pages',
                'icon' => 'fas fa-folder',
                'is_active' => request()->routeIs('river.pages.*'),
                'route' => 'river.pages.index',
            ],
            [
                'label' => 'Contact Form',
                'icon' => 'fas fa-file-contract',
                'is_active' => request()->routeIs('river.river.contact-form.*'),
                'route' => 'river.contact-form.index',
            ],
            // [
            //     'label' => 'Visit Site',
            //     'icon' => 'fas fa-eye',
            //     'route' => 'riversite.homepage',
            // ],
            [
                'label' => 'Newsletter Submissions',
                'icon' =>  'fa-solid fa-envelope',
                'is_active' => request()->routeIs('river.newslatter-submissions.*'),
                'route' => 'river.newslatter-submissions.index'
            ],
            [
                'label' => 'Contact Form Submission',
                'icon' =>  'fa-solid fa-envelope',
                'is_active' => request()->routeIs('river.Contact-form.*'),
                'route' => 'river.Contact-form'
            ],
            [
                'label' => 'FAQ',
                'icon' => 'fas fa-comments',
                'is_active' => request()->routeIs('river.faq.*'),
                'route' => 'river.faq.index'
            ],
            [
                'label' => 'Menu',
                'icon' => 'fas fa-bars',
                'is_active' => request()->routeIs('river.menu.*'),
                'route' => 'river.menu.index'
            ],
            [
                'label' => 'Blogs',
                'icon' => 'fas fa-th-large',
                'is_active' =>
                    request()->routeIs('river.blog.*') ||
                    request()->routeIs('river.blog-category.*') ||
                    request()->routeIs('river.tag.*') ||
                    request()->routeIs('river.comments.*'),
                'children' => [
                    [
                        'label' => ' All blogs',
                        'route' => 'river.blog.index',
                        'is_active' => request()->routeIs('river.blog.*'),
                    ],
                    [
                        'label' => 'Categories',
                        'route' => 'river.blog-category.index',
                        'is_active' => request()->routeIs('river.blog-category.*'),

                    ],
                    [
                        'label' => 'Tag',
                        'route' => 'river.tag.index',
                        'is_active' => request()->routeIs('river.tag.*'),
                    ],
                    [
                        'label' => 'Comments',
                        'route' => 'river.comments.index',
                        'is_active' => request()->routeIs('river.comments.*'),
                    ],


                ]
            ],
            [
                'label' => 'Testimonial',
                'icon' => 'fa-solid fa-comment-dots',
                'is_active' => request()->routeIs('river.testimonial.*'),
                'route' => 'river.testimonial.index'
            ],
            [
                'label' => 'Portfolios',
                'icon' => 'fa-solid fa-comment-dots',
                'is_active' => request()->routeIs('river.portfolios.*'),
                'route' => 'river.portfolios.index'
            ],
            // [
            //     'label' => 'API',
            //     'icon' => 'fa-solid fa-comment-dots',
            //     'is_active' => request()->routeIs('river.api.*'),
            //     'route' => 'river.api.index'
            // ],
            [
                'label' => 'Service',
                'icon' => 'fas fa-headset',
                'is_active' =>
                    request()->routeIs('river.service.*') ||
                    request()->routeIs('river.service-category.*'),
                'children' => [
                    [
                        'label' => 'All Services',
                        'route' => 'river.service.index',
                        'is_active' => request()->routeIs('river.service.*'),
                    ],
                    [
                        'label' => 'Service Category',
                        'route' => 'river.service-category.index',
                        'is_active' => request()->routeIs('river.service-category.*'),
                    ]
                ]
            ],
            [
                'label' => 'Configuration',
                'icon' => 'fa-solid fa-comment-dots',
                'is_active' => request()->routeIs('river.configuration'),
                'route' => 'river.configuration'
            ],
            [
                'label' => 'File manager',
                'icon' => 'fa-solid fa-file-lines',
                'is_active' => request()->routeIs('river.file-manager'),
                'route' => 'river.file-manager'
            ],
        ];
        $menus = array_merge($menus, $system_menus);

        /*if (RolesCache::isDeveloper()) {
            $menus = array_merge($menus, $system_menus);
        }*/
        $user = Auth::guard('admins')->user();

        $view->with('menus', $menus)
            ->with('user_role', $user->role_id);
    }

    private function getDataTypeMenus()
    {
        $types = Cache::rememberForever(Constants::CACHE_KEY_DATATYPES, function () {
            return DataType::all();
        });

        $menu = [];
        foreach ($types as $type) {
            if ($type->show_on_menu) {
                $m = [
                    'label' => $type->plural,
                    'children' => [
                        [
                            'label' => 'All ' . $type->plural,
                            'url' => route('river.data-entries.index', $type->slug),
                        ],
                        [
                            'label' => 'Add ' . $type->singular,
                            'url' => route('river.data-entries.create', $type->slug),
                        ]
                    ],
                ];
                if ($type->icon) {
                    $m['icon'] = $type->icon;
                }
                $menu[] = $m;
            }
        }


        return $menu;
    }
}
