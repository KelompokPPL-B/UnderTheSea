<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Ikan;
use App\Models\AksiPelestarian;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FeatureTestsTest extends DuskTestCase
{
    /**
     * Test: Login Flow
     * PBI-01: User Authentication
     */
    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'test@example.com')
                ->type('password', 'password')
                ->press('Log in')
                ->assertPathIs('/dashboard')
                ->assertSee('Dashboard');
        });
    }

    /**
     * Test: Bookmark Flow
     * PBI-02: Bookmark System
     */
    public function test_user_can_bookmark_fish()
    {
        $user = User::factory()->create();
        $fish = Ikan::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $fish) {
            $browser->loginAs($user)
                ->visit("/ikan/{$fish->id_ikan}")
                ->click('.bookmark-btn')
                ->waitForText('Bookmarked')
                ->assertSee('Bookmarked')
                ->visit("/ikan/{$fish->id_ikan}")
                ->assertSee('Bookmarked');
        });
    }

    /**
     * Test: Like Flow
     * PBI-03: Like System
     */
    public function test_user_can_like_action()
    {
        $user = User::factory()->create();
        $action = AksiPelestarian::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $action) {
            $browser->loginAs($user)
                ->visit("/aksi/{$action->id_aksi}")
                ->waitFor('.like-btn')
                ->click('.like-btn')
                ->waitForText('Unlike')
                ->assertSee('Unlike')
                ->assertSee('1 Likes');
        });
    }

    /**
     * Test: Search Flow
     * PBI-07: Search System
     */
    public function test_user_can_search_fish()
    {
        Ikan::factory()->create(['nama' => 'Great White Shark']);
        Ikan::factory()->create(['nama' => 'Clownfish']);

        $this->browse(function (Browser $browser) {
            $browser->visit('/search/ikan?q=shark')
                ->assertSee('Great White Shark')
                ->assertDontSee('Clownfish');
        });
    }

    /**
     * Test: Create Action Flow
     * PBI-14: User Contribution
     */
    public function test_user_can_create_action()
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/aksi/create')
                ->type('judul_aksi', 'Clean Ocean Beaches')
                ->type('deskripsi', 'Community action to clean beaches')
                ->type('manfaat', 'Reduces plastic pollution')
                ->type('cara_melakukan', 'Gather volunteers and supplies')
                ->press('Create')
                ->assertSee('Clean Ocean Beaches')
                ->assertSee($user->name);
        });
    }

    /**
     * Test: Leaderboard Flow
     * PBI-06: Leaderboard
     */
    public function test_leaderboard_shows_top_users()
    {
        $user1 = User::factory()->create(['name' => 'Alice', 'points' => 150, 'badge' => 'Sea Guardian']);
        $user2 = User::factory()->create(['name' => 'Bob', 'points' => 100, 'badge' => 'Ocean Explorer']);
        $user3 = User::factory()->create(['name' => 'Charlie', 'points' => 50, 'badge' => 'Beginner']);

        $this->browse(function (Browser $browser) {
            $browser->visit('/leaderboard')
                ->assertSee('Alice')
                ->assertSee('Bob')
                ->assertSee('Charlie')
                ->assertSee('Sea Guardian')
                ->assertSee('150')
                ->assertSee('100')
                ->assertSee('50');
        });
    }
}
