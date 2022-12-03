<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */

    public function testPayment() {
        $this->browse(function (Browser $browser) {
            $url = 'http://store1.laratenancy.test/';
            $browser->visit($url)
                ->assertPathIs(parse_url($url, PHP_URL_PATH))
                ->screenshot('filename')
                ->assertSee('Loja Legal')
                ->click()
        });
    }
}
