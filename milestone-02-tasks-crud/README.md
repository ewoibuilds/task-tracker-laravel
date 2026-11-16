# Milestone 02: list, add, edit and delete

Guide: **Task tracker with sign in** (on ewoibuilds.com: `/projects/task-tracker-laravel`), step 3

**Your workspace folder:** `~/ewoi-learning/task-tracker` (Laravel 13, Livewire starter kit).

## What this milestone adds

Resource routes behind sign in, a `TaskController` that always starts from `$request->user()->tasks()`, validation, and three plain Blade views. The edit, update and delete actions do **not** check ownership yet: milestone 03 closes that hole.

## The files

```
milestone-02-tasks-crud/
├── database/migrations/2026_01_01_000000_create_tasks_table.php
├── app/Models/Task.php
├── app/Http/Controllers/TaskController.php
├── resources/views/tasks/layout.blade.php
├── resources/views/tasks/index.blade.php
├── resources/views/tasks/edit.blade.php
└── tests/Feature/TaskModelTest.php, TaskCrudTest.php
```

## Edits to starter kit files

In `app/Models/User.php` (it comes from the starter kit, so edit it rather than replacing it), add this line with the other `use` lines:

```php
use Illuminate\Database\Eloquent\Relations\HasMany;
```

and this method inside the class, just before its last `}`:

```php
public function tasks(): HasMany
{
    return $this->hasMany(Task::class);
}
```

(This is the same edit as milestone 01.)

In `routes/web.php` (from the starter kit), add `use App\Http\Controllers\TaskController;` with the other `use` lines, and this group above the `require` line at the bottom:

```php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tasks', TaskController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
});
```

## Check

Copy `tests/Feature/TaskCrudTest.php` into your app, then from `~/ewoi-learning/task-tracker`:

```bash
php artisan migrate
php artisan test --filter=TaskCrudTest
```

Expected: every test in it passes. Then run `php artisan test` to check nothing else broke.

## Commit

```bash
git add .
git commit -m "List, add, edit and delete tasks"
```

## Next

[Milestone 03: only your tasks](../milestone-03-only-your-tasks)
