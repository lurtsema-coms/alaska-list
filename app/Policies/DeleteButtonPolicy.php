<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DeleteButtonPolicy
{
    /**
     * Create a new policy instance.
     */

    public function delete(?User $user,Model $model): bool
    {
        if ($user?->role === 'admin') {
            return true;
        }
        
        return $user?->id === $model->created_by;
    }
}
