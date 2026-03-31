<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMediaRequest;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class DashboardSocialMediaController extends Controller
{
    public array $icons = [
        ['name' => 'Facebook', 'icon' => 'fa-square-facebook'],
        ['name' => 'x', 'icon' => 'fa-x-twitter'],
        ['name' => 'Youtube', 'icon' => 'fa-youtube'],
        ['name' => 'Whatsapp', 'icon' => 'fa-whatsapp'],
        ['name' => 'Instagram', 'icon' => 'fa-instagram'],
        ['name' => 'Telegram', 'icon' => 'fa-telegram'],
        ['name' => 'TikTok', 'icon' => 'fa-tiktok'],
        ['name' => 'Snapshat', 'icon' => 'fa-snapchat'],
        ['name' => 'LinkedIn', 'icon' => 'fa-linkedin'],
    ];

    public function __construct()
    {
        $this->authorizeResource(SocialMedia::class, 'social_medium');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->input('search');
        $socialMedia = SocialMedia::filter($search)->paginate(10);
        return view(
            'dashboard.social-media.index',
            ['socialMedia' => $socialMedia]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'dashboard.social-media.edit',
            ['icons' => $this->icons]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialMediaRequest $request)
    {
        $data = $request->validated();
        SocialMedia::create($data);
        return redirect()->route('dashboard.social-media.index')
            ->with('status', 'Social media created');
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialMedia $socialMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialMedia $social_medium)
    {
        return view(
            'dashboard.social-media.edit',
            [
                'media' => $social_medium,
                'icons' => $this->icons,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialMediaRequest $request, SocialMedia $social_medium)
    {
        $data = $request->validated();
        $social_medium->fill($data);
        $social_medium->save();
        return redirect()->route('dashboard.social-media.index')
            ->with('status', 'Social media updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialMedia $social_medium)
    {
        $social_medium->delete();
        return redirect()->route('dashboard.social-media.index')
            ->with('status', 'Social media deleted');
    }
}
