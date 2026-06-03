<?php

namespace Tests\Feature;

use App\Models\AksiPelestarian;
use App\Models\Ekosistem;
use App\Models\Favorite;
use App\Models\Ikan;
use App\Models\Like;
use App\Models\User;
use App\Models\UserView;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * PBI-14: Data Relation - Database Integrity Testing
 * Owner: Keziah
 */
class DataRelationTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'role' => 'user',
            'points' => 0,
            'badge' => 'Beginner',
        ]);

        $this->admin = User::factory()->create([
            'role' => 'admin',
            'points' => 0,
            'badge' => 'Beginner',
        ]);
    }

    // ===== USER RELATIONS =====

    public function test_basic()
    {
    $this->assertTrue(true);
    }
    
    /** @test */
    public function test_user_has_many_ikan()
    {
        $ikan = Ikan::create([
            'nama' => 'Ikan Nemo',
            'deskripsi' => 'Ikan clownfish terkenal',
            'habitat' => 'Laut tropis',
            'status_konservasi' => 'Least Concern',
            'created_by' => $this->admin->id,
        ]);

        $this->assertCount(1, $this->admin->ikans);
        $this->assertEquals('Ikan Nemo', $this->admin->ikans->first()->nama);
    }

    /** @test */
    public function user_has_many_ekosistem()
    {
        Ekosistem::create([
            'nama_ekosistem' => 'Terumbu Karang',
            'deskripsi' => 'Ekosistem laut yang kaya',
            'lokasi' => 'Raja Ampat',
            'created_by' => $this->admin->id,
        ]);

        $this->assertCount(1, $this->admin->ekosistems);
        $this->assertEquals('Terumbu Karang', $this->admin->ekosistems->first()->nama_ekosistem);
    }

    /** @test */
    public function user_has_many_aksi_pelestarians()
    {
        AksiPelestarian::create([
            'judul_aksi' => 'Bersih Pantai',
            'deskripsi' => 'Membersihkan sampah di pantai',
            'created_by' => $this->user->id,
            'is_user_generated' => true,
        ]);

        $this->assertCount(1, $this->user->aksiPelestarians);
        $this->assertEquals('Bersih Pantai', $this->user->aksiPelestarians->first()->judul_aksi);
    }

    /** @test */
    public function user_has_many_favorites()
    {
        $ikan = Ikan::create([
            'nama' => 'Ikan Dori',
            'created_by' => $this->admin->id,
        ]);

        Favorite::create([
            'user_id' => $this->user->id,
            'type' => 'ikan',
            'item_id' => $ikan->id_ikan,
        ]);

        $this->assertCount(1, $this->user->favorites);
        $this->assertEquals('ikan', $this->user->favorites->first()->type);
    }

    /** @test */
    public function user_has_many_likes()
    {
        $aksi = AksiPelestarian::create([
            'judul_aksi' => 'Tanam Mangrove',
            'created_by' => $this->admin->id,
            'is_user_generated' => false,
        ]);

        Like::create([
            'user_id' => $this->user->id,
            'action_id' => $aksi->id_aksi,
        ]);

        $this->assertCount(1, $this->user->likes);
    }

    // ===== IKAN RELATIONS =====

    /** @test */
    public function ikan_belongs_to_creator()
    {
        $ikan = Ikan::create([
            'nama' => 'Ikan Pari',
            'created_by' => $this->admin->id,
        ]);

        $this->assertEquals($this->admin->id, $ikan->createdBy->id);
        $this->assertEquals($this->admin->name, $ikan->createdBy->name);
    }

    /** @test */
    public function ikan_has_many_favorites()
    {
        $ikan = Ikan::create([
            'nama' => 'Ikan Hiu',
            'created_by' => $this->admin->id,
        ]);

        Favorite::create([
            'user_id' => $this->user->id,
            'type' => 'ikan',
            'item_id' => $ikan->id_ikan,
        ]);

        $this->assertCount(1, $ikan->favorites);
    }

    /** @test */
    public function ikan_is_favorited_by_user()
    {
        $ikan = Ikan::create([
            'nama' => 'Ikan Kerapu',
            'created_by' => $this->admin->id,
        ]);

        $this->assertFalse($ikan->isFavoritedBy($this->user));

        Favorite::create([
            'user_id' => $this->user->id,
            'type' => 'ikan',
            'item_id' => $ikan->id_ikan,
        ]);

        $this->assertTrue($ikan->fresh()->isFavoritedBy($this->user));
    }

    // ===== AKSI PELESTARIAN RELATIONS =====

    /** @test */
    public function aksi_has_many_likes()
    {
        $aksi = AksiPelestarian::create([
            'judul_aksi' => 'Reduce Plastic',
            'created_by' => $this->admin->id,
            'is_user_generated' => false,
        ]);

        Like::create(['user_id' => $this->user->id, 'action_id' => $aksi->id_aksi]);

        $this->assertCount(1, $aksi->likes);
    }

    /** @test */
    public function aksi_is_liked_by_user()
    {
        $aksi = AksiPelestarian::create([
            'judul_aksi' => 'Save The Ocean',
            'created_by' => $this->admin->id,
            'is_user_generated' => false,
        ]);

        $this->assertFalse($aksi->isLikedBy($this->user));

        Like::create(['user_id' => $this->user->id, 'action_id' => $aksi->id_aksi]);

        $this->assertTrue($aksi->fresh()->isLikedBy($this->user));
    }

    // ===== DATABASE INTEGRITY =====

    /** @test */
    public function favorite_unique_constraint_prevents_duplicates()
    {
        $ikan = Ikan::create([
            'nama' => 'Ikan Unik',
            'created_by' => $this->admin->id,
        ]);

        Favorite::create([
            'user_id' => $this->user->id,
            'type' => 'ikan',
            'item_id' => $ikan->id_ikan,
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        // Insert duplikat harus gagal karena UNIQUE constraint
        Favorite::create([
            'user_id' => $this->user->id,
            'type' => 'ikan',
            'item_id' => $ikan->id_ikan,
        ]);
    }

    /** @test */
    public function like_unique_constraint_prevents_duplicates()
    {
        $aksi = AksiPelestarian::create([
            'judul_aksi' => 'No Duplicate Like',
            'created_by' => $this->admin->id,
            'is_user_generated' => false,
        ]);

        Like::create(['user_id' => $this->user->id, 'action_id' => $aksi->id_aksi]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        // Insert duplikat harus gagal
        Like::create(['user_id' => $this->user->id, 'action_id' => $aksi->id_aksi]);
    }

    /** @test */
    public function user_view_unique_constraint_prevents_duplicates()
    {
        UserView::create([
            'user_id' => $this->user->id,
            'content_type' => 'ikan',
            'content_id' => 1,
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        UserView::create([
            'user_id' => $this->user->id,
            'content_type' => 'ikan',
            'content_id' => 1,
        ]);
    }

    /** @test */
    public function favorite_getItem_returns_correct_model()
    {
        $ikan = Ikan::create([
            'nama' => 'Ikan Getitem',
            'created_by' => $this->admin->id,
        ]);

        $favorite = Favorite::create([
            'user_id' => $this->user->id,
            'type' => 'ikan',
            'item_id' => $ikan->id_ikan,
        ]);

        $item = $favorite->getItem();
        $this->assertInstanceOf(Ikan::class, $item);
        $this->assertEquals('Ikan Getitem', $item->nama);
    }

    /** @test */
    public function user_badge_updates_based_on_points()
    {
        $this->assertEquals('Beginner', $this->user->badge);

        $this->user->points = 50;
        $this->user->save();
        $this->user->updateBadge();
        $this->assertEquals('Ocean Explorer', $this->user->fresh()->badge);

        $this->user->points = 100;
        $this->user->save();
        $this->user->updateBadge();
        $this->assertEquals('Sea Guardian', $this->user->fresh()->badge);
    }
}