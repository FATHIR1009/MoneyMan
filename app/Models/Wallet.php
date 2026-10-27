<?php

namespace App\Models;

use Database\Factories\WalletFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    /** @use HasFactory<WalletFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'initial_balance',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'initial_balance' => 'decimal:2',
        ];
    }

    /**
     * Get the user that owns the wallet.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transactions where this wallet is the main/source wallet.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'wallet_id');
    }

    /**
     * Get the transfer transactions where this wallet is the destination.
     */
    public function incomingTransfers(): HasMany
    {
        return $this->hasMany(Transaction::class, 'destination_wallet_id');
    }

    /**
     * Scope a query to include the calculated current balance.
     *
     * Saldo dompet = saldo awal + pemasukan - pengeluaran + transfer masuk - transfer keluar.
     */
    public function scopeWithCurrentBalance(Builder $query): Builder
    {
        return $query->select('wallets.*')
            ->selectRaw('
                (
                    wallets.initial_balance
                    + COALESCE((SELECT SUM(amount) FROM transactions WHERE transactions.wallet_id = wallets.id AND transactions.type = \'income\'), 0)
                    - COALESCE((SELECT SUM(amount) FROM transactions WHERE transactions.wallet_id = wallets.id AND transactions.type = \'expense\'), 0)
                    - COALESCE((SELECT SUM(amount) FROM transactions WHERE transactions.wallet_id = wallets.id AND transactions.type = \'transfer\'), 0)
                    + COALESCE((SELECT SUM(amount) FROM transactions WHERE transactions.destination_wallet_id = wallets.id AND transactions.type = \'transfer\'), 0)
                ) as current_balance
            ');
    }

    /**
     * Get current balance attribute.
     */
    public function getCurrentBalanceAttribute(): float
    {
        if (array_key_exists('current_balance', $this->attributes)) {
            return (float) $this->attributes['current_balance'];
        }

        $income = (float) $this->transactions()->where('type', 'income')->sum('amount');
        $expense = (float) $this->transactions()->where('type', 'expense')->sum('amount');
        $transferOut = (float) $this->transactions()->where('type', 'transfer')->sum('amount');
        $transferIn = (float) $this->incomingTransfers()->where('type', 'transfer')->sum('amount');

        return (float) $this->initial_balance + $income - $expense - $transferOut + $transferIn;
    }
}
