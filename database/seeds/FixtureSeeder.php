<?php

use App\Circuit;
use App\Congregation;
use App\Locale;
use App\PreparedTalk;
use App\ScheduledTalk;
use App\Speaker;
use App\Talk;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * The FixtureSeeder class.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class FixtureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = User::where('email', 'admin')->first();

        // Create some circuits.
        $circuits = factory(Circuit::class, 5)->make();
        foreach ($circuits as $index => $circuit) {
            $circuit->number = $index + 1;
            $circuit->createdBy->associate($admin);
            $circuit->updatedBy->associate($admin);
            $circuit->save();

            // Create some congregations.
            $congregations = factory(Congregation::class, 20)->make();
            foreach ($congregations as $congregation) {
                $congregation->circuit()->associate($circuit);
                $congregation->createdBy()->associate($admin);
                $congregation->updatedBy()->associate($admin);
                $congregation->save();

                // Create a regular user.
                $user = factory(User::class)->make();
                $user->password = Hash::make('password');
                $user->circuit()->associate($circuit);
                $user->congregation()->associate($congregation);
                $user->locale()->associate(Locale::first());
                $user->createdBy()->associate($admin);
                $user->updatedBy()->associate($admin);
                $user->save();

                $user->congregations()->attach($congregation);

                $speakers = factory(Speaker::class, rand(2, 5))->make();
                foreach ($speakers as $speaker) {
                    $speaker->circuit()->associate($circuit);
                    $speaker->congregation()->associate($congregation);
                    $speaker->createdBy()->associate($admin);
                    $speaker->updatedBy()->associate($admin);
                    $speaker->save();

                    $talks = Talk::orderByRaw('RAND()')->take(rand(1, 10))->get();
                    foreach ($talks as $talk) {
                        $prepared_talk = new PreparedTalk();
                        $prepared_talk->circuit()->associate($circuit);
                        $prepared_talk->congregation()->associate($congregation);
                        $prepared_talk->talk()->associate($talk);
                        $prepared_talk->createdBy()->associate($admin);
                        $prepared_talk->updatedBy()->associate($admin);
                        $speaker->preparedTalks()->save($prepared_talk);
                    }
                }
            }

            $congregations = Congregation::all();
            foreach ($congregations as $congregation) {
                $prepared_talks = PreparedTalk::orderByRaw('RAND()')->take(rand(1, 4))->get();

                $date = Carbon::now();
                $date->next($congregation->public_meeting_at->dayOfWeek);
                foreach ($prepared_talks as $prepared_talk) {
                    $scheduled_talk = new ScheduledTalk();
                    $scheduled_talk->circuit()->associate($circuit);
                    $scheduled_talk->congregation()->associate($congregation);
                    $scheduled_talk->preparedTalk()->associate($prepared_talk);
                    $scheduled_talk->scheduled_at = $date;
                    $scheduled_talk->createdBy()->associate($admin);
                    $scheduled_talk->updatedBy()->associate($admin);
                    $congregation->scheduledTalks()->save($scheduled_talk);
                    $date->addWeek();
                }
            }
        }

    }
}
