# Testing Conventions

- **Test Framework:** This project uses PHPUnit. Create tests with `php artisan make:test --phpunit {name}` without directory prefixes.
- **Database Isolation:** Feature tests must use `Illuminate\Foundation\Testing\RefreshDatabase` to ensure a clean state per test.
- **Test Data:** Use model factories (`UserFactory`, `WalletFactory`, `TransactionFactory`) with semantic state methods (`income()`, `expense()`, `transfer()`) rather than manual raw insertions.
- **Boundary Coverage:** Every feature test suite must cover:
  1. Guest redirect (authentication check).
  2. Empty database behavior (empty state verification).
  3. Correct calculation with realistic data.
  4. Multi-user data isolation (confirming User A cannot access User B's records).
