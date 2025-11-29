<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * =========1=========
     * Transformasikan resource menjadi array.
     * Pastikan untuk menyertakan semua atribut model Book.
     */
    public function toArray(Request $request): array
    {
        return [
<<<<<<< HEAD
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'published_year' => $this->published_year,
            'is_available' => (bool) $this->is_available,
            'created_at' => $this->created_at ? $this->created_at->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->toDateTimeString() : null,
=======

>>>>>>> 0dfb2fa5e1f9378ad8fdbf5708fc33b3dc077aca
        ];
    }
}
