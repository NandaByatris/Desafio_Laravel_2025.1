<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Compra extends Model
{
    use HasFactory;


    protected $fillable = ['produto_id', 'user_id', 'valor_pago', 'status'];


    public function produto(){
        return $this->belongsTo(Produto::class);  
    }
    public function user(){
        return $this->belongsTo(User::class);  
    }
}
?>
