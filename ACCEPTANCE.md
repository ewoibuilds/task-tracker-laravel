# Acceptance checklist

Tick each line on your own app. The test named in brackets checks it for you.

## Milestone 01: tasks table

- [ ] `php artisan migrate` creates a `tasks` table with `user_id`, `title`, `notes`, `done_at` and timestamps
- [ ] A user has many tasks and a task belongs to a user (`TaskModelTest`)
- [ ] `user_id` is not in `$fillable`; it is always set from the signed-in user (`TaskModelTest`)
- [ ] Deleting a user deletes their tasks (`TaskModelTest`)

## Milestone 02: list, add, edit, delete

- [ ] `/tasks` needs sign in, and lists only your own tasks (`TaskCrudTest`)
- [ ] An empty title is refused with a message; nothing is saved (`TaskCrudTest`)
- [ ] Titles are escaped when shown (`TaskCrudTest`)
- [ ] You can edit, update and delete your own task (`TaskCrudTest`)
- [ ] Every form has `@csrf`

## Milestone 03: only your tasks

- [ ] Opening, changing or deleting someone else's task gets 403 and changes nothing (`TaskPolicyTest`)

## Milestone 04: tests and done

- [ ] Guests are sent to `/login` (`TaskTest`)
- [ ] Marking a task done sets `done_at`; marking it again clears it (`TaskTest`)
- [ ] Nobody can mark someone else's task done (`TaskTest`)
- [ ] Done tasks show with a line through them
- [ ] `php artisan test` passes with no failures
- [ ] Your repo has a README: what it does, how to run it, how to run the tests
