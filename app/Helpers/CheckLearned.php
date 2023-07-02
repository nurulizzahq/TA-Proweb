<?php 

namespace App\Helpers;

use App\Models\ModuleLearned;

class CheckLearned {

    public static function check($userId, $courseId)
    {
        $check = ModuleLearned::where('user_id', $userId)->where('module_id', $courseId)->count();

        if ($check != 0) {
            return true;
        } 

        return false;
    }
}
