<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'user_id',
        'customer_name',
        'phone',
        'address',
        'notes',
        'payment_method',
        'payment_status',
        'order_status',
        'subtotal',
        'shipping_cost',
        'total',
        'va_number',
        'qris_code',
        'payment_proof',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function formattedSubtotal(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    public function formattedShippingCost(): string
    {
        return 'Rp ' . number_format($this->shipping_cost, 0, ',', '.');
    }

    public function formattedTotal(): string
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    public function paymentMethodLabel(): string
    {
        return match ($this->payment_method) {
            'cod' => 'COD / Bayar di Tempat',
            'transfer' => 'Transfer Virtual Account',
            'qris' => 'QRIS',
            default => 'Tidak diketahui',
        };
    }

    public function paymentStatusLabel(): string
    {
        return match ($this->payment_status) {
            'unpaid' => 'Belum Dibayar',
            'waiting_confirmation' => 'Menunggu Konfirmasi',
            'paid' => 'Sudah Dibayar',
            default => 'Tidak diketahui',
        };
    }

    public function orderStatusLabel(): string
    {
        return match ($this->order_status) {
            'pending' => 'Menunggu Diproses',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => 'Tidak diketahui',
        };
    }
}
