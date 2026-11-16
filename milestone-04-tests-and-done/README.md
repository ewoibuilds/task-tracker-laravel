# Milestone 04: tests and mark as done

Guide: **Task tracker with sign in** (on ewoibuilds.com: `/projects/task-tracker-laravel`), steps 5 and 6

**Your workspace folder:** `~/ewoi-learning/task-tracker` (Laravel 13, Livewire starter kit).

## What this milestone adds

The guide's `TaskTest`, plus a `toggle` action that marks a task done or not done (protected by the same policy), and a line through done tasks.

## The files

```
milestone-04-tests-and-done/
├── (everything from milestone 03)
├── app/Http/Controllers/TaskController.php   (adds toggle)
├── resources/views/tasks/index.blade.php     (adds the done button)
└── tests/Feature/TaskTest.php
```

## Edits to starter kit files

The `tasks()` method on `User` from milestone 01, and the routes with the new `toggle` route:

In `routes/web.php` (from the starter kit), add `use App\Http\Controllers\TaskController;` with the other `use` lines, and this group above the `require` line at the bottom:

```php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tasks', TaskController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::patch('tasks/{task}/done', [TaskController::class, 'toggle'])->name('tasks.toggle');
});
```

## Check

Copy `tests/Feature/TaskTest.php` into your app, then from `~/ewoi-learning/task-tracker`:

```bash
php artisan migrate
php artisan test --filter=TaskTest
```

Expected: every test in it passes. Then run `php artisan test` to check nothing else broke.

## Commit

```bash
git add .
git commit -m "Mark tasks as done"
```

## Next

Publish it: write your README, push to your own GitHub repository, and go through [ACCEPTANCE.md](../ACCEPTANCE.md). Want a code review? Book a one-to-one session at https://ewoibuilds.com/training.
