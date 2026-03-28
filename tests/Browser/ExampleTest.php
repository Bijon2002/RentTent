<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /** @test */
    public function basic_example(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') // open homepage
                    ->assertSee('Premium Camping')    // check heading exists
                    ->assertSee('Gourmet Food')       // check second section
                    ->assertSee('Comfortable Properties') // another heading
                    ->assertSee('Your Space, Your Peace') // another section
                    ->screenshot('homepage_loaded');  // screenshot saved automatically
        });
    }
}
