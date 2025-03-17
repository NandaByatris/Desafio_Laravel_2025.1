<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Compra extends Model
{
    use HasFactory;

    protected $table = 'orders'; 
    protected $fillable = ['produto_id', 'status', 'valor_pago', 'user_id'];


    public function produto(){
        return $this->belongsTo(Produto::class);  
    }
    public function user(){
        return $this->belongsTo(User::class);  
    }
}
?>