<?php
namespace realtimemodule\pushserver\Models;
use Illuminate\Database\Eloquent\Model;
if (class_exists('\App\Models\User')) {
    class MiddleClass extends \App\Models\User { }
} else {
    class MiddleClass extends Model{ }
}
class User extends MiddleClass {
}