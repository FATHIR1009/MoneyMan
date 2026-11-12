# Project Rules Index

This file maps file globs to rule files for this project.

## Mappings

| Glob | Rule File | Description |
| :--- | :--- | :--- |
| `app/Models/**` | [models.md](models.md) | Conventions for Eloquent models, fillable attributes, relations, and query scopes |
| `app/Http/**` | [controllers.md](controllers.md) | Conventions for controllers, routing, middleware, and Form Requests |
| `app/**` | [architecture.md](architecture.md) | Application architecture, dependency injection, and data layer conventions |
| `resources/views/**` | [frontend.md](frontend.md) | Blade view layout structure, empty states, and Tailwind CSS design tokens |
| `database/migrations/**` | [models.md](models.md) | Database migration standards, foreign keys, and enum types |
| `tests/**` | [testing.md](testing.md) | PHPUnit test design, feature tests, factories, and assertion patterns |
