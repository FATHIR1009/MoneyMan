# Models and Database Conventions

- **Mass Assignment:** Always use `$fillable` allow-lists in models. Do not use `$guarded`.
- **Casts:** Define casts using the PHP method `casts(): array`, not the deprecated `$casts` property.
- **Relationships:** Always declare explicit return types on relationship methods (`BelongsTo`, `HasMany`).
- **Query Scopes:** Implement complex query logic as Eloquent local scopes with typed parameter `Builder $query` and return type `: Builder`.
- **Foreign Keys:** Migrations must use `$table->foreignId('column')->constrained('table')->cascadeOnDelete()` or `restrictOnDelete()`. Do not use detached unsigned big integer columns.
- **Reverse Migrations:** Always provide complete reverse logic in migration `down()` methods (`Schema::dropIfExists('table')`).
- **Enums:** Store restricted categorical data (e.g. `type`) using database enums or strictly validated strings.
