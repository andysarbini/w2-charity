<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('name')->get()->pluck('name', 'id');

        return view('campaign.index', compact('category'));
    }

    public function data(Request $request)
    {
        $query = Campaign::when(auth()->user()->hasRole('donatur'), function ($query) {
            $query->donatur();
        })
                ->when($request->has('status') && $request->status !="", function ($query) use ($request) {
                    $query->where('status', $request->status);
                })
                ->when(
                    $request->has('start_date') &&
                    $request->start_date != "" &&
                    $request->has('end_date') &&
                    $request->end_date != "",
                    function ($query) use ($request) {
                        $query->whereBetween('publish_date', $request->only('start_date', 'end_date'));
                    }
                )
                ->orderBy('publish_date', 'desc');

        return datatables($query)
                ->addIndexColumn()
                ->editColumn('short_description', function($query) {
                    return $query->title .'<br><small>'. $query->short_description .'</small>';
                })
                ->editColumn('path_image', function($query) {
                    return '<img src="'. Storage::disk('public')->url($query->path_image) .'" class="img-thumbnail">';                  
                })
                ->editColumn('status', function ($query) {
                    return '<span class="badge badge-'. $query->statusColor() .'">'. $query->status .'</span>';
                })
                ->addColumn('author', function ($query) {
                    return $query->user->name;
                })
                ->addColumn('actions', function ($query) {
                    $text =  '
                        <a href="'. route('campaigns.show', $query->id) .'" class="btn btn-link text-dark"><i class="fas fa-search-plus"></i></a>                   
                    ';

                    if (auth()->user()->hasRole('donatur')) {
                        $text .='
                        <a href="'. route('campaigns.edit', $query->id) .'" class="btn btn-link text-primary"><i class="fas fa-pencil-alt"></i></a>
                        ';
                    } else {
                        $text .='
                            <button onclick="editForm(`'. route('campaigns.show', $query->id) .'`)" class="btn btn-link text-primary"><i class="fas fa-pencil-alt"></i></button>
                            ';
                    }

                    $text .= '
                    <button class="btn btn-link text-danger" onclick="deleteData(`'. route('campaigns.destroy', $query->id) .'`)"><i class="fas fa-trash"></i></button>';
                
                    return $text;
                })
                ->rawColumns(['short_description', 'path_image', 'status', 'action'])
                ->escapeColumns([])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('name')->get()->pluck('name', 'id');
        return view('front.campaign.index', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:8',
            'categories' => 'required|array',
            'short_description' => 'required',
            'body' => 'required|min:8',
            'publish_date' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:Publish, Archived',
            'goal' => 'required|integer|min:100000',
            'end_date' => 'required|date_format:Y-m-d H:i',
            'note' => 'nullable',
            'receiver' => 'required',
            'path_image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ];

        if (auth()->user()->hasRole('donatur')) {
            $rules['status'] = 'nullable';
        }

        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('path_image', 'categories');
        $data['slug'] = Str::slug($request->title);
        $data['path_image'] = upload('campaign', $request->file('path_image'), 'campaign');
        $data['user_id'] = auth()->id();

        $campaignn = Campaign::create($data);
        // $campaign = Campaign::first();
        $campaignn->category_campaign()->attach($request->categories);

        return response()->json(['data' => $campaignn, 'message' => 'Project berhasil ditambahkan']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Campaign $campaign)
    {
        if (! $request->ajax()) {
            return view('campaign.detail', compact('campaign'));
        }
        
        $campaign->publish_date = date('Y-m-d H:i', strtotime($campaign->publish_date));
        $campaign->end_date = date('Y-m-d H:i', strtotime($campaign->end_date));
        $campaign->categories = $campaign->category_campaign;
        $campaign->path_image = Storage::disk('public')->url($campaign->path_image);
        
        return response()->json(['data' => $campaign]);

    }

    /**
     * Show edit form.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::orderBy('name')->get()->pluck('name', 'id');
        $campaign = Campaign::findOrFail($id);

        return view('front.campaign.index', compact('category', 'campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {

        $rules = [
            'title' => 'required|min:8',
            'categories' => 'required|array',
            'short_description' => 'required',
            'body' => 'required|min:8',
            'publish_date' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:Publish, Archived',
            'goal' => 'required|integer|min:100000',
            'end_date' => 'required|date_format:Y-m-d H:i',
            'note' => 'nullable',
            'receiver' => 'required',
            'path_image' => 'nullable|mimes:png,jpg,jpeg|max:2048'
        ];

        if (auth()->user()->hasRole('donatur')) {
            $rules['status'] = 'nullable';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('path_image', 'categories');
        $data['slug'] = Str::slug($request->title);
        
        if ($request->hasFile('path_image')) {
            if (Storage::disk('public')->exists($campaign->path_image)) {
                Storage::disk('public')->delete($campaign->path_image);
            }

            $data['path_image'] = upload('campaign', $request->file('path_image'), 'campaign');

        }

        $campaign->update($data);
        $campaign->category_campaign()->sync($request->categories);

        return response()->json(['data'=>$campaign, 'message'=>'Project berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaignn)
    {
        if (Storage::disk('public')->exists($campaignn->path_image)) {
            Storage::disk('public')->exists($campaignn->path_image);
        }

        $campaignn->delete();

        return response()->json(['data'=>null, 'message'=>'Project telah dihapus']);
    }
}
