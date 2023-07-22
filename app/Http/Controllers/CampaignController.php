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
        $query = Campaign::orderBy('publish_date', 'desc')
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
                );

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
                    return '
                    <a href="'. route('campaign.detail', $query->id) .'" class="btn btn-link text-dark"><i class="fas fa-search-plus"></i></a>
                    <button onclick="editForm(`'. route('campaignn.show', $query->id) .'`)" class="btn btn-link text-info"><i class="fas fa-edit"></i></button>
                          <button class="btn btn-link text-danger" onclick="deleteData(`'. route('campaignn.destroy', $query->id) .'`)"><i class="fas fa-trash"></i></button>
                    ';
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:8',
            'categories' => 'required|array',
            'short_description' => 'required',
            'body' => 'required|min:8',
            'publish_date' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:Publish, Archived',
            'goal' => 'required|integer',
            'end_date' => 'required|date_format:Y-m-d H:i',
            'note' => 'nullable',
            'receiver' => 'required',
            'path_image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

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
    public function show(Campaign $campaignn)
    {
        $campaignn->publish_date = date('Y-m-d H:i', strtotime($campaignn->publish_date));
        $campaignn->end_date = date('Y-m-d H:i', strtotime($campaignn->end_date));
        $campaignn->categories = $campaignn->category_campaign;
        
        return response()->json(['data' => $campaignn]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $campaign = Campaign::findOrFail($id);

        return view('campaign.detail', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaignn)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:8',
            'categories' => 'required|array',
            'short_description' => 'required',
            'body' => 'required|min:8',
            'publish_date' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:Publish, Archived',
            'goal' => 'required|integer',
            'end_date' => 'required|date_format:Y-m-d H:i',
            'note' => 'nullable',
            'receiver' => 'required',
            'path_image' => 'nullable|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('path_image', 'categories');
        $data['slug'] = Str::slug($request->title);
        
        if ($request->hasFile('path_image')) {
            if (Storage::disk('public')->exists($campaignn->path_image)) {
                Storage::disk('public')->exists($campaignn->path_image);
            }

            $data['path_image'] = upload('campaign', $request->file('path_image'), 'campaign');

        }

        // dd($data);
        $campaignn->update($data);
        $campaignn->category_campaign()->sync($request->categories);

        return response()->json(['data'=>$campaignn, 'message'=>'Project berhasil diperbarui']);
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
