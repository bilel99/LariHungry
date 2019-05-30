<?php

namespace App\Http\Helpers;

use App\Media;
use App\Restaurant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait UploaderFiles
{
    private $mult = array();
    private $path = array();
    private $media = array();

    /**
     * @param Request $request
     * @param string $name
     * @param string $directory
     * @param bool|null $pivot
     * @return bool
     */
    public function uploadedFile(Request $request, string $name = 'restaurant_media', string $directory = 'uploads/restaurants/'): bool
    {
        // Created files
        if ($files = $request->file($name)) {
            foreach ($files as $file) {
                $fileName = uniqid($file) . '.' . $file->getClientOriginalExtension();
                $file->move($directory, $fileName);

                $table = explode('/', $fileName);
                $path = end($table);

                array_push($this->path, public_path('/' . $directory . $path));
                array_push($this->mult, $file);
            }
            return true;
        }
        return false;
    }

    /**
     * @param Request $request
     * @param Restaurant $restaurant
     * @param string $name
     * @param string $directory
     * @param bool|null $update
     * @param bool|null $pivot
     * @return void
     */
    public function addMedia(Request $request, ?Restaurant $restaurant, string $name, string $directory, ?bool $update = false, ?bool $pivot = true): void
    {
        if ($this->uploadedFile($request, $name, $directory) === true) {
            // pivot is true
            if ($update === false) {
                if ($pivot) {
                    // create (insert)
                    // save file in table media
                    for ($i = 0; $i < count($this->path); $i++) {
                        $media = new Media();
                        $media->type = 1;
                        $media->name = 'image';
                        $media->path = $this->path[$i];
                        $media->save();
                        array_push($this->media, $media);
                    }
                    // Table pivot (ManyToMany, OneToMany)
                    // attach relation (restaurant_media)
                    foreach ($this->media as $row) {
                        $restaurant->medias()->detach($row);
                        $restaurant->medias()->attach($row);
                    }
                } else if ($pivot === false) {
                    if (Auth::user()->media_id === null ||
                        empty(Auth::user()->media_id) ||
                        Auth::user()->media_id === '') {

                        $files = $request->file($name);
                        $fileName = uniqid($files) . '.' . $files->getClientOriginalExtension();
                        $files->move($directory, $fileName);

                        $table = explode('/', $fileName);
                        $path = end($table);

                        array_push($this->path, public_path('/' . $directory . $path));
                        array_push($this->mult, $files);

                        $media = new Media();
                        $media->type = 1;
                        $media->name = 'image';
                        $media->path = $this->path[0];
                        $media->save();

                        $user = User::where('id', Auth::user()->id)->first();
                        $user->media_id = $media->id;
                        $user->save();
                    }
                }
            } else {
                // Edition (update)
                if ($pivot) {
                    $media = Media::with('restaurants')->get();
                    foreach ($media as $m) {
                        foreach ($m->restaurants as $r) {
                            if ($r->id === $restaurant->id) {
                                $m->delete();
                            }
                        }
                    }
                    foreach ($this->path as $row) {
                        $media = new Media();
                        $media->type = 1;
                        $media->name = 'image';
                        $media->path = $row;
                        $media->save();
                        array_push($this->media, $media);
                    }

                    // attach relation restaurant_media
                    foreach ($this->media as $row) {
                        $restaurant->medias()->detach($row);
                        $restaurant->medias()->attach($row);
                    }
                } else if ($pivot === false) {
                    if (Auth::user()->media_id !== null ||
                        Auth::user()->media_id !== '') {

                        $media = Media::get();
                        // Deleted file
                        foreach ($media as $row) {
                            if ($row->id === Auth::user()->media_id) {
                                // deleted file
                                if (file_exists($row->path)) {
                                    unlink($row->path);
                                }
                            }
                        }

                        $files = $request->file($name);
                        $fileName = uniqid($files) . '.' . $files->getClientOriginalExtension();
                        $files->move($directory, $fileName);

                        $table = explode('/', $fileName);
                        $path = end($table);

                        array_push($this->path, public_path('/' . $directory . $path));
                        array_push($this->mult, $files);

                        foreach ($media as $row) {
                            if ($row->id === Auth::user()->media_id) {
                                $row->path = $this->path[0];
                                $row->save();
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * @param Restaurant $restaurant
     * @param bool|null $pivot
     */
    public
    function deleteMedia(Restaurant $restaurant, ?bool $pivot = true): void
    {
        $media = Media::with('restaurants')->get();
        if ($pivot === true) {
            foreach ($media as $m) {
                foreach ($m->restaurants as $r) {
                    if ($r->id === $restaurant->id) {
                        $m->delete();
                        // deleted restaurant_media
                        $restaurant->medias()->detach($m);
                        // deleted file
                        if (file_exists($m->path)) {
                            unlink($m->path);
                        }
                    }
                }
            }
        } else {
            foreach ($media as $m) {
                if (Auth::user()) {
                    if ($m->id === Auth::user()->media_id) {
                        // deleted file
                        if (file_exists($m->path)) {
                            unlink($m->path);
                        }
                        $m->delete();
                    }
                }
            }
        }
    }

    /**
     * @param Object $object
     */
    public function deletedFileExist(Object $object)
    {
        // Deleted files exists
        $media = Media::with('restaurants')->get();
        foreach ($media as $m) {
            foreach ($m->restaurants as $r) {
                if ($r->id === $object->id) {
                    // deleted file
                    if (file_exists($m->path)) {
                        unlink($m->path);
                    }
                }
            }
        }
    }

}
