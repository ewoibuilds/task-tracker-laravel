# Milestone 03: only your tasks

Guide: [Task tracker with sign in](https://ewoibuilds.com/projects/task-tracker-laravel), step 4

**Your workspace folder:** `~/ewoi-learning/task-tracker` (Laravel 13, Livewire starter kit).

## What this milestone adds

`TaskPolicy` (found by Laravel automatically) and `Gate::authorize` at the top of `edit`, `update` and `destroy`. Someone who changes the number in `/tasks/5/edit` now gets 403 Forbidden.

## The files

```
milestone-03-only-your-tasks/
├── (everything from milestone 02)
├── app/Policies/TaskPolicy.php
├── app/Http/Controllers/TaskController.php   (now with Gate::authorize)
└── tests/Feature/TaskPolicyTest.php
```

## Edits to starter kit files

Same as milestone 02: the `tasks()` method on `User` and these routes.

In `routes/web.php` (from the starter kit), add `use App\Http\Controllers\TaskController;` with the other `use` lines, and this group above the `require` line at the bottom:

```php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tasks', TaskController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
});
```

## Check

Copy `tests/Feature/TaskPolicyTest.php` into your app, then from `~/ewoi-learning/task-tracker`:

```bash
php artisan migrate
php artisan test --filter=TaskPolicyTest
```

Expected: every test in it passes. Then run `php artisan test` to check nothing else broke.

## Commit

```bash
git add .
git commit -m "Only the owner can edit or delete a task"
```

## Next

[Milestone 04: tests and done](../milestone-04-tests-and-done)

<!-- ewoi:step -->
---

**Next:** [milestone-04-tests-and-done](../milestone-04-tests-and-done/) &nbsp;&middot;&nbsp; **Stuck?** [Ask with the "I am stuck" form](https://github.com/ewoibuilds/task-tracker-laravel/issues/new/choose) &nbsp;&middot;&nbsp; **Helped?** Star [the repo](https://github.com/ewoibuilds/task-tracker-laravel) and follow [Ewoi Builds](https://github.com/ewoibuilds).
<!-- /ewoi:step -->
