<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $menuToggle = $request->cookie('menu');
        $request->attributes->add(['menuToggle' => $menuToggle]);

        if (!is_null(Auth::user())) {
            if (Auth::user()->role != User::AUTHOR_ROLE) {
                \Menu::make('menu', function ($menu) {
                    $menu->raw(view('sidebar-toggler'), ['class' => 'sidebar-toggler-wrapper hide']);
                    $menu->raw(view('sidebar-search'), ['class' => 'sidebar-search-wrapper']);

                    $menu->add('Dashboard', ['route' => 'home', 'class' => 'nav-item start'])
                        ->prepend('<i class="icon-home"></i><span class="title">')
                        ->append('</span>')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add('Link Analysis', ['route' => 'hrefs.index', 'class' => 'nav-item'])
                        ->prepend('<i class="fa fa-globe"></i><span class="title">')
                        ->append('</span>')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add('Articles', ['route' => 'articles.index', 'class' => 'nav-item'])
                        ->prepend('<i class="fa fa-file-text-o"></i><span class="title">')
                        ->append('</span>')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add('Profiles', ['route' => 'profiles.index', 'class' => 'nav-item'])
                        ->prepend('<i class="fa fa-sitemap"></i><span class="title">')
                        ->append('</span>')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add('Projects', ['route' => 'projects.index', 'class' => 'nav-item'])
                        ->prepend('<i class="fa fa-gears"></i><span class="title">')
                        ->append('</span>')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add('Proxy', ['route' => 'proxies.index', 'class' => 'nav-item'])
                        ->prepend('<i class="fa fa-code-fork"></i><span class="title">')
                        ->append('</span>')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add('Mail Accounts', ['route' => 'mail-accounts.index', 'class' => 'nav-item'])
                        ->prepend('<i class="fa fa-envelope-o"></i><span class="title">')
                        ->append('</span>')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add('Images', ['route' => 'images.index', 'class' => 'nav-item'])
                        ->prepend('<i class="fa fa-file-image-o"></i><span class="title">')
                        ->append('</span>')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add('Videos', ['route' => 'videos.index', 'class' => 'nav-item'])
                        ->prepend('<i class="fa fa-file-video-o"></i><span class="title">')
                        ->append('</span>')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add('Posts', ['route' => 'posts.index', 'class' => 'nav-item'])
                        ->prepend('<i class="fa fa-file-powerpoint-o"></i><span class="title">')
                        ->append('</span>')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add('Groups', ['route' => 'groups.index', 'class' => 'nav-item'])
                        ->prepend('<i class="fa fa-database"></i><span class="title">')
                        ->append('</span>')
                        ->link->attr(['class' => 'nav-link']);

                    if (Auth::user()->role == User::ADMIN_ROLE) {
                        $menu->add('Users', ['route' => 'users.index', 'class' => 'nav-item'])
                            ->prepend('<i class="icon-user"></i><span class="title">')
                            ->append('</span>')
                            ->link->attr(['class' => 'nav-link']);
                    }
                });
            } else {
                \Menu::make('menu', function ($menu) {
                    $menu->raw(view('sidebar-toggler'), ['class' => 'sidebar-toggler-wrapper hide']);

                    $menu->add('Dashboard', ['route' => 'home', 'class' => 'nav-item start'])
                        ->prepend('<i class="icon-home"></i><span class="title">')
                        ->append('</span>')
                        ->link->attr(['class' => 'nav-link']);

                    $menu->add('Articles', ['route' => 'tasks.index', 'class' => 'nav-item'])
                        ->prepend('<i class="fa fa-file-text-o"></i><span class="title">')
                        ->append('</span>')
                        ->link->attr(['class' => 'nav-link']);
                });
            }
        }

        return $next($request);
    }
}
