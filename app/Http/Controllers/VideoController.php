<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Psy\Util\Json;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collect = collect($this->getContent())
            ->where('type', '!=', 'file');
//            ->whereIn('extension', ['VOB', 'WMV', 'mov', 'wmv', 'avi', 'rm', 'asf']);
//dd($collect);

        $items = (new LengthAwarePaginator(
            $collect->forPage(request()->get('page'), 20),
            $collect->count(),
            20
        ))->withPath('/videos');

        return view('video.index', compact('items'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $path
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, $path)
    {
        if ($this->isDir($path)) {
            $collect = collect($this->getContent())->filter(function ($item) use ($path) {
                return \Str::startsWith(($item['path']), $path);
            });

            $items = (new LengthAwarePaginator(
                $collect->forPage(request()->get('page'), 20),
                $collect->count(),
                20
            ))->withPath('/videos/' . $path);

            return view('video.index', compact('items'));
        } else {
            $driver = \Storage::cloud();

            $info = $driver->getMetadata($path);

            switch ($info['extension']) {
                case 'webm':
                    $mimeType = 'video/webm';
                    break;
                default:
                    $mimeType = $driver->getMimeType($path);
            }

            $url = $driver->temporaryUrl($path, now()->addMinutes(10));

            return view('video.show', compact('url', 'mimeType'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @return array|mixed
     */
    public function getContent()
    {
        $driver = \Storage::cloud();

        if (!\Cache::has('tree')) {
            $content = $driver->listContents('詠春', true);

            \Cache::forever('tree', Json::encode($content));
        }

        return json_decode(\Cache::get('tree'), true);
    }

    protected function isDir($path)
    {
        return collect($this->getContent())
                ->where('type', 'dir')
                ->where('path', $path)
                ->count() > 0;
    }
}
