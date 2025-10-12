<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name"=>strtoupper($this->name),
            "bio"=>$this->bio,
            "nationality"=>strtoupper($this->nationality),
            // "nationality"=>strtoupper($this->nationality),
            // Prefer numeric count; use withCount if available, otherwise count when loaded
            "books"=> $this->books_count ?? ($this->relationLoaded('books') ? $this->books->count() : 0),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            //Relationship ကို eager load လုပ်ထားလား စစ်တယ် Books အရေအတွက်ကိုတွက်တယ် Eager loaded ဖြစ်တဲ့အခါမှာပဲ books count ကို API ထဲမှာ ထုတ်ပြတယ်
        ];
    }
}