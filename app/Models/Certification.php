<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model {
    protected $fillable = ['name','issuer','year','credential_url','icon','sort_order'];
}