namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\QrCode;
use Carbon\Carbon;

class GenerateDailyQrCode extends Command
{
    protected $signature = 'generate:daily-qr-code';
    protected $description = 'Generate a daily QR code for attendance';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $date = Carbon::now()->toDateString();
        $code = uniqid(); // Generate a unique code

        QrCode::updateOrCreate(
            ['date' => $date],
            ['code' => $code]
        );

        $this->info('Daily QR code generated successfully.');
    }
}
