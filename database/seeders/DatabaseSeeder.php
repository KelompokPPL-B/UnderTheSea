<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ikan;
use App\Models\Ekosistem;
use App\Models\AksiPelestarian;
use App\Models\Like;
use App\Models\Favorite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $admin = User::updateOrCreate([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('mypassword'),
            'role' => 'admin',
            'points' => 100,
            'badge' => 'Sea Guardian',
        ]);

        $users = User::factory()->count(8)->create();
        $users->each(function ($user) {
            $points = rand(0, 100);
            $user->update([
                'points' => $points,
                'badge' => $this->getBadge($points),
            ]);
        });

        $ikans = collect([
            ['nama' => 'Great White Shark', 'deskripsi' => 'Apex predator of the ocean', 'habitat' => 'Open ocean', 'karakteristik' => 'Large, powerful swimmer', 'status_konservasi' => 'Vulnerable', 'fakta_unik' => 'Can detect a single drop of blood', 'gambar' => 'fish/shark.jpg', 'created_by' => $admin->id],
            ['nama' => 'Clownfish', 'deskripsi' => 'Small colorful fish', 'habitat' => 'Coral reef', 'karakteristik' => 'Orange with white stripes', 'status_konservasi' => 'Least Concern', 'fakta_unik' => 'Lives in symbiosis with sea anemones', 'gambar' => 'fish/clownfish.jpg', 'created_by' => $admin->id],
            ['nama' => 'Sea Turtle', 'deskripsi' => 'Ancient ocean reptile', 'habitat' => 'Ocean and beaches', 'karakteristik' => 'Hard shell, flippers', 'status_konservasi' => 'Endangered', 'fakta_unik' => 'Can live over 100 years', 'gambar' => 'fish/turtle.jpg', 'created_by' => $admin->id],
            ['nama' => 'Dolphin', 'deskripsi' => 'Intelligent marine mammal', 'habitat' => 'Oceans and some rivers', 'karakteristik' => 'Highly intelligent and social', 'status_konservasi' => 'Least Concern', 'fakta_unik' => 'Use echolocation to navigate', 'gambar' => 'fish/dolphin.jpg', 'created_by' => $admin->id],
            ['nama' => 'Manta Ray', 'deskripsi' => 'Gentle giant of the sea', 'habitat' => 'Tropical and subtropical waters', 'karakteristik' => 'Large wingspan, filter feeder', 'status_konservasi' => 'Vulnerable', 'fakta_unik' => 'Can jump up to 5 meters high', 'gambar' => 'fish/manta.jpg', 'created_by' => $admin->id],
            ['nama' => 'Seahorse', 'deskripsi' => 'Unique horse-like fish', 'habitat' => 'Seagrass beds', 'karakteristik' => 'Prehensile tail', 'status_konservasi' => 'Vulnerable', 'fakta_unik' => 'Male carries eggs and gives birth', 'gambar' => 'fish/seahorse.jpg', 'created_by' => $admin->id],
            ['nama' => 'Octopus', 'deskripsi' => 'Highly intelligent cephalopod', 'habitat' => 'Rocky reefs and caves', 'karakteristik' => 'Eight arms with suction cups', 'status_konservasi' => 'Least Concern', 'fakta_unik' => 'Can change color in milliseconds', 'gambar' => 'fish/octopus.jpg', 'created_by' => $admin->id],
            ['nama' => 'Jellyfish', 'deskripsi' => 'Ancient gelatinous creature', 'habitat' => 'Oceans worldwide', 'karakteristik' => 'Translucent body with tentacles', 'status_konservasi' => 'Not Evaluated', 'fakta_unik' => 'Has existed for 500 million years', 'gambar' => 'fish/jellyfish.jpg', 'created_by' => $admin->id],
            ['nama' => 'Blue Whale', 'deskripsi' => 'Largest animal ever', 'habitat' => 'All oceans', 'karakteristik' => 'Massive size, filter feeder', 'status_konservasi' => 'Endangered', 'fakta_unik' => 'Heart weighs as much as a car', 'gambar' => 'fish/whale.jpg', 'created_by' => $admin->id],
            ['nama' => 'Starfish', 'deskripsi' => 'Radial symmetry sea creature', 'habitat' => 'Ocean floor', 'karakteristik' => 'Five or more arms', 'status_konservasi' => 'Varies by species', 'fakta_unik' => 'Can regenerate lost arms', 'gambar' => 'fish/starfish.jpg', 'created_by' => $admin->id],
        ])->map(fn($data) => Ikan::create($data));

        $ekosistems = collect([
            ['nama_ekosistem' => 'Coral Reef', 'deskripsi' => 'Underwater ecosystem formed by corals', 'lokasi' => 'Tropical and subtropical waters', 'peran' => 'Home to thousands of species', 'ancaman' => 'Climate change, pollution, overfishing', 'gambar' => 'ecosystem/coral.jpg', 'created_by' => $admin->id],
            ['nama_ekosistem' => 'Kelp Forest', 'deskripsi' => 'Dense growth of kelp seaweed', 'lokasi' => 'Temperate coastal waters', 'peran' => 'Nursery for fish and marine life', 'ancaman' => 'Sea urchin overpopulation, warming waters', 'gambar' => 'ecosystem/kelp.jpg', 'created_by' => $admin->id],
            ['nama_ekosistem' => 'Mangrove Swamp', 'deskripsi' => 'Coastal forest with salt-tolerant trees', 'lokasi' => 'Tropical and subtropical coasts', 'peran' => 'Breeding ground for fish and crustaceans', 'ancaman' => 'Coastal development, aquaculture', 'gambar' => 'ecosystem/mangrove.jpg', 'created_by' => $admin->id],
            ['nama_ekosistem' => 'Seagrass Meadow', 'deskripsi' => 'Underwater flowering plants', 'lokasi' => 'Shallow coastal waters', 'peran' => 'Food source and habitat', 'ancaman' => 'Coastal pollution, boat damage', 'gambar' => 'ecosystem/seagrass.jpg', 'created_by' => $admin->id],
            ['nama_ekosistem' => 'Deep Sea Vent', 'deskripsi' => 'Hydrothermal vents on ocean floor', 'lokasi' => 'Deep ocean trenches', 'peran' => 'Unique ecosystem independent of sunlight', 'ancaman' => 'Mining activities, environmental change', 'gambar' => 'ecosystem/vent.jpg', 'created_by' => $admin->id],
            ['nama_ekosistem' => 'Open Ocean', 'deskripsi' => 'Pelagic zone far from shore', 'lokasi' => 'All oceans', 'peran' => 'Migratory route for whales and fish', 'ancaman' => 'Overfishing, plastic pollution', 'gambar' => 'ecosystem/open_ocean.jpg', 'created_by' => $admin->id],
            ['nama_ekosistem' => 'Estuary', 'deskripsi' => 'Where river meets ocean', 'lokasi' => 'Coastal areas worldwide', 'peran' => 'Nursery ground for many fish species', 'ancaman' => 'Water pollution, dam construction', 'gambar' => 'ecosystem/estuary.jpg', 'created_by' => $admin->id],
        ])->map(fn($data) => Ekosistem::create($data));

        $aksis = collect([
            ['judul_aksi' => 'Beach Cleanup Drive', 'deskripsi' => 'Community effort to clean beaches', 'manfaat' => 'Removes plastic and waste harming marine life', 'cara_melakukan' => 'Gather volunteers, collect trash, proper disposal', 'gambar' => 'action/beach_cleanup.jpg', 'created_by' => $admin->id, 'is_user_generated' => false],
            ['judul_aksi' => 'Coral Restoration', 'deskripsi' => 'Replanting and nurturing coral reefs', 'manfaat' => 'Restores habitat for marine species', 'cara_melakukan' => 'Collect coral fragments, nurture in nursery, transplant', 'gambar' => 'action/coral_restoration.jpg', 'created_by' => $users[0]->id, 'is_user_generated' => true],
            ['judul_aksi' => 'Ocean Plastic Awareness', 'deskripsi' => 'Educational campaign about ocean plastic', 'manfaat' => 'Raises awareness and changes behavior', 'cara_melakukan' => 'Create posters, videos, social media content', 'gambar' => 'action/awareness.jpg', 'created_by' => $users[1]->id, 'is_user_generated' => true],
            ['judul_aksi' => 'Marine Protected Area Advocacy', 'deskripsi' => 'Support designation of protected marine areas', 'manfaat' => 'Protects species from overfishing', 'cara_melakukan' => 'Petition, community meetings, policy advocacy', 'gambar' => 'action/protection.jpg', 'created_by' => $admin->id, 'is_user_generated' => false],
            ['judul_aksi' => 'Sustainable Fishing Practices', 'deskripsi' => 'Promote sustainable fishing methods', 'manfaat' => 'Maintains fish populations for future', 'cara_melakukan' => 'Work with fishing communities, training programs', 'gambar' => 'action/fishing.jpg', 'created_by' => $users[2]->id, 'is_user_generated' => true],
            ['judul_aksi' => 'Turtle Rescue Program', 'deskripsi' => 'Rescue and rehabilitation of injured turtles', 'manfaat' => 'Saves endangered sea turtle populations', 'cara_melakukan' => 'Rescue operations, veterinary care, release', 'gambar' => 'action/turtle_rescue.jpg', 'created_by' => $users[3]->id, 'is_user_generated' => true],
            ['judul_aksi' => 'Reduce Plastic Consumption', 'deskripsi' => 'Personal challenge to reduce single-use plastic', 'manfaat' => 'Decreases plastic waste in oceans', 'cara_melakukan' => 'Use reusable bags, bottles, avoid plastic packaging', 'gambar' => 'action/reduce_plastic.jpg', 'created_by' => $users[4]->id, 'is_user_generated' => true],
            ['judul_aksi' => 'Ocean Education Programs', 'deskripsi' => 'Educational workshops about ocean conservation', 'manfaat' => 'Builds next generation of ocean advocates', 'cara_melakukan' => 'School visits, workshops, interactive learning', 'gambar' => 'action/education.jpg', 'created_by' => $admin->id, 'is_user_generated' => false],
            ['judul_aksi' => 'Pollution Monitoring', 'deskripsi' => 'Monitor and report water pollution', 'manfaat' => 'Identifies pollution sources for cleanup', 'cara_melakukan' => 'Regular water testing, data collection, reporting', 'gambar' => 'action/monitoring.jpg', 'created_by' => $users[5]->id, 'is_user_generated' => true],
            ['judul_aksi' => 'Mangrove Planting', 'deskripsi' => 'Restore mangrove forests', 'manfaat' => 'Provides fish breeding grounds', 'cara_melakukan' => 'Plant mangrove seedlings, maintain until mature', 'gambar' => 'action/mangrove.jpg', 'created_by' => $users[6]->id, 'is_user_generated' => true],
            ['judul_aksi' => 'Whale Watching Conservation', 'deskripsi' => 'Promote responsible whale watching', 'manfaat' => 'Protects whales from stress and harm', 'cara_melakukan' => 'Guide boats at proper distances, education', 'gambar' => 'action/whale_watching.jpg', 'created_by' => $users[7]->id, 'is_user_generated' => true],
        ])->map(fn($data) => AksiPelestarian::create($data));

        $allUsers = $users->push($admin);

        foreach ($ikans as $ikan) {
            $randomUsers = $allUsers->random(rand(2, 5));
            foreach ($randomUsers as $user) {
                DB::table('user_views')->insert([
                    'user_id' => $user->id,
                    'content_type' => 'ikan',
                    'content_id' => $ikan->id_ikan,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        foreach ($ekosistems as $ekosistem) {
            $randomUsers = $allUsers->random(rand(1, 4));
            foreach ($randomUsers as $user) {
                DB::table('user_views')->insert([
                    'user_id' => $user->id,
                    'content_type' => 'ekosistem',
                    'content_id' => $ekosistem->id_ekosistem,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        foreach ($aksis as $aksi) {
            $randomUsers = $allUsers->random(rand(1, 5));
            foreach ($randomUsers as $user) {
                DB::table('user_views')->insert([
                    'user_id' => $user->id,
                    'content_type' => 'aksi',
                    'content_id' => $aksi->id_aksi,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        foreach ($users as $user) {
            $randomIkans = $ikans->random(rand(1, 3));
            foreach ($randomIkans as $ikan) {
                Favorite::create([
                    'user_id' => $user->id,
                    'type' => 'ikan',
                    'item_id' => $ikan->id_ikan,
                ]);
            }

            $randomEkosistems = $ekosistems->random(rand(1, 2));
            foreach ($randomEkosistems as $ekosistem) {
                Favorite::create([
                    'user_id' => $user->id,
                    'type' => 'ekosistem',
                    'item_id' => $ekosistem->id_ekosistem,
                ]);
            }

            $randomAksis = $aksis->random(rand(2, 4));
            foreach ($randomAksis as $aksi) {
                Favorite::create([
                    'user_id' => $user->id,
                    'type' => 'aksi',
                    'item_id' => $aksi->id_aksi,
                ]);
            }
        }

        foreach ($users as $user) {
            $randomAksis = $aksis->random(rand(2, 5));
            foreach ($randomAksis as $aksi) {
                Like::create([
                    'user_id' => $user->id,
                    'action_id' => $aksi->id_aksi,
                ]);
            }
        }
    }

    private function getBadge(int $points): string
    {
        if ($points >= 100) {
            return 'Sea Guardian';
        } elseif ($points >= 50) {
            return 'Ocean Explorer';
        }
        return 'Beginner';
    }
}
