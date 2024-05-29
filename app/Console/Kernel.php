protected function schedule(Schedule $schedule)
{
    $schedule->command('generate:daily-qr-code')->daily();
}
