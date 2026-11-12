# Controllers and Validation Conventions

- **Validation:** Always extract validation into dedicated Form Request classes under `app/Http/Requests` for state-changing endpoints.
- **Controller Shape:** Use single-action invokable controllers (`__invoke(Request $request): View`) for complex views like Dashboard, and resourceful controllers for multi-action modules.
- **User Scoping:** All personal financial queries in controllers must be strictly scoped to the authenticated user (`$request->user()` or `$user->wallets()`, `$user->transactions()`).
- **Data Preparation:** Compute and format all required metrics in the controller; never execute database queries directly inside Blade templates.
- **Routing:** Use named routes (`route('...')`) and group routes with middleware (`auth` and `guest`).
