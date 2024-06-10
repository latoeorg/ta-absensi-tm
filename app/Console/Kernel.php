protected function schedule(Schedule $schedule)
{
    $schedule->command('generate:daily-qr-code')->daily();
}

protected $routeMiddleware = [
    // ...
    'superadmin' => \App\Http\Middleware\Superadmin::class,
];
