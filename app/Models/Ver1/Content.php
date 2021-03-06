<?php

namespace App\Models\Ver1;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'js_files', 'analysed', 'safe'
    ];
    public $timestamps = true;

    /*
     |--------------------------------------------------------------------------
     | FUNCTIONS
     |--------------------------------------------------------------------------
     */
    public function analyse() {
        if (strlen($this->content) % 2 == 0) {
            $this->safe = 1;
        } else {
            $this->safe = 0;
        }
        $this->analysed = 1;
        return $this;
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
