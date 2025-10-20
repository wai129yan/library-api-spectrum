<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            // 'email' => $this->email,
            // 'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'membership_date' => $this->membership_date,
            'status' => $this->status === 'active' ? 'Active' : 'Inactive',
            'active_borrowings_count' => $this->when($this->relationLoaded('activeBorrowings'), $this->activeBorrowings->count()),
            // Laravel model ထဲက relationship (activeBorrowings) ကိုeager load (with()) လုပ်ထားပြီလား စစ်တာပါ။
            // true → relationship load ဖြစ်ပြီး, data အသုံးပြုနိုင်တယ်false → load မဖြစ်သေးသဖြင့်, data မပြပါ
            // API Resource မှာ relationship load ဖြစ်တဲ့အခါမှပဲအဲ့ဒီ data (ဥပမာ count) ကို ပြဖို့ ဖြစ်ပါတယ်
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
