protected $routeMiddleware = [
// Other middleware registrations...
'superadmin' => \App\Http\Middleware\Superadmin::class,
'redirect_if_not_authenticated' => \App\Http\Middleware\RedirectIfNotAuthenticated::class,
];
