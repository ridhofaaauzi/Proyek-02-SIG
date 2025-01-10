<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        $city = City::where('name', 'Depok')->first();
        $city_name = $city->name;

        $team_members = [
            [
                'name' => 'Irsal Fathi Farhat',
                'role' => 'Full Stack Developer',
                'description' => 'Bertanggung jawab atas pengembangan sistem.',
                'photo' => 'images/team-irsal.jpg',
            ],
            [
                'name' => 'Ridho Fauzi Grafika',
                'role' => 'Backend Developer',
                'description' => 'Mengembangkan sistem backend.',
                'photo' => 'images/team-ridho.jpg',
            ],
            [
                'name' => 'Dandi Rasyid',
                'role' => 'Documentation & Presentation Specialist',
                'description' => 'Menulis laporan dan merancang presentasi.',
                'photo' => 'images/team-dandi.jpg',
            ],
            [
                'name' => 'Addina Khairinisa',
                'role' => 'Documentation & Presentation Specialist',
                'description' => 'Menulis laporan dan merancang presentasi.',
                'photo' => 'images/team-addina.jpg',
            ],
        ];

        return view('pages.team', compact('city_name', 'team_members'));
    }
}
