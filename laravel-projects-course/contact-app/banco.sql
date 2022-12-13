INSERT INTO users(name, email, email_verified_at, password, remember_token, created_at, updated_at)
VALUES ('Anderson', 'anderson@gmail.com', NOW(), '123', null, NOW(), NOW());

INSERT INTO tasks(user_id, name, description, due_date, status, priority, created_at, updated_at)
VALUES (1, 'Study', 'Learn Laravel', NOW(), 1, 1, NOW(), NOW());