<?php

namespace App\Console\Commands;

use App\Mail\VaccinationScheduledMail;
use App\Models\CovidRegistration;
use App\Models\VaccineCenter;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ScheduleVaccination extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaccination:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule vaccination for users and send notification emails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();

        $covid_registration = CovidRegistration::with('vaccineCenter')
            ->where('status', 'Not scheduled')
            ->orderBy('created_at', 'asc')
            ->get();

        VaccineCenter::chunk(100, function ($centers) use ($today) {
            foreach ($centers as $center) {

                $covid_registration = CovidRegistration::with('vaccineCenter')
                    ->where('status', 'Not scheduled')
                    ->orderBy('created_at', 'asc')
                    ->get();

                // use for check scheduler
                // $instant_date = Carbon::now();
                $nextAvailableDate = $this->getNextAvailableDate($today);
                $dailyCount = 0;

                foreach ($covid_registration as $registration) {

                    if ($dailyCount < $center->daily_limit) {
                        $registration->update([
                            'vaccine_center_id' => $center->id,
                            'scheduled_date' => $nextAvailableDate->format('Y-m-d H:i:s'),
                            'status' => 'Scheduled',
                        ]);

                        Mail::to($registration->email)
                            ->send(new VaccinationScheduledMail($registration));

                        $dailyCount++;

                    } else {
                        $nextAvailableDate = $this->getNextAvailableDate($nextAvailableDate);
                        $dailyCount = 0;
                    }
                }
            }
        });
    }

    private function getNextAvailableDate($date)
    {
        do {
            $date->addDay();
        } while ($date->isFriday() || $date->isSaturday());

        return $date;
    }
}
