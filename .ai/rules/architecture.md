# Application Architecture Conventions

- **Altitude:** Query Eloquent directly from controllers with eager loading and scopes; do not introduce unnecessary repository or DTO abstractions unless requested.
- **Dependency Injection:** Inject dependencies via constructor or method signatures; avoid manual service location (`App::make()`).
- **N+1 Prevention:** Prevent N+1 queries by eager loading relationships (`with(['wallet', 'destinationWallet'])`) and using SQL aggregation subqueries for balance calculations.
- **Financial Balances:**
  - `Saldo Dompet = initial_balance + income - expense - transfer_out + transfer_in`.
  - Transfer is strictly neutral: moving money between wallets does not change total overall balance.
  - Transfer transactions must never be counted as income or expense.
