<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model; // karena sudah ada model

class Campaign extends Model
{
    use HasFactory;

    public function category_campaign()
    {
        return $this->belongsToMany(Category::class, 'category_campaign');
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function statusColor()
    { 
        $color = '';

        switch ($this->status) {
            case 'Publish':
                $color = 'success';
                break;
            case 'Archived':
                $color = 'dark';
                break;
            case 'Pending':
                $color = 'danger';
                break;
            default:
                break;
        }

        return $color;
    }

    public function scopeDonatur($query)
    {
        return $query->where('user_id', auth()->id());
    }
}
