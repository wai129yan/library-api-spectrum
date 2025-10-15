<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title" => $this->title,
            "isbn" => $this->isbn,
            // "isbn"=>['required|string',Rule::unique('books','isbn')->ignore($this->route('book')->id)
            // ],
            // books ဆိုတဲ့ table ထဲမှာ isbn တူတဲ့တန်ဖိုး မရှိရပါဘူး။
            // သူ့ကိုယ်သူနဲ့ပဲ isbn တူတယ်ဆိုပြီး error မဖြစ်အောင် ignore(...) ကိုသုံးထားတာပါ။
            "description" => $this->description,
            "genre" => $this->genre,
            "published_at" => $this->published_at,
            "total_copies" => $this->total_copies,
            "available_copies" => $this->available_copies,
            "cover_image" => $this->cover_image,
            "price" => $this->price,
            "status" => $this->status,
            "is_available" => $this->isAvailable(),
            "author" => new AuthorResource($this->whenLoaded('author')),
            //to ask
        ];
    }
}
