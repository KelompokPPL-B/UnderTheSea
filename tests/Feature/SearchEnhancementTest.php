<?php

namespace Tests\Feature;

use App\Models\AksiPelestarian;
use App\Models\Ekosistem;
use App\Models\Ikan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * PBI-15: Search Enhancement Testing
 * Owner: Keziah
 */
class SearchEnhancementTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin']);

        // Seed data untuk testing
        Ikan::create(['nama' => 'Ikan Koi', 'deskripsi' => 'Ikan hias air tawar', 'habitat' => 'Kolam', 'created_by' => $this->admin->id]);
        Ikan::create(['nama' => 'Ikan Nemo', 'deskripsi' => 'Ikan clownfish', 'habitat' => 'Laut tropis', 'created_by' => $this->admin->id]);
        Ikan::create(['nama' => 'Ikan Hiu Putih', 'deskripsi' => 'Predator laut', 'habitat' => 'Laut dalam', 'created_by' => $this->admin->id]);

        Ekosistem::create(['nama_ekosistem' => 'Terumbu Karang', 'deskripsi' => 'Ekosistem laut tropis', 'lokasi' => 'Raja Ampat', 'created_by' => $this->admin->id]);
        Ekosistem::create(['nama_ekosistem' => 'Hutan Mangrove', 'deskripsi' => 'Hutan bakau pesisir', 'lokasi' => 'Kalimantan', 'created_by' => $this->admin->id]);

        AksiPelestarian::create(['judul_aksi' => 'Bersih Pantai', 'deskripsi' => 'Membersihkan sampah pantai', 'created_by' => $this->admin->id, 'is_user_generated' => false]);
        AksiPelestarian::create(['judul_aksi' => 'Tanam Mangrove', 'deskripsi' => 'Penanaman pohon mangrove', 'created_by' => $this->admin->id, 'is_user_generated' => false]);
    }

    // ===== CASE INSENSITIVE =====

    /** @test */
    public function search_is_case_insensitive_lowercase()
    {
        $response = $this->get('/?q=ikan+koi');
        $response->assertStatus(200);
        $response->assertSee('Ikan Koi');
    }

    /** @test */
    public function search_is_case_insensitive_uppercase()
    {
        $response = $this->get('/?q=IKAN+KOI');
        $response->assertStatus(200);
        $response->assertSee('Ikan Koi');
    }

    /** @test */
    public function search_is_case_insensitive_mixed()
    {
        $response = $this->get('/?q=IkAn+KoI');
        $response->assertStatus(200);
        $response->assertSee('Ikan Koi');
    }

    // ===== MULTI-KEYWORD =====

    /** @test */
    public function search_finds_result_with_partial_keyword()
    {
        $response = $this->get('/?q=koi');
        $response->assertStatus(200);
        $response->assertSee('Ikan Koi');
    }

    /** @test */
    public function search_finds_result_with_multi_keyword()
    {
        // "hiu putih" harus ketemu "Ikan Hiu Putih"
        $response = $this->get('/?q=hiu+putih');
        $response->assertStatus(200);
        $response->assertSee('Ikan Hiu Putih');
    }

    /** @test */
    public function search_finds_result_by_habitat()
    {
        // Cari by habitat, bukan nama
        $response = $this->get('/?q=laut+tropis');
        $response->assertStatus(200);
        $response->assertSee('Ikan Nemo');
    }

    /** @test */
    public function search_finds_ekosistem_by_lokasi()
    {
        $response = $this->get('/?q=raja+ampat');
        $response->assertStatus(200);
        $response->assertSee('Terumbu Karang');
    }

    /** @test */
    public function search_finds_aksi_by_deskripsi()
    {
        $response = $this->get('/?q=sampah+pantai');
        $response->assertStatus(200);
        $response->assertSee('Bersih Pantai');
    }

    // ===== EMPTY INPUT HANDLING =====

    /** @test */
    public function empty_search_does_not_trigger_search()
    {
        $response = $this->get('/?q=');
        $response->assertStatus(200);
        // Harus tampil konten normal (Recommended Content), bukan hasil search
        $response->assertSee('Recommended Content');
        $response->assertDontSee('hasil untuk');
    }

    /** @test */
    public function whitespace_only_search_does_not_trigger_search()
    {
        $response = $this->get('/?q=   ');
        $response->assertStatus(200);
        $response->assertSee('Recommended Content');
        $response->assertDontSee('hasil untuk');
    }

    /** @test */
    public function no_query_param_shows_normal_homepage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Recommended Content');
    }

    // ===== NOT FOUND HANDLING =====

    /** @test */
    public function search_shows_not_found_message_when_no_results()
    {
        $response = $this->get('/?q=xyzabcnotexist123');
        $response->assertStatus(200);
        $response->assertSee('Hasil tidak ditemukan');
        $response->assertSee('Tidak ada data untuk');
    }

    /** @test */
    public function not_found_shows_total_zero()
    {
        $response = $this->get('/?q=xyzabcnotexist123');
        $response->assertStatus(200);
        $response->assertSee('0');
    }

    // ===== WHITESPACE NORMALIZATION =====

    /** @test */
    public function search_normalizes_extra_whitespace()
    {
        // "ikan   koi" dengan spasi berlebih harus tetap ketemu
        $response = $this->get('/?q=ikan+++koi');
        $response->assertStatus(200);
        $response->assertSee('Ikan Koi');
    }
}