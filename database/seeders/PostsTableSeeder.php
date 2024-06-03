<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        // Pastikan Anda memiliki setidaknya satu pengguna
        $user = User::first();

        if ($user) {
            // Contoh data untuk tipe 'news'
            Post::create([
                'user_id' => $user->id,
                'text' => 'This is a dummy news post.',
                'type' => 'news',
                'found' => false
            ]);

            Post::create([
                'user_id' => $user->id,
                'text' => 'This is a dummy news post BAWAHAHWAHWAH.',
            ]);

            // Contoh data untuk tipe 'event'
            Post::create([
                'user_id' => $user->id,
                'text' => 'This is a dummy event post.',
                'type' => 'event',
                'isOn_start' => Carbon::now(),
                'isOn_end' => Carbon::now()->addDays(1),
            ]);
        } else {
            $this->command->info('Please make sure you have at least one user in the users table.');
        }
    }
}
