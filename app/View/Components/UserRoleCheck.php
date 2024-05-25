<?php 

    use Illuminate\Support\Facades\Auth;

    if(!function_exists('checkRole')){
        function checkRole() : bool{
            $role = Auth::user()->role;
            if($role == "client"){
                return false;
            }else if($role == "admin"){
                return true;
            }
        }
    }

?>