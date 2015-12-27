<?php

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
        $congregations = factory(Congregation::class, 15)->make();

        foreach ($congregations as $congregation) {
            $congregation->created_by = $admin->id;
            $congregation->updated_by = $admin->id;
            $congregation->save();

            $user = factory(User::class)->make();
            $user->password = Hash::make('password');
            $user->locale()->associate(Locale::first());
            $user->save();

            $user->congregations()->attach($congregation);

            $speakers = factory(Speaker::class, rand(2, 5))->make();
            foreach ($speakers as $speaker) {
                $speaker->congregation()->associate($congregation);
                $speaker->created_by = $admin->id;
                $speaker->updated_by = $admin->id;
                $speaker->save();

                $talks = Talk::orderByRaw('RAND()')->take(rand(1, 10))->get();
                foreach ($talks as $talk) {
                    $prepared_talk = new PreparedTalk();
                    $prepared_talk->talk()->associate($talk);
                    $prepared_talk->createdBy()->associate($admin);
                    $prepared_talk->updatedBy()->associate($admin);
                    $speaker->preparedTalks()->save($prepared_talk);
                }
            }
        }

        $congregations = Congregation::all();
        foreach ($congregations as $congregation) {
            $prepared_talks = PreparedTalk::whereHas('speaker', function ($query) use ($congregation) {
                $query->where('congregation_id', '<>', $congregation->id);
            })->orderByRaw('RAND()')->take(rand(1, 4))->get();

            $date = Carbon::now();
            $date->next($congregation->public_meeting_at->dayOfWeek);
            foreach ($prepared_talks as $prepared_talk) {
                $scheduled_talk = new ScheduledTalk();
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
