# Milestone 01: the tasks table

Guide: [Task tracker with sign in](https://ewoibuilds.com/projects/task-tracker-laravel), steps 1 and 2

**Your workspace folder:** `~/ewoi-learning/task-tracker` (Laravel 13, Livewire starter kit).

## What this milestone adds

A `tasks` table where each task belongs to one user, the `Task` model, and the `tasks()` relationship on `User`. `user_id` is deliberately not fillable.

## The files

```
milestone-01-tasks-table/
├── database/migrations/2026_01_01_000000_create_tasks_table.php
├── app/Models/Task.php
└── tests/Feature/TaskModelTest.php
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

No route changes yet.

## Check

Copy `tests/Feature/TaskModelTest.php` into your app, then from `~/ewoi-learning/task-tracker`:

```bash
php artisan migrate
php artisan test --filter=TaskModelTest
```

Expected: every test in it passes. Then run `php artisan test` to check nothing else broke.

## Commit

```bash
git add .
git commit -m "Add the tasks table and model"
```

## Next

[Milestone 02: list, add, edit and delete](../milestone-02-tasks-crud)

<!-- ewoi:step -->
---

**Next:** [milestone-02-tasks-crud](../milestone-02-tasks-crud/) &nbsp;&middot;&nbsp; **Stuck?** [Ask with the "I am stuck" form](https://github.com/ewoibuilds/task-tracker-laravel/issues/new/choose) &nbsp;&middot;&nbsp; **Helped?** Star [the repo](https://github.com/ewoibuilds/task-tracker-laravel) and follow [Ewoi Builds](https://github.com/ewoibuilds).
<!-- /ewoi:step -->
