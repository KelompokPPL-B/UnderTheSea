<?php

namespace Database\Seeders;

use App\Models\Ikan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IkanSeeder extends Seeder
{
    /**
     * Clear all existing ikan data and seed 5 new ocean fish entries.
     */
    public function run(): void
    {
        // Disable foreign key checks so we can safely truncate related tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Remove all fish-related records from junction tables first
        DB::table('user_views')->where('content_type', 'ikan')->delete();
        DB::table('favorites')->where('type', 'ikan')->delete();

        // Clear all existing ikan rows
        DB::table('ikan')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Use the admin user as the creator
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            $this->command->error('Admin user not found. Please run DatabaseSeeder first.');
            return;
        }

        $fishes = [
            [
                'nama'              => 'Blue Tang',
                'deskripsi'         => 'A vibrant reef fish famous for its striking royal-blue body and yellow tail, found throughout tropical oceans.',
                'habitat'           => 'Coral reefs, Indo-Pacific and Atlantic oceans',
                'karakteristik'     => 'Oval body with a vivid blue coloration, yellow tail, and a sharp spine near the tail used for defence.',
                'status_konservasi' => 'Least Concern',
                'fakta_unik'        => 'Blue Tangs can turn pale or nearly white when stressed, and they use their caudal spine as a scalpel-like weapon against predators.',
                'gambar'            => 'fish/blue_tang.jpg',
                'created_by'        => $admin->id,
            ],
            [
                'nama'              => 'Hammerhead Shark',
                'deskripsi'         => 'One of the most recognizable sharks in the ocean, identified by its distinctive flattened, hammer-shaped head called a cephalofoil.',
                'habitat'           => 'Warm coastal waters and open ocean worldwide',
                'karakteristik'     => 'Wide, flattened cephalofoil head that gives 360° vision; grey-brown back with a white underside; can reach up to 6 metres in length.',
                'status_konservasi' => 'Critically Endangered',
                'fakta_unik'        => 'The hammer-shaped head improves electroreception, helping hammerheads detect hidden stingrays buried under sand with pinpoint accuracy.',
                'gambar'            => 'fish/hammerhead_shark.jpg',
                'created_by'        => $admin->id,
            ],
            [
                'nama'              => 'Lionfish',
                'deskripsi'         => 'A strikingly beautiful but venomous reef fish native to the Indo-Pacific, now considered an invasive species in the Atlantic.',
                'habitat'           => 'Coral reefs and rocky crevices, Indo-Pacific and Atlantic oceans',
                'karakteristik'     => 'Fan-like pectoral fins, dramatic red-and-white zebra striping, and 18 venomous spines along its dorsal, pelvic, and anal fins.',
                'status_konservasi' => 'Least Concern',
                'fakta_unik'        => 'Lionfish have no natural predators outside their native range, and a single lionfish can reduce juvenile reef-fish populations by up to 79% in just five weeks.',
                'gambar'            => 'fish/lionfish.jpg',
                'created_by'        => $admin->id,
            ],
            [
                'nama'              => 'Moray Eel',
                'deskripsi'         => 'A serpentine predator lurking in coral-reef crevices, known for its fearsome double-jaw system and muscular, scaleless body.',
                'habitat'           => 'Rocky reefs and coral crevices in tropical and subtropical seas',
                'karakteristik'     => 'Long, muscular, scaleless body with mottled patterning; a second set of pharyngeal jaws that shoot forward to grip prey.',
                'status_konservasi' => 'Least Concern',
                'fakta_unik'        => 'Moray eels open and close their mouths constantly — not as a threat display, but to pump oxygenated water over their gills to breathe.',
                'gambar'            => 'fish/moray_eel.jpg',
                'created_by'        => $admin->id,
            ],
            [
                'nama'              => 'Bioluminescent Anglerfish',
                'deskripsi'         => 'A deep-sea predator famous for the glowing lure that dangles above its gaping mouth to attract prey in the pitch-black abyss.',
                'habitat'           => 'Deep ocean, 200–2000 metres below the surface',
                'karakteristik'     => 'Globular body with enormous jaws, fang-like teeth, and a bioluminescent esca (lure) that emits a blue-green glow produced by symbiotic bacteria.',
                'status_konservasi' => 'Not Evaluated',
                'fakta_unik'        => 'In many species, the tiny male anglerfish permanently fuses to the female\'s body, sharing her bloodstream and living as a biological parasite for reproduction.',
                'gambar'            => 'fish/anglerfish.jpg',
                'created_by'        => $admin->id,
            ],
        ];

        foreach ($fishes as $fish) {
            Ikan::create($fish);
        }

        $this->command->info('✅  Successfully seeded 5 new ocean fish entries.');
    }
}
