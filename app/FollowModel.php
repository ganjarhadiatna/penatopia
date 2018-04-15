<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FollowModel extends Model
{
    function scopeAdd($query, $data)
    {
    	return DB::table('follow')
    	->insert($data);
    }
    function scopeRemove($query, $iduser, $id)
    {
    	return DB::table('follow')
    	->where('following', $iduser)
    	->where('followers', $id)
    	->delete();
    }
    function scopeCheck($query, $iduser, $id)
    {
    	return DB::table('follow')
    	->where('following', $iduser)
    	->where('followers', $id)
    	->value('idfollow');
    }
    function scopeGetTotalFollowing($query, $id)
    {
        return DB::table('follow')
        ->where('follow.followers', $id)
        ->count('follow.idfollow');
    }
    function scopeGetTotalFollowers($query, $id)
    {
        return DB::table('follow')
        ->where('follow.following', $id)
        ->count('follow.idfollow');
    }
    function scopeGetUserFollowing($query, $iduser, $id)
    {
        return DB::table('follow')
        ->select(
            'follow.idfollow',
            'users.id',
            'users.name',
            'users.foto',
            DB::raw('(select idfollow from follow where following=users.id and followers='.$id.') as is_following')
        )
        ->join('users','users.id','=','follow.following')
        //->where('follow.following', '!=', $iduser)
        ->where('follow.followers', $iduser)
        ->get();
    }
    function scopeGetUserFollowers($query, $iduser, $id)
    {
        return DB::table('follow')
        ->select(
            'follow.idfollow',
            'users.id',
            'users.name',
            'users.foto',
            DB::raw('(select idfollow from follow where following=users.id and followers='.$id.') as is_following')
        )
        ->join('users','users.id','=','follow.followers')
        //->where('follow.followers', '!=', $iduser)
        ->where('follow.following', $iduser)
        ->get();
    }
}
