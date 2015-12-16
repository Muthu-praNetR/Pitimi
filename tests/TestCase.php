<?php

/**
 * The TestCase class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Setup the test case.
     */
    public function setUp()
    {
        parent::setUp();

        $this->app->make('db')->beginTransaction();

        $this->beforeApplicationDestroyed(function () {
            $this->app->make('db')->rollBack();
        });
    }

    /**
     * Log SQL queries.
     *
     * @param bool $listen Indicates if we want to listen to SQL queries or not.
     */
    protected function logSql($listen)
    {
        if ($listen) {
            Event::listen('illuminate.query', function ($query, $bindings, $time, $name) {
                $data = compact('bindings', 'time', 'name');

                // Format binding data for sql insertion
                foreach ($bindings as $i => $binding) {
                    if ($binding instanceof \DateTime) {
                        $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                    } else {
                        $bindings[$i] = var_export($binding, true);
                    }
                }

                // Insert bindings into query
                $query = str_replace(array('%', '?'), array('%%', '%s'), $query);
                $query = vsprintf($query, $bindings);

                Log::info($query, $data);
            });
        } else {
            Event::forget('illuminate.query');
        }
    }
}
