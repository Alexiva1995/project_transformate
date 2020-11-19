<?php 

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure; use Session;

class Instructors{
    protected $auth;
    public function __construct(Guard $guard){
        $this->auth=$guard;
    }
    
    public function handle($request, Closure $next){
        if($this->auth->user()->role_id != 2){
            return redirect()->route('landing.index');
        }
        return $next($request);
    }
}