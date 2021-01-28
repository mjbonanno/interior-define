<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class CreateUrlTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/dashboard')
                ->waitForText('Url Shortener')
                ->type('@url-input', 'http://www.aol.com')
                ->press('@create-url')
                ->waitForText('Successfully saved')
                ->assertInputValueIsNot('@url-input', 'http://www.aol.com');
        });
    }
}
