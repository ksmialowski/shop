<?php

namespace App\Services\Photo;

use App\Models\Photo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PhotoService
{
    /** @var object|array $images */
    private $images;
    private string $path;
    private string $photoType;

    public function __construct($images, $path = 'products', $photoType = 'large') {
        $this->images = $images;
        $this->path = $path;
        $this->photoType = $photoType;
    }

    public function upload(): array
    {
        $id_photos = [];
        if(is_array($this->images)) {
            foreach ($this->images as $image) {
                $id_photos[] = $this->body($image);
            }
        } else {
            $id_photos[] = $this->body($this->images);
        }

        return $id_photos;
    }

    private function body($image): int
    {
        $extension = $image->extension();
        $filename = Str::random(32).'.'.$extension;
        $filepath = $image->storeAs($this->path, $filename, 'public');

        DB::beginTransaction();
        try {
            $photo = new Photo();
            $photo->photo_type = $this->photoType;
            $photo->photo_filepath = $filepath;
            $photo->save();

            $id_photo = $photo->id_photo;

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        return $id_photo ?? 0;
    }
}
